<x-front-layout title='Cart'>
    <x-slot name='breadcrumbs'>
        <!-- Start Breadcrumbs -->
        <div class="breadcrumbs">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="breadcrumbs-content">
                            <h1 class="page-title"></h1>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <ul class="breadcrumb-nav">
                            <li><a href="#"><i></i>shop</a></li>
                            <li><a href="#"><i></i>Cart</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Breadcrumbs -->
    </x-slot>

    <!-- Shopping Cart -->
    <div class="shopping-cart section">
        <div class="container">
            <div class="cart-list-head">
                <!-- Cart List Title -->
                <div class="cart-list-title">
                    <div class="row">
                        <div class="col-lg-1 col-md-1 col-12">

                        </div>
                        <div class="col-lg-4 col-md-3 col-12">
                            <p>Product Name</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <p>Quantity</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <p>Subtotal</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <p>Price</p>
                        </div>
                        <div class="col-lg-1 col-md-2 col-12">
                            <p>Remove</p>
                        </div>
                    </div>
                </div>
                <!-- End Cart List Title -->

                <!-- Cart Single List list -->
                @forelse ($items as $item)
                    <div class="cart-single-list" id="{{ $item->id }}">
                        <div class="row align-items-center">
                            <div class="col-lg-1 col-md-1 col-12">
                                <a href="{{ route('product.show', $item->product->slug) }}"><img
                                        src="{{ $item->product->image ? asset('storage/' . $item->product->image) : $item->product->ImageUrl }}"
                                        alt="#"></a>
                            </div>
                            <div class="col-lg-4 col-md-3 col-12">
                                <h5 class="product-name"><a
                                        href="{{ route('product.show', $item->product->slug) }}">{{ $item->product->name }}</a>
                                </h5>
                                <p class="product-des">
                                    <span><em>Type:</em> Mirrorless</span>
                                    <span><em>Color:</em> Black</span>
                                </p>
                            </div>
                            <div class="col-lg-2 col-md-2 col-12">
                                <div class="count-input">
                                    <input type="number" class="form-control item-quantity" data-id="{{ $item->id }}"
                                        value="{{ $item->quantity }}">
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-12">
                                <p>{{ currencyFormat::Format($item->product->price * $item->quantity) }}</p>
                            </div>
                            <div class="col-lg-2 col-md-2 col-12">
                                <p>{{ currencyFormat::Format($item->product->price) }}</p>
                            </div>
                            <div class="col-lg-1 col-md-2 col-12">
                                <a class="remove-item" data-id="{{ $item->id }}" href="javascript:void(0)"><i class="lni lni-close"></i></a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center mt-5">
                        <p>No items in the cart.</p>
                    </div>
                @endforelse
                <!-- End Single List list -->


            </div>
            <div class="row">
                <div class="col-12">
                    <!-- Total Amount -->
                    <div class="total-amount">
                        <div class="row">
                            <div class="col-lg-8 col-md-6 col-12">
                                <div class="left">
                                    <div class="coupon">
                                        <form action="#" target="_blank">
                                            <input name="Coupon" placeholder="Enter Your Coupon">
                                            <div class="button">
                                                <button class="btn">Apply Coupon</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="right">
                                    <ul>
                                        <li>Cart Subtotal<span>{{ currencyFormat::Format($total) }}</span></li>
                                        <li>Shipping<span>Free</span></li>
                                        <li>You Save<span>$29.00</span></li>
                                        <li class="last">You Pay<span>$2531.00</span></li>
                                    </ul>
                                    <div class="button">
                                        <a href="{{ route('checkout.create') }}" class="btn">Checkout</a>
                                        <a href="product-grids.html" class="btn btn-alt">Continue shopping</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ End Total Amount -->
                </div>
            </div>
        </div>
    </div>
    <!--/ End Shopping Cart -->

    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script>
            const csrf_token = "{{ csrf_token() }}";

            (function($) {

                $('.item-quantity').on('change', function(e) {

                    $.ajax({
                        url: "/carts/" + $(this).data('id'), //data-id
                        method: 'put',
                        data: {
                            quantity: $(this).val(),
                            _token: csrf_token
                        }
                    });
                });

                $('.remove-item').on('click', function(e) {

                    let id = $(this).data('id');
                    $.ajax({
                        url: "/carts/" + id, //data-id
                        method: 'delete',
                        data: {
                            _token: csrf_token
                        },
                        success: response => {
                            $(`#${id}`).remove();
                        }
                    });
                });

                $('.add-to-cart').on('click', function(e) {

                    $.ajax({
                        url: "/cart",
                        method: 'post',
                        data: {
                            product_id: $(this).data('id'),
                            quantity: $(this).data('quantity'),
                            _token: csrf_token
                        },
                        success: response => {
                            alert('product added')
                        }
                    });
                });

            })(jQuery);
        </script>
    @endpush

</x-front-layout>
