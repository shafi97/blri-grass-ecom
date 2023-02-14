@extends('frontend.layouts.app')
@section('content')
    <link rel="stylesheet" href="https://unpkg.com/xzoom/dist/xzoom.css">
    <!-- Start Product Area -->
    <div class="product-area section">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <img class="xzoom" src="{{ imagePath('product', $product->file->file) }}"
                        xoriginal="{{ imagePath('product', $product->file->file) }}" />
                    <div class="xzoom-thumbs">
                        @foreach ($product->files as $file)
                            <a href="{{ imagePath('product', $file->file) }}">
                                <img class="xzoom-gallery" width="80" src="{{ imagePath('product', $file->file) }}"
                                    xpreview="{{ imagePath('product', $file->file) }}">
                            </a>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-4">
                    <h1>{{ $product->name }}</h1>
                    <hr>
                    <p>Weight: {{ $product->weight }}</p>
                    <p>Size: {{ $product->size }}</p>
                    <p>Color: {{ $product->color }}</p>
                    <p>Age: {{ ageWithDays($product->d_o_b) }}</p>
                    <hr>
                    <div class="product-price" style="font-size: 25px">
                        <span>&#2547;
                            {{ number_format($product->price - ($product->price * $product->discount) / 100) }}</span>
                    </div>
                    <div class="discount" style="font-size: 16px">
                        @if ($product->discount > 0)
                            <span class="tk">&#2547;{{ number_format($product->price) }}</span>
                            <span>-{{ number_format($product->discount) }}%</span>
                        @else
                            <br>
                        @endif
                    </div>
                    <hr>
                    <form action="{{ route('frontend.shipping.store') }}" method="post">
                        <div class="row">

                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <div class="col-md-4">
                                <p>Quantity</p>
                            </div>
                            <div class="col-md-8">
                                <div class="button-container d-flex">
                                    <button class="cart-qty-minus p-2" type="button" value="-">
                                        <i class="fa-solid fa-minus"></i>
                                    </button>
                                    <input type="text" name="quantity" min="1" class="qty form-control"
                                        value="{{ $cart->quantity ?? 1 }}" />
                                    <button class="cart-qty-plus p-2" type="button" value="+">
                                        <i class="fa-solid fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <br>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                @auth
                                    <button type="submit" class="btn btn-secondary">Buy Now</button>
                                @endauth
                                @guest
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#loginModal">Buy
                                        Now</button>
                                @endguest
                            </div>
                    </form>
                    <div class="col-md-6">
                        <form onsubmit="cart(event,'{{ $product->id }}')">
                            @csrf
                            @auth
                                <button type="submit" class="btn btn-primary">Add to cart</button>
                            @endauth
                            @guest
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#loginModal">Add
                                    to cart</button>
                            @endguest
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-3" style="background: rgb(238, 238, 238); padding: 10px !important; border-radius: 5px">
                <div class="d-flex justify-content-between">
                    <p>Delivery </p>
                    <p><a href="">Change</a></p>
                </div>
                <p><i class="fa-solid fa-location-dot"></i> {{ user()->district->name ?? '' }},
                    {{ user()->upazila->name ?? '' }}, {{ user()->union->name ?? '' }}, {{ user()->address ?? '' }}
                </p>
                <hr>
                <div class="d-flex justify-content-between">
                    <p><i class="fa-solid fa-truck"></i> Standard Delivery </p>
                    <p>&#2547; 50</p>
                </div>
                <p><i class="fa-solid fa-money-bill"></i> Cash on Delivery Available</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <p>{{ $product->description }}</p>
            </div>
        </div>
    </div>
    </div>
    <!-- End Product Area -->

    @push('custom_scripts')
        <script src="https://unpkg.com/xzoom/dist/xzoom.min.js"></script>
        <script>
            $(".xzoom, .xzoom-gallery").xzoom({
                tint: '#333',
                Xoffset: 15
            });

            // -----------------for-Shopping-cart-------------
            $(document).ready(function() {
                update_amounts();
                $('.qty, .price').on('keyup keypress blur change', function(e) {
                    update_amounts();
                });
            });

            function update_amounts() {
                var sum = 0.0;
                $('#myTable > tbody  > tr').each(function() {
                    var qty = $(this).find('.qty').val();
                    var price = $(this).find('.price').val();
                    var amount = (qty * price)
                    sum += amount;
                    $(this).find('.amount').text('' + amount);
                });
                $('.total').text(sum);
            }



            //----------------for quantity-increment-or-decrement-------
            var incrementQty;
            var decrementQty;
            var plusBtn = $(".cart-qty-plus");
            var minusBtn = $(".cart-qty-minus");
            var incrementQty = plusBtn.click(function() {
                var $n = $(this)
                    .parent(".button-container")
                    .find(".qty");
                $n.val(Number($n.val()) + 1);
                update_amounts();
            });

            var decrementQty = minusBtn.click(function() {
                var $n = $(this)
                    .parent(".button-container")
                    .find(".qty");
                var QtyVal = Number($n.val());
                if (QtyVal > 1) {
                    $n.val(QtyVal - 1);
                }
                update_amounts();
            });
        </script>
    @endpush
@endsection
