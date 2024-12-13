<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Jangbu;

class ChartController extends Controller
{
    public function index()
{
    $text1 = request('text1');
    if (!$text1) $text1 = date("Y-m-d", strtotime("-1 month"));

    $text2 = request('text2'); 
    if (!$text2) $text2 = date("Y-m-d");

    $data['text1'] = $text1;
    $data['text2'] = $text2;
    $list = $this->getlist($text1, $text2);

    $str_label = "";
    $str_data = "";
    foreach ($list as $row) {
        $str_label .= "'$row->gubuns_name',"; //구분 데이터 출력 "'다육식물','덩쿨식물'..."
        $str_data .= "$row->cnumo,"; //값데이터 출력 "4,12..."
    }
    $data['str_label'] = rtrim($str_label, ','); // 마지막 콤마 제거
    $data['str_data'] = rtrim($str_data, ',');   // 마지막 콤마 제거

    return view('chart.index', $data);
}

    
    public function getlist($text1, $text2)
    {
        $result = Jangbu::leftjoin('products', 'jangbus.products_id', '=', 'products.id')
        ->leftjoin('gubuns','products.gubuns_id','=','gubuns.id')
            ->select('gubuns.name as gubuns_name', DB::raw('count(jangbus.numo)as cnumo'))
            ->wherebetween('jangbus.writeday',array($text1, $text2))
            ->where('jangbus.io',"=", 1)
            ->orderby('cnumo', 'desc')
            ->groupby('gubuns.name')
            ->limit(14) //차트 색상의 미관을 위해
            ->paginate(14)
            ->appends(['text1' => $text1, 'text2' => $text2]);

        return $result;
    }    

    public function getlist_product()
    {
       $result = Product::orderby('name')->get();
       return $result;
    }    
}
