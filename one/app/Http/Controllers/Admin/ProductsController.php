<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Producti;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * 제품 목록 표시
     */
    public function index(Request $request)
    {
        $search = $request->query('search');

        $products = Producti::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%")
                         ->orWhere('description', 'like', "%{$search}%");
        })->paginate(5);

        return view('admin.products.index', compact('products'));
    }

    /**
     * 제품 추가 폼 표시
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * 제품 저장
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->only(['name', 'description', 'price', 'stock']);

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->file('image')->extension();
            $request->file('image')->move(public_path('my/images'), $imageName);
            $data['image_path'] = $imageName;
        }

        Producti::create($data);

        return redirect()->route('admin.products.index')->with('success', '제품이 추가되었습니다.');
    }

        public function edit($id)
    {
        $product = Producti::findOrFail($id); // Producti 모델에서 ID에 해당하는 제품 조회
        return view('admin.products.edit', compact('product')); // edit 뷰로 데이터 전달
    }

    public function update(Request $request, $id)
{
    // 유효성 검사
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'price' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // 제품 찾기
    $product = Producti::findOrFail($id);

    // 데이터 업데이트
    $data = $request->only(['name', 'description', 'price', 'stock']);

    // 이미지 파일이 존재하면 업로드 처리
    if ($request->hasFile('image')) {
        $imageName = time() . '.' . $request->file('image')->extension();
        $request->file('image')->move(public_path('my/images'), $imageName);

        // 기존 이미지 삭제 (선택사항)
        if ($product->image_path && file_exists(public_path('my/images/' . $product->image_path))) {
            unlink(public_path('my/images/' . $product->image_path));
        }

        $data['image_path'] = $imageName;
    }

    // 데이터베이스 업데이트
    $product->update($data);

    return redirect()->route('admin.products.index')->with('success', '제품이 수정되었습니다.');
}

public function destroy($id)
{
    // 제품 찾기
    $product = Producti::findOrFail($id);
    
    // 이미지 파일 삭제 (선택 사항)
    if ($product->image_path && file_exists(public_path('my/images/' . $product->image_path))) {
        unlink(public_path('my/images/' . $product->image_path));
    }

    // 제품 삭제
    $product->delete();

    return redirect()->route('admin.products.index')->with('success', '제품이 삭제되었습니다.');
}


}
