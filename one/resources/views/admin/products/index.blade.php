@extends('admin_layout')

@section('content')
<div class="container py-5" style="background-color: #F3E9DC; border-radius: 10px;">
    <!-- 제목 -->
    <h1 class="mb-4 text-center" style="color: #6B4226;">제품 관리</h1>
    
    @if(session('success'))
        <div class="alert alert-success text-center" style="background-color: #8C6450; color: #FFF; border-color: #6B4226;">
            {{ session('success') }}
        </div>
    @endif

    <!-- 검색창 -->
    <div class="d-flex justify-content-between mb-3 align-items-center">
        <form method="GET" action="{{ route('admin.products.index') }}" class="d-flex align-items-center">
            <input type="text" name="search" 
                   class="form-control me-2" 
                   placeholder="제품명 또는 설명 검색"
                   value="{{ request('search') }}"
                   style="border: 1px solid #C4A484; border-radius: 5px; background-color: #F9F5F0; color: #6B4226; height: 38px;">
            <button type="submit" 
                    class="btn"
                    style="background-color: #8C6450; color: #FFF; border-radius: 5px; height: 38px; padding: 6px 12px; font-size: 14px; white-space: nowrap;">
                검색
            </button>
        </form>
        <a href="{{ route('admin.products.create') }}" 
           class="btn"
           style="background-color: #8C6450; color: #FFF; border-radius: 5px; height: 38px; padding: 6px 12px; font-size: 14px;">
           제품 추가
        </a>
    </div>

    <!-- 테이블 -->
    <table class="table table-bordered text-center" style="border-color: #C4A484;">
        <thead style="background-color: #6B4226; color: #FFF;">
            <tr>
                <th>이미지</th>
                <th>제품명</th>
                <th>설명</th>
                <th>가격</th>
                <th>재고</th>
                <th>작업</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr style="background-color: #F9F5F0; color: #6B4226;">
                <td>
                    <img src="{{ asset('my/images/' . $product->image_path) }}" 
                         alt="{{ $product->name }}" 
                         style="width: 50px; border-radius: 5px; border: 1px solid #C4A484;">
                </td> 
                <td>{{ $product->name }}</td>
                <td>{{ $product->description }}</td>
                <td>₩{{ number_format($product->price) }}</td>
                <td>{{ $product->stock }}</td>
                <td>
                    <div class="d-flex justify-content-around">
                        <!-- 수정 버튼 -->
                        <a href="{{ route('admin.products.edit', $product->id) }}" 
                           class="btn btn-sm me-2" 
                           style="background-color: #A67B5B; color: #FFF; border-radius: 5px; white-space: nowrap;">
                            수정
                        </a>
                        
                        <!-- 삭제 버튼 -->
                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" 
                              onsubmit="return confirm('정말 삭제하시겠습니까?');" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="btn btn-sm" 
                                    style="background-color: #D9534F; color: #FFF; border-radius: 5px; white-space: nowrap;">
                                삭제
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @include('mypagination', ['paginator' => $products])
</div>
@endsection
