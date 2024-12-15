@extends('admin_layout')

@section('content')
<div class="container py-5">
    <h1 class="mb-4 text-center">제품 수정</h1>

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">제품명</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $product->name }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">설명</label>
            <textarea name="description" id="description" class="form-control" rows="3" required>{{ $product->description }}</textarea>
        </div>
        <div class="mb-3">
            <label for="price_display" class="form-label">가격 (₩)</label>
            <input type="text" id="price_display" class="form-control" value="₩{{ number_format($product->price) }}" required>
            <input type="hidden" name="price" id="price" value="{{ $product->price }}"> <!-- 실제 저장될 값 -->
        </div>
        <div class="mb-3">
            <label for="stock" class="form-label">재고</label>
            <input type="number" name="stock" id="stock" class="form-control" value="{{ $product->stock }}" required>
        </div>
        <div class="mb-3">
            <label for="image_path" class="form-label">이미지 경로</label>
            <input type="text" name="image_path" id="image_path" class="form-control" value="{{ $product->image_path }}">
        </div>
        <button type="submit" class="btn btn-primary w-100">저장</button>
    </form>
</div>
@endsection
