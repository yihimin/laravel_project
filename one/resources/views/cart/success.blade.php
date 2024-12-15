@extends('layout')

@section('content')
<section class="py-5">
    <div class="container px-4 px-lg-5 my-5 text-center">
        <h1 class="display-5 fw-bolder">구매가 완료되었습니다!</h1>
        <p class="lead">구매해 주셔서 감사합니다. 상품이 곧 배송될 예정입니다.</p>
        <a href="{{ route('home') }}" class="btn btn-primary mt-3">홈으로 돌아가기</a>
    </div>
</section>
@endsection
