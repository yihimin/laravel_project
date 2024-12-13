<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Producti;

class AdminController extends Controller
{
    public function products()
    {
        $products = Producti::all(); // Producti는 모델 이름
        return view('admin.products.index', compact('products'));
    }

    // 제품 관련 메서드
    public function editProduct($id)
    {
        $product = Producti::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    public function updateProduct(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image_path' => 'nullable|string',
        ]);

        $product = Producti::findOrFail($id);
        $product->update($request->all());

        return redirect()->route('admin.products.index')->with('success', '제품이 수정되었습니다.');
    }

    public function destroyProduct($id)
    {
        $product = Producti::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', '제품이 삭제되었습니다.');
    }

    public function users()
    {
        // 사용자 데이터 가져오기
        $users = User::all(); // 모든 사용자 가져오기
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'is_admin' => 'required|boolean',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'is_admin' => $request->is_admin,
        ]);

        return redirect()->route('admin.users.index')->with('success', '사용자가 추가되었습니다.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'is_admin' => 'required|boolean',
        ]);

        $user = User::findOrFail($id);
        $user->update($request->only('name', 'email', 'is_admin'));

        return redirect()->route('admin.users.index')->with('success', '사용자가 수정되었습니다.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', '사용자가 삭제되었습니다.');
    }

    public function stats()
    {
        // 상품별 판매 통계
        $productStats = \DB::table('order_items')
            ->join('producti', 'order_items.product_id', '=', 'producti.id')
            ->select(
                'producti.name as product_name',
                \DB::raw('SUM(order_items.quantity) as total_quantity'),
                \DB::raw('SUM(order_items.price * order_items.quantity) as total_sales')
            )
            ->groupBy('producti.name')
            ->orderBy('total_sales', 'DESC')
            ->get();
    
        // 날짜별 매출 통계
        $dailySales = \DB::table('order_items')
            ->select(
                \DB::raw('DATE(created_at) as sale_date'),
                \DB::raw('SUM(price * quantity) as total_sales')
            )
            ->groupBy(\DB::raw('DATE(created_at)'))
            ->orderBy('sale_date', 'DESC')
            ->get();
    
        // JSON 데이터로 변환
        $productNames = $productStats->pluck('product_name');
        $productSales = $productStats->pluck('total_sales');
        $dailyDates = $dailySales->pluck('sale_date');
        $dailyTotals = $dailySales->pluck('total_sales');
    
        return view('admin.stats.index', compact('productStats', 'dailySales', 'productNames', 'productSales', 'dailyDates', 'dailyTotals'));
    }    
}
