<div class="col">
    <div class="product-card">
        <div class="img-wrap">
            @if($product->badge)
                <span class="badge-overlay badge-{{ $product->badge }}">
                    {{ strtoupper($product->badge) }}
                </span>
            @endif
            <a href="{{ route('products.show', $product->slug) }}">
                <img src="{{ $product->imageUrl }}" alt="{{ $product->name }}" loading="lazy">
            </a>
        </div>
        <div class="card-body">
            <div class="category-label">{{ $product->category->name ?? '' }}</div>
            <a href="{{ route('products.show', $product->slug) }}" class="d-block">
                <div class="product-name">{{ $product->name }}</div>
            </a>
            <div class="d-flex align-items-center flex-wrap">
                <span class="price-new">${{ number_format($product->price, 2) }}</span>
                @if($product->old_price)
                    <span class="price-old">${{ number_format($product->old_price, 2) }}</span>
                @endif
            </div>
            <x-whatsapp-button :product="$product" label="Commander" class="btn btn-whatsapp btn-sm w-100 mt-2 justify-content-center" />
        </div>
    </div>
</div>
