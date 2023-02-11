<!doctype html>
<html lang="en" class="">

<head>
    {{-- Required meta tags --}}
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- loader --}}
    <link href="{{ asset('backend/css/pace.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('backend/js/p') }}ace.min.js"></script>

    {{-- plugins --}}
    @stack('custom_css')
    <link href="{{ asset('backend/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />

    {{-- CSS Files --}}
    <link href="{{ asset('backend/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/css/bootstrap-extended.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/css/icons.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">

    {{-- Theme Styles --}}
    <link href="{{ asset('backend/css/dark-theme.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/css/semi-dark.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/css/header-colors.css') }}" rel="stylesheet" />

    <title>@yield('title') | {{ env('APP_NAME') }}</title>
    {{-- <title>@yield('title') | {{ config('app.locale')=='en'?setting('app_name'):setting('app_name_b') }}</title> --}}
</head>

<body>
    {{-- start wrapper --}}
    <div class="wrapper">
        {{-- start sidebar --}}
        <aside class="sidebar-wrapper" data-simplebar="true">
            <div class="sidebar-header">
                <div>
                    <img src="{{ asset('backend/images/logo-icon-2.png') }}" class="logo-icon" alt="logo icon">
                </div>
                <div>
                    <h4 class="logo-text">SYN-UI</h4>
                </div>
                <div class="toggle-icon ms-auto">
                    <ion-icon name="menu-sharp"></ion-icon>
                </div>
            </div>
            {{-- navigation --}}
            @include('dashboard.layout.includes.navigation')
            {{-- end navigation --}}
        </aside>
        {{-- end sidebar --}}

        {{-- start top header --}}
        @include('dashboard.layout.includes.top_header')
        {{-- end top header --}}

        {{-- start page content wrapper --}}
        @yield('content')
        {{-- end page content wrapper --}}

        {{-- start footer --}}
        @include('dashboard.layout.includes.footer')
        {{-- end footer --}}

        {{-- Start Back To Top Button --}}
        <a href="javaScript:;" class="back-to-top">
            <ion-icon name="arrow-up-outline"></ion-icon>
        </a>
        {{-- End Back To Top Button --}}

        {{-- start switcher --}}
        {{-- @include('dashboard.layout.includes.switcher') --}}
        {{-- end switcher --}}

        {{-- start overlay --}}
        <div class="overlay nav-toggle-icon"></div>
        {{-- end overlay --}}
    </div>
    {{-- end wrapper --}}
    <div id="ajax_modal_container"></div>
    {{-- JS Files --}}
    <script src="{{ asset('backend/js/jquery.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/simplebar/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/metismenu/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('backend/js/bootstrap.bundle.min.js') }}"></script>
    {{-- <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script> --}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('backend/js/plugins-init.js') }}"></script>
    @include('sweetalert::alert')
    
    {{-- Main JS --}}
    <script src="{{ asset('backend/js/main.js') }}"></script>
    @stack('custom_scripts')

</body>

</html>
