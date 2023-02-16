@extends('frontend.layouts.app')
@section('content')
    <!-- Start Product Area -->
    <div class="product-area section">
        <div class="liton__wishlist-area mb-105">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="shoping-cart-inner">
                            <div class="">
                                <style>
                                    table tr td {
                                        vertical-align: middle !important;
                                    }

                                    table tr th {
                                        text-align: center
                                    }
                                </style>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th><i class="fa-solid fa-trash text-danger"></i></th>
                                            <th class="cart-product-image">Image</th>
                                            <th class="cart-product-info">Title</th>
                                            <th class="cart-product-price">Price</th>
                                            <th class="cart-product-quantity">Quantity</th>
                                            <th class="cart-product-subtotal">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody id="wishlist">
                                        {{-- @foreach ($wishlists as $wishlist)
                                            <tr>
                                                <td class="cart-product-remove text-center">x</td>
                                                <td class="cart-product-image">
                                                    <a href="product-details.html"><img src="{{ imagePath('product', $wishlist->product->file->file) }}"
                                                            alt="#"></a>
                                                </td>
                                                <td class="cart-product-info">
                                                    <h4><a href="product-details.html">{{ $wishlist->product->name }}</a>
                                                    </h4>
                                                </td>
                                                <td class="cart-product-price">
                                                    &#2547; {{ number_format($wishlist->product->price - ($wishlist->product->price * $wishlist->product->discount) / 100) }}
                                                </td>
                                                <td class="cart-product-stock">In Stock</td>
                                                <td class="cart-product-add-cart text-center">
                                                    @auth
                                                        <a class="submit-button-1" href="#" title="Add to Cart"
                                                         onclick="cart(event,'{{ $wishlist->id }}')">Add to Cart</a>
                                                    @endauth
                                                    @guest
                                                        <a href="javascript:;" data-toggle="modal" data-target="#loginModal">
                                                            <i class="fas fa-shopping-cart"></i>
                                                        </a>
                                                    @endguest

                                                </td>
                                            </tr>
                                        @endforeach --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Product Area -->

    @push('custom_scripts')
        <script>
            wishlistShow()

            function wishlistShow() {
                $.ajax({
                    url: '{{ route('frontend.wishlist.show') }}',
                    method: 'get',
                    success: function(res) {
                        if (res.status == 'success') {
                            $('#wishlist').html(res.html);
                        }
                    }
                });
            }

            function wishlistDelete(e, wishlist_id) {
                e.preventDefault();
                $.ajax({
                    url: '{{ route('frontend.wishlist.destroy') }}',
                    type: 'delete',
                    data: {
                        id: wishlist_id,
                    },
                    success: res => {
                        wishlistShow()
                        toast('success', res.message)
                    },
                    error: err => {}
                });
            }

            function wishlistAddToCart(e, wishlist_id) {
                e.preventDefault();
                $.ajax({
                    url: '{{ route('frontend.wishlist.wishlistAddToCart') }}',
                    type: 'post',
                    data: {
                        id: wishlist_id,
                    },
                    success: res => {
                        wishlistShow()
                        toast('success', res.message)
                    },
                    error: err => {}
                });
            }
        </script>
    @endpush
@endsection
