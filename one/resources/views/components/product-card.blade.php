<div class="col mb-5">
    <div class="card h-100">
        <!-- Product image -->
        <a href="{{ route('products.show', $product->id) }}">
        <img class="card-img-top" src="{{ asset('my/images/' . $product->image_path) }}" alt="{{ $product->name }}">
        </a>
        <!-- Product details -->
        <div class="card-body p-4">
            <div class="text-center">
                <!-- Product name -->
                <a href="{{ route('products.show', $product->id) }}" class="text-decoration-none text-dark">
                    <h5 class="fw-bolder">{{ $product->name }}</h5>
                </a>
                <!-- Product price -->
                @if($product->sale_price)
                    <span class="text-muted text-decoration-line-through">₩{{ number_format($product->price) }}</span>
                    ₩{{ number_format($product->sale_price) }}
                @else
                    ₩{{ number_format($product->price) }}
                @endif
            </div>
        </div>
        <!-- Product actions -->
        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
            <div class="text-center">
                <form action="{{ route('cart.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <button class="btn btn-outline-dark mt-auto" type="submit">장바구니 담기</button>
                </form>
            </div>
        </div>
    </div>
</div>
