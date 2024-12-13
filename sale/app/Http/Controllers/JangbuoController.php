<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Jangbu;

class JangbuoController extends Controller
{
    public function index()
    {
        $data['tmp'] = $this->qstring();

        $text1=request('text1'); //text1 알아냄
        if (!$text1) $text1=date("Y-m-d");//text1 null이면 오늘날짜로 초기화

        $data['text1'] = $text1;
        $data['list'] = $this->getlist($text1);
        return view('jangbuo.index', $data);
    }
    
    public function getlist($text1)
    {
        $result = Jangbu::leftjoin('products', 'jangbus.products_id', '=', 'products.id')
            ->select('jangbus.*', 'products.name as product_name')
            ->where('jangbus.io','=', 1)
            ->where('jangbus.writeday','=', $text1)
            ->orderby('jangbus.id', 'desc')
            ->paginate(5)
            ->appends(['text1' => $text1]);

        return $result;
    }    

    public function create()
    {
        $data['list']=$this->getlist_product();
        $data['tmp'] = $this->qstring();
        return view('jangbuo.create', $data);
    }

    public function getlist_product()
    {
       $result = Product::orderby('name')->get();
       return $result;
    }    

    public function save_row(Request $request, $row)
    {
        $request->validate([
            'writeday' => 'required|date',
            'products_id' => 'required'
        ],
        [
            'writeday.required' => '날짜는 필수입력입니다.',
            'products_id.required' => '제품명은 필수입력입니다.',
            'writeday.date' => '날짜형식이 잘못되었습니다.',
        ]);
        $row->io = 1;
        $row->writeday = $request->input('writeday');
        $row->products_id = $request->input('products_id');
        $row->price = $request->input('price');
        $row->numi = 0;
        $row->numo = $request->input('numo');
        $row->prices = $request->input('prices');
        $row->bigo = $request->input('bigo');

        $row->save();
    } 


    public function store(Request $request)
    {
    
        // 새로운 Jangbu 객체 생성
        $row = new Jangbu;
        $this->save_row($request, $row);
    
        // 저장 후 사용자 목록 페이지로 리다이렉트
        $tmp = $this->qstring();
        return redirect('jangbuo'. $tmp);
    }       


    public function show($id)
    {
        $data['tmp'] = $this->qstring();
    
        $data["row"] = Jangbu::leftJoin('products', 'jangbus.products_id', '=', 'products.id')
            ->select('jangbus.*', 'products.name as product_name')
            ->where('jangbus.id', '=', $id)
            ->first(); // 첫 번째로 일치하는 결과만 가져옴
        
        return view('jangbuo.show', $data); // 데이터를 뷰로 전달
    }
    

    public function edit($id)
    {
        $data['list']=$this->getlist_product();
        $data['tmp'] = $this->qstring();
        $data['row'] = Jangbu::find($id);
        return view('jangbuo.edit', $data);
    }


    public function update(Request $request, $id)
    {  
        // 자료찾기
        $row = Jangbu::find($id);
        $this->save_row($request, $row);
    
        // 저장 후 사용자 목록 페이지로 리다이렉트
        $tmp = $this->qstring();
        return redirect('jangbuo' .$tmp);
    }


    public function destroy($id)
    {
        Jangbu::find($id) -> delete();
        $tmp = $this->qstring();
        return redirect('jangbuo' . $tmp);
    }

    public function qstring()
    {
        $text1 = request("text1") ? request('text1') : "";
        $page =  request("page") ? request('page') : "1";

        $tmp = $text1 ? "?text1=$text1&page=$page" : "?page=$page";

        return $tmp;
    }
}
