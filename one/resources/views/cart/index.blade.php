@extends('layout')

@section('content')
<section class="py-5">
    <div class="container px-4 px-lg-5 my-5">
        <h1 class="display-5 fw-bolder">장바구니</h1>
        
        <!-- 성공 메시지 -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- 장바구니 내용 -->
        @if (count($cart) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>이미지</th>
                    <th>상품명</th>
                    <th>가격</th>
                    <th>수량</th>
                    <th>삭제</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cart as $item)
                <tr>
                    <td>
                        <img src="{{ asset('my/images/' . $item['image_path']) }}" 
                             alt="{{ $item['name'] }}" 
                             style="width: 50px;">
                    </td>
                    <td>{{ $item['name'] }}</td>
                    <td>₩{{ number_format($item['price']) }}</td>
                    <td>{{ $item['quantity'] }}</td>
                    <td>
                        <form action="{{ route('cart.remove', $item['id']) }}" method="POST" onsubmit="return confirm('이 항목을 삭제하시겠습니까?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">삭제</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- 구매하기 버튼 -->
        <div class="mt-3">
            <form action="{{ route('cart.checkout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success w-100">
                    구매하기
                </button>
            </form>
        </div>
        @else
        <p class="text-muted">장바구니가 비어 있습니다.</p>
        @endif

    </div>
</section>
@endsection
