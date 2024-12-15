@extends('admin_layout')

@section('content')
<div class="container py-5">
    <h1 class="mb-4 text-center">제품 관리</h1>
    
    @if(session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-striped table-bordered">
        <thead>
        <thead style="background-color: #6C757D; color: #FFF;">
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
            <tr>
                <td><img src="{{ asset('my/images/' . $product->image_path) }}" alt="{{ $product->name }}" style="width: 50px;"></td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->description }}</td>
                <td>₩{{ number_format($product->price) }}</td>
                <td>{{ $product->stock }}</td>
                <td>
                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-secondary btn-sm me-2">수정</a>
                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('정말 삭제하시겠습니까?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">삭제</button>
                    </form>
                </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection