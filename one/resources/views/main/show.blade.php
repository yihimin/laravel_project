@extends('layout')

@section('content')
<section class="py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="row">
            <div class="col-md-6">
                <!-- Product image -->
                <img class="card-img-top mb-5 mb-md-0" src="{{ asset('my/images/' . $product->image_path) }}" alt="{{ $product->name }}">
            </div>
            <div class="col-md-6">
                <h1 class="display-5 fw-bolder">{{ $product->name }}</h1>
                <div class="fs-5 mb-5">
                    <span>₩{{ number_format($product->price) }}</span>
                </div>
                <p class="lead">{{ $product->description }}</p>
                <div class="d-flex">
                    <input class="form-control text-center me-3" type="number" value="1" style="max-width: 3rem">
                    <form action="{{ route('cart.store') }}" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <button class="btn btn-outline-dark mt-auto" type="submit">장바구니 담기</button>
        </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
