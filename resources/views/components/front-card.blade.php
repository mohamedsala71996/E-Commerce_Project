@props(['product'])


<!-- Start Single Product -->
<div class="single-product">
    <div class="product-image">
            <img src="{{$product->image ? asset("storage/$product->image") : $product->ImageUrl }}" alt="#">
        @if ($product->discount_percent)
            <span class="sale-tag">-{{ number_format($product->discount_percent, 2, '.', ',') }}%</span>
        @endif
        {{-- <div class="button">
            <a href="{{ route('carts.store',$product->id) }}" class="btn"><i class="lni lni-cart"></i> Add to
                Cart</a>
        </div> --}}
    </div>
    <div class="product-info">
        <span class="category">{{ $product->category->name }}</span>
        <h4 class="title">
            <a href="{{ route('product.show',$product->slug) }}">{{ $product->name }}</a>
        </h4>
        <ul class="review">
            <li><i class="lni lni-star-filled"></i></li>
            <li><i class="lni lni-star-filled"></i></li>
            <li><i class="lni lni-star-filled"></i></li>
            <li><i class="lni lni-star-filled"></i></li>
            <li><i class="lni lni-star-filled"></i></li>
            <li><span>Review(s)</span></li>
        </ul>
        <div class="price">
            <span>{{ currencyFormat::Format($product->price) }}</span>
            @if ($product->compare_price)
                <span class="discount-price">{{ currencyFormat::Format($product->compare_price) }}</span>
            @endif
        </div>
    </div>
</div>
<!-- End Single Product -->
