@extends('admin_layout')

@section('content')
<div class="container py-5" style="background-color: #F3E9DC; border-radius: 10px;">
    <!-- 제목 -->
    <h1 class="mb-4 text-center" style="color: #6B4226;">제품 추가</h1>
    
    <!-- 에러 메시지 표시 -->
    @if($errors->any())
        <div class="alert alert-danger" style="border-color: #A67B5B;">
            <ul>
                @foreach($errors->all() as $error)
                    <li style="color: #6B4226;">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- 제품 추가 폼 -->
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- 제품명 -->
        <div class="mb-3">
            <label for="name" class="form-label" style="color: #6B4226;">제품명</label>
            <input type="text" name="name" id="name" class="form-control" 
                   placeholder="제품명을 입력하세요" required
                   style="border: 1px solid #C4A484; background-color: #F9F5F0; color: #6B4226;">
        </div>

        <!-- 설명 -->
        <div class="mb-3">
            <label for="description" class="form-label" style="color: #6B4226;">설명</label>
            <textarea name="description" id="description" rows="3" class="form-control" 
                      placeholder="제품 설명을 입력하세요"
                      style="border: 1px solid #C4A484; background-color: #F9F5F0; color: #6B4226;"></textarea>
        </div>

        <!-- 가격 -->
        <div class="mb-3">
            <label for="price" class="form-label" style="color: #6B4226;">가격</label>
            <input type="number" name="price" id="price" class="form-control" 
                   placeholder="가격을 입력하세요" required
                   style="border: 1px solid #C4A484; background-color: #F9F5F0; color: #6B4226;">
        </div>

        <!-- 재고 -->
        <div class="mb-3">
            <label for="stock" class="form-label" style="color: #6B4226;">재고</label>
            <input type="number" name="stock" id="stock" class="form-control" 
                   placeholder="재고 수량을 입력하세요" required
                   style="border: 1px solid #C4A484; background-color: #F9F5F0; color: #6B4226;">
        </div>

        <!-- 이미지 파일 -->
        <div class="mb-3">
            <label for="image" class="form-label" style="color: #6B4226;">이미지 파일</label>
            <input type="file" name="image" id="image" class="form-control" accept="image/*"
                   style="border: 1px solid #C4A484; background-color: #F9F5F0; color: #6B4226;">
        </div>

        <!-- 버튼 -->
        <div class="text-center">
            <button type="submit" class="btn" 
                    style="background-color: #8C6450; color: #FFF; border-radius: 5px; padding: 8px 20px;">
                제품 추가
            </button>
            <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary" 
               style="border-radius: 5px; padding: 8px 20px;">
                취소
            </a>
        </div>
    </form>
</div>
@endsection
