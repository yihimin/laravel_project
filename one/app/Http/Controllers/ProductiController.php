<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producti;

class ProductiController extends Controller
{
    // 상품 목록
    public function index()
    {
        $products = Producti::all(); // 모든 상품 가져오기
        return view('main.index', compact('products')); // 데이터와 함께 뷰 반환
    }

    // 상품 상세 보기
    public function show($id)
    {
        $product = Producti::findOrFail($id); // 특정 상품 가져오기
        return view('main.show', compact('product')); // 데이터와 함께 뷰 반환
    }
}
