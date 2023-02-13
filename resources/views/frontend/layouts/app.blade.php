<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Broccoli - Organic Food HTML Template</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Place favicon.png in the root directory -->
    <link rel="shortcut icon" href="{{ asset('frontend/img/favicon.png') }}" type="image/x-icon" />
    <!-- Font Icons css -->
    <link rel="stylesheet" href="{{ asset('frontend/css/font-icons.css') }}">
    <!-- plugins css -->
    <link rel="stylesheet" href="{{ asset('frontend/css/plugins.css') }}">
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <!-- Responsive css -->
    <link rel="stylesheet" href="{{ asset('frontend/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/custom.css') }}">
</head>

<body>
    <!--[if lte IE 9]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
    <![endif]-->

    <!-- Add your site or application content here -->

    <!-- Body main wrapper start -->
    <div class="body-wrapper">

        @include('frontend.layouts.includes.top_header')
        @include('frontend.layouts.includes.navigation')

        @yield('content')

        <!-- FOOTER AREA START -->
        @include('frontend.layouts.includes.footer')
        <!-- FOOTER AREA END -->

        <!-- MODAL AREA START (Add To Cart Modal) -->
        <div class="ltn__modal-area ltn__add-to-cart-modal-area">
            <div class="modal fade" id="add_to_cart_modal" tabindex="-1">
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="ltn__quick-view-modal-inner">
                                <div class="modal-product-item">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="modal-product-img">
                                                <img src="img/product/1.png" alt="#">
                                            </div>
                                            <div class="modal-product-info">
                                                <h5><a href="product-details.html" class="cart_product_name"></a></h5>
                                                <p class="added-cart"><i class="fa fa-check-circle"></i> Successfully
                                                    added to your Cart</p>
                                                <div class="btn-wrapper">
                                                    <a href="cart.html" class="theme-btn-1 btn btn-effect-1">View
                                                        Cart</a>
                                                    <a href="checkout.html"
                                                        class="theme-btn-2 btn btn-effect-2">Checkout</a>
                                                </div>
                                            </div>
                                            <!-- additional-info -->
                                            <div class="additional-info d-none">
                                                <p>We want to give you <b>10% discount</b> for your first order, <br>
                                                    Use discount code at checkout</p>
                                                <div class="payment-method">
                                                    <img src="img/icons/payment.png" alt="#">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- MODAL AREA END -->

        <!-- MODAL AREA START (Wishlist Modal) -->
        <div class="ltn__modal-area ltn__add-to-cart-modal-area">
            <div class="modal fade" id="liton_wishlist_modal" tabindex="-1">
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="ltn__quick-view-modal-inner">
                                <div class="modal-product-item">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="modal-product-img">
                                                <img src="img/product/7.png" alt="#">
                                            </div>
                                            <div class="modal-product-info">
                                                <h5><a href="product-details.html">Vegetables Juices</a></h5>
                                                <p class="added-cart"><i class="fa fa-check-circle"></i> Successfully
                                                    added to your Wishlist</p>
                                                <div class="btn-wrapper">
                                                    <a href="wishlist.html" class="theme-btn-1 btn btn-effect-1">View
                                                        Wishlist</a>
                                                </div>
                                            </div>
                                            <!-- additional-info -->
                                            <div class="additional-info d-none">
                                                <p>We want to give you <b>10% discount</b> for your first order, <br>
                                                    Use discount code at checkout</p>
                                                <div class="payment-method">
                                                    <img src="img/icons/payment.png" alt="#">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- MODAL AREA END -->

        <!-- Login Modal Start -->
        <div style="max-width: 50%">
            <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <form action="{{ route('login') }}" method="post">
                            @csrf
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <div class="text-center">
                                            <h4>Sign In</h4>
                                            <p>Sign In to your account</p>
                                            @if ($errors->any())
                                                <div class="alert alert-danger">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label for="inputEmail" class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control" id="inputEmail">
                                    </div>
                                    <div class="col-12">
                                        <label for="inputPassword" class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control"
                                            id="inputPassword">
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <div class="form-check">
                                            <input type="checkbox" name="remember" class="form-check-input"
                                                id="exampleCheck1">
                                            <label class="form-check-label" for="exampleCheck1">Remember
                                                Me</label>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6 text-right">
                                        <a href="{{ route('password.request') }}">Forgot Password?</a>
                                    </div>
                                    <div class="col-12 text-center">
                                        <div class="">
                                            <button type="submit" class="btn btn-primary">Sign In</button>
                                        </div>
                                    </div>

                                    <div class="col-12 text-center">
                                        <div class="">
                                            <br>
                                            <span>Don’t have an account? </span><a
                                                href="{{ route('frontend.registerView') }}"
                                                style="font-size: 18px; color:#2874F0">Sign Up Now!</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Body main wrapper end -->

    <!-- preloader area start -->
    <div class="preloader d-none" id="preloader">
        <div class="preloader-inner">
            <div class="spinner">
                <div class="dot1"></div>
                <div class="dot2"></div>
            </div>
        </div>
    </div>
    <!-- preloader area end -->
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <!-- All JS Plugins -->
    <script src="{{ asset('frontend/js/plugins.js') }}"></script>
    <!-- Main JS -->
    <script src="{{ asset('frontend/js/main.js') }}"></script>
    <script src="{{ asset('frontend/js/custom.js') }}"></script>

    <script>
        function toast(status, header, msg) {
            Command: toastr[status](header, msg)
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": true,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "2000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
        }
    </script>
    @stack('custom_scripts')
    <script>
        // $(document).ready(function() {
        // Login validation msg
        if ({{ $errors->count() }}) {
            Swal.fire({
                title: 'Error',
                icon: 'error',
                html: jQuery("#error_msg").html(),
                showCloseButton: true,
            })
        }

        cartShow()
        cartMenu()
        // wishlistShow()

        function cartShow() {
            $.ajax({
                url: '{{ route('frontend.cart.show') }}',
                method: 'get',
                success: function(res) {
                    if (res.status == 'success') {
                        $('#cart').html(res.html);
                    }
                }
            });
        }

        function cartMenu() {
            $.ajax({
                url: '{{ route('frontend.cart.cartMenu') }}',
                method: 'get',
                success: function(res) {
                    if (res.status == 'success') {
                        $('#cartMenu').html(res.html);
                    }
                }
            });
        }

        function cart(e, product_id) {
            e.preventDefault();
            $.ajax({
                url: '{{ route('frontend.cart.store') }}',
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    'product_id': product_id,
                },
                success: res => {
                    cartShow()
                    cartMenu()
                    $('#add_to_cart_modal').modal('show')
                    // toast('success', res.message)
                },
                error: err => {}
            });
        }

        function cartDelete(e, cart_id) {
            e.preventDefault();
            $.ajax({
                url: '{{ route('frontend.cart.destroy') }}',
                type: 'delete',
                data: {
                    id: cart_id,
                },
                success: res => {
                    cartShow()
                    cartMenu()
                    toast('success', res.message)
                },
                error: err => {}
            });
        }



        // Wishlist
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

        function wishlist(e, product_id) {
            e.preventDefault();
            $.ajax({
                url: '{{ route('frontend.wishlist.store') }}',
                type: 'POST',
                data: {
                    'product_id': product_id,
                },
                success: res => {
                    wishlistShow()
                    toast('success', res.message)
                },
                error: err => {}
            });
        }
        // })
    </script>

</body>

</html>
