@extends('frontend.layouts.app')
@section('content')

	<!-- Start Product Area -->
    <div class="product-area section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center pb-4">
                        <h2>
                            @if (request()->routeIs('productByCat'))
                            {{ $products->first()->category->name }}
                            @else
                            {{ $products->first()->category->name }} <i class="fa-solid fa-chevron-right"></i>
                            {{ $products->first()->subCategory->name }}
                            @endif
                        </h2>
                    </div>
                </div>
            </div>
            <div class="">
                <div class="row  slick-arrow-1">
                    <!-- ltn__product-item -->
                    @foreach ($products as $product)
                        <div class="col-lg-3">
                            <div class="ltn__product-item ltn__product-item-3 text-center">
                                <div class="product-img">
                                    <a href="{{ route('product.show', $product->id) }}">
                                        <img src="{{ imagePath('product', $product->file->file) }}" alt="#">
                                    </a>
                                    <div class="product-badge">
                                        <ul>
                                            <li class="sale-badge">-{{ number_format($product->discount) }}%</li>
                                        </ul>
                                    </div>
                                    <div class="product-hover-action">
                                        <ul>
                                            <li>
                                                <a href="#" title="Quick View" data-toggle="modal"
                                                    class="productQuickView"
                                                    data-our_product_name="{{ $product->name }}"
                                                    data-our_product_price="{{ number_format($product->price) }}"
                                                    data-our_product_dis_price="{{ number_format($product->price - ($product->price * $product->discount) / 100) }}"
                                                    data-our_product_image="{{ imagePath('product', $product->file->file) }}"
                                                    data-target="#quick_view_modal">
                                                    <i class="far fa-eye"></i>
                                                </a>
                                            </li>
                                            <li>
                                                @auth
                                                    <a href="javascript:;" title="Add to Cart" class="addToCartView"
                                                        onclick="cart(event,'{{ $product->id }}')">
                                                        <i class="fas fa-shopping-cart"></i>
                                                    </a>
                                                @endauth
                                                @guest
                                                    <a href="javascript:;" data-toggle="modal" data-target="#loginModal">
                                                        <i class="fas fa-shopping-cart"></i>
                                                    </a>
                                                @endguest
                                            </li>
                                            <li>
                                                @auth
                                                    <a href="javascript:;" title="Wishlist"
                                                        onclick="wishlist(event, '{{ $product->id }}')">
                                                        <i class="far fa-heart"></i>
                                                    </a>
                                                @endauth
                                                @guest
                                                    <a href="javascript:;" data-toggle="modal" data-target="#loginModal">
                                                        <i class="fas fa-shopping-cart"></i>
                                                    </a>
                                                @endguest
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <div class="product-ratting">
                                        <ul>
                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                            <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                            <li><a href="#"><i class="far fa-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <h2 class="product-title"><a
                                            href="{{ route('product.show', $product->id) }}">{{ $product->name }}</a>
                                    </h2>
                                    <div class="product-price">
                                        <span>&#2547;{{ number_format($product->price - ($product->price * $product->discount) / 100) }}</span>
                                        <del>&#2547;{{ number_format($product->price) }}</del>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
	<!-- End Product Area -->


    @push('custom_scripts')

   @endpush
@endsection
