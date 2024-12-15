<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producti;
use App\Models\Order;
use App\Models\OrderItem;

class CartController extends Controller
{
    /**
     * Display the cart page.
     */
    public function index()
    {
        // 세션에서 장바구니 데이터를 가져오기
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    /**
     * Add a product to the cart.
     */
        public function store(Request $request){
            // 세션에서 기존 장바구니 데이터를 가져오기
            $cart = session()->get('cart', []);
        
            // 선택한 상품 데이터 가져오기
            $product = Producti::findOrFail($request->product_id);
        
            // 장바구니에 상품 추가 또는 수량 증가
            $cart[$product->id] = [
                'id' => $product->id, // id 필드 추가
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => ($cart[$product->id]['quantity'] ?? 0) + 1,
                'image_path' => $product->image_path,
            ];
        
            // 세션에 장바구니 저장
            session()->put('cart', $cart);
        
            return redirect()->route('cart.index')->with('success', '상품이 장바구니에 추가되었습니다.');
        }
        

    /**
     * Remove a product from the cart.
     */
    public function remove($id)
    {
        // 세션에서 장바구니 데이터를 가져오기
        $cart = session()->get('cart', []);
        
        if (isset($cart[$id])) {
            // 상품 삭제
            unset($cart[$id]);
            session()->put('cart', $cart);
            return redirect()->back()->with('success', '항목이 장바구니에서 삭제되었습니다.');
        }

        return redirect()->back()->with('error', '항목을 찾을 수 없습니다.');
    }

    public function checkout(Request $request)
    {
        // 세션에서 로그인 여부 확인
        if (!$request->session()->has('user_id')) {
            return redirect()->route('login.get')->with('error', '구매를 진행하려면 로그인이 필요합니다.');
        }

        // 세션에서 장바구니 데이터 가져오기
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', '장바구니가 비어 있습니다.');
        }

        // 총 금액 계산
        $totalPrice = array_reduce($cart, function ($sum, $item) {
            return $sum + ($item['price'] * $item['quantity']);
        }, 0);

        try {
            // 주문 생성
            $order = Order::create([
                'user_id' => $request->session()->get('user_id'), // 세션에서 사용자 ID 가져오기
                'total_price' => $totalPrice,
            ]);

            // 주문 항목 생성
            foreach ($cart as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);
            }

            // 세션에서 장바구니 비우기
            session()->forget('cart');

            return redirect()->route('cart.success')->with('success', '구매가 완료되었습니다.');
        } catch (\Exception $e) {
            return redirect()->route('cart.index')->with('error', '구매 처리 중 문제가 발생했습니다.');
        }
    }
}
