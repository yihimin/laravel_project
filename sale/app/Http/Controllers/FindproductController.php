<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Gubun;

class FindproductController extends Controller
{
    public function index()
    {

        $data['tmp'] = $this->qstring();
        $text1=request('text1');
        $data['text1'] = $text1;
        $data['list'] = $this->getlist($text1);
        return view('findproduct.index', $data);
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

    public function qstring()
    {
        $text1 = request("text1") ? request('text1') : "";
        $page =  request("page") ? request('page') : "1";

        $tmp = $text1 ? "?text1=$text1&page=$page" : "?page=$page";

        return $tmp;
    }

}
