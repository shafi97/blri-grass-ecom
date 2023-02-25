<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Broccoli </title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- <!-- Place favicon.png in the root directory --> --}}
    <link rel="shortcut icon" href="{{ asset('frontend/img/favicon.png') }}" type="image/x-icon" />
    {{-- <!-- Font Icons css --> --}}
    <link rel="stylesheet" href="{{ asset('frontend/css/font-icons.css') }}">
    {{-- <!-- plugins css --> --}}
    <link rel="stylesheet" href="{{ asset('frontend/css/plugins.css') }}">
    {{-- <!-- Main Stylesheet --> --}}
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    {{-- <!-- Responsive css --> --}}
    <link rel="stylesheet" href="{{ asset('frontend/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/custom.css') }}">
</head>
@php
    $categories = App\Models\Category::all(['id','name']);
@endphp

<body>

    {{-- <!-- Body main wrapper start --> --}}
    <div class="body-wrapper">
        @include('frontend.layouts.includes.top_header')
        @include('frontend.layouts.includes.navigation')

        @yield('content')

        {{-- <!-- FOOTER AREA START --> --}}
        @include('frontend.layouts.includes.footer')
        {{-- <!-- FOOTER AREA END --> --}}

        {{-- <!-- Add To Cart Modal Start --> --}}
        @include('frontend.layouts.includes.cart_modal')
        {{-- <!-- Add To Cart Modal End --> --}}

        {{-- <!-- MODAL AREA START (Wishlist Modal) --> --}}

        {{-- <!-- MODAL AREA END --> --}}

        {{-- <!-- Quick View Modal Start --> --}}
        @include('frontend.layouts.includes.quick_view_modal')
        {{-- <!-- Quick View Modal End --> --}}

        {{-- <!-- Login Modal Start --> --}}
        @include('frontend.layouts.includes.login_modal')

    </div>
    <!-- Body main wrapper end -->

    <!-- preloader area start -->
    <div class="preloader" id="preloader">
        <div class="preloader-inner">
            <div class="spinner">
                <div class="dot1"></div>
                <div class="dot2"></div>
            </div>
        </div>
    </div>
    <!-- preloader area end -->

    <!-- All JS Plugins -->
    <script src="{{ asset('frontend/js/plugins.js') }}"></script>

    <!-- Main JS -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="{{ asset('frontend/js/main.js') }}"></script>
    {{-- <script src="//cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}
    <script src="{{ asset('frontend/js/custom.js') }}"></script>
    @include('sweetalert::alert')
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
    <script>
        // Select 2
        $(document).ready(function () {
            $('.singleSelect2').select2();
        });

        // Value Reset
        $('#farm').on('change', function () {
            $(".valReset").empty().trigger('change')
            // $('.valReset').val('').change();
        })
    </script>
    @stack('custom_scripts')
    @include('frontend.layouts.includes.cart_wishlist_js')
    <script>
        $(".productQuickView").on("click", function() {
            $("#our_product_name").text($(this).data('our_product_name'))
            $("#our_product_price").text($(this).data('our_product_price'))
            $("#our_product_dis_price").text($(this).data('our_product_dis_price'))
            $("#our_product_image").attr("src", $(this).data('our_product_image'))
        })
    </script>
</body>

</html>
