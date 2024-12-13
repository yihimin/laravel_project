<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Gubun;
Use Image;

class ProductController extends Controller
{
    public function index()
    {

        $data['tmp'] = $this->qstring();
        $text1=request('text1');
        $data['text1'] = $text1;
        $data['list'] = $this->getlist($text1);
        return view('product.index', $data);
    }
    
    public function getlist($text1)
    {
        $result = Product::leftJoin('gubuns', 'products.gubuns_id', '=', 'gubuns.id')
            ->select('products.*', 'gubuns.name as gubuns_name')
            ->where('products.name', 'like', '%' . $text1 . '%')
            ->orderBy('products.name', 'asc')
            ->paginate(5)
            ->appends(['text1' => $text1]);

        return $result;
    }    

    public function getlist_gubun()
    {
       $result = Gubun::orderby('name')->get();
       return $result;
    }    

    public function save_row(Request $request, $row)
    {
        $request->validate([
            'gubuns_id' => 'required|numeric',
            'name' => 'required|max:20',
            'price' => 'required|numeric'
        ],
        [
            'gubuns_id.required' => '구분명은 필수입력입니다.',
            'name.required' => '이름은 필수입력입니다.',
            'price.required' => '단가는 필수입력입니다.',
            'name.max' => '20자 이내입니다.',
        ]);
        $row->gubuns_id = $request->input('gubuns_id');
        $row->name = $request->input('name');
        $row->price = $request->input('price');
        $row->jaego = $request->input('jaego');
       if ($request->hasFile('pic')) //업로드할 파일이 있는 경우
       {
        $pic = $request->file('pic');
        $pic_name = $pic->getClientOriginalName(); //파일이름
        $pic->storeAs('public/product_img', $pic_name); //파일저장
        
        $img=Image::make($pic)
        -> resize(null,200, function($constraint) {$constraint->aspectRatio();})
        -> save('storage/product_img/thumb/' . $pic_name);

        $row->pic = $pic_name;
       }
        
        // 데이터베이스에 저장
        $row->save();
    } 

    public function create()
    {
        $data['list']=$this->getlist_gubun();
        $data['tmp'] = $this->qstring();
        return view('product.create', $data);
    }

    public function store(Request $request)
    {
    
        // 새로운 Product 객체 생성
        $row = new Product;
        $this->save_row($request, $row);
    
        // 저장 후 사용자 목록 페이지로 리다이렉트
        $tmp = $this->qstring();
        return redirect('product'. $tmp);
    }       

    public function show($id)
    {
        $data['tmp'] = $this->qstring();
    
        // 제품 데이터와 관련된 gubun 이름을 가져옴
        $data["row"] = Product::leftJoin('gubuns', 'products.gubuns_id', '=', 'gubuns.id')
            ->select('products.*', 'gubuns.name as gubun_name')
            ->where('products.id', '=', $id)
            ->first(); // 첫 번째로 일치하는 결과만 가져옴
        
        return view('product.show', $data); // 데이터를 뷰로 전달
    }
    
    public function edit($id)
    {
        $data['list']=$this->getlist_gubun();
        $data['tmp'] = $this->qstring();
        $data['row'] = Product::find($id);
        return view('product.edit', $data);
    }

    public function update(Request $request, $id)
    {  
        // 자료찾기
        $row = Product::find($id);
        $this->save_row($request, $row);
    
        // 저장 후 사용자 목록 페이지로 리다이렉트
        $tmp = $this->qstring();
        return redirect('product' .$tmp);
    }

    public function destroy($id)
    {
        Product::find($id) -> delete();
        $tmp = $this->qstring();
        return redirect('product' . $tmp);
    }

    public function qstring()
    {
        $text1 = request("text1") ? request('text1') : "";
        $page =  request("page") ? request('page') : "1";

        $tmp = $text1 ? "?text1=$text1&page=$page" : "?page=$page";

        return $tmp;
    }

    public function jaego()
    {
        DB::statement('drop table if exists temps');
        DB::statement('create table temps(
        id int not null auto_increment,
        products_id int,
        jaego int default 0,
        primary key(id) ); ');
        DB::statement('update products set jaego=0;');
        DB::statement('insert into temps (products_id, jaego)
        select products_id, sum(numi)-sum(numo)
        from jangbus
        group by products_id;');
        DB::statement('update products join temps
        on products.id = temps.products_id 
        set products.jaego = temps.jaego;');

        return redirect('product');
    }
}
