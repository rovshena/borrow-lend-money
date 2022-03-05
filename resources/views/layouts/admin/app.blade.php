<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- SEO -->
    <title> @yield('title', __('Dashboard')) </title>
    <link rel="canonical" href="{{ url('/') }}">

    <!-- Chrome, Firefox OS and Opera -->
    <meta name="theme-color" content="#346cb0">

    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#346cb0">

    <!-- iOS Safari -->
    <meta name="apple-mobile-web-app-status-bar-style" content="#346cb0">
    <meta name="apple-mobile-web-app-capable" content="yes"/>

    <!--App manifest-->
    <link rel="manifest" href="{{ asset('assets/images/favicons/site.webmanifest') }}">

    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/images/favicons/apple-touch-icon.png') }}" type="image/png">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicons/favicon.ico') }}" type="image/x-icon">
    <link rel="icon" sizes="16x16" href="{{ asset('assets/images/favicons/favicon-16x16.png') }}" type="image/png">
    <link rel="icon" sizes="32x32" href="{{ asset('assets/images/favicons/favicon-32x32.png') }}" type="image/png">

    <!-- Google Fonts -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/nunito.css') }}">

    <!-- Plugin styles -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/toastr/build/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/sweetalert/sweetalert.min.css') }}">

    @hasSection('datatable')

        <link rel="stylesheet" href="{{ asset('assets/vendor/datatables.net-select/css/select.dataTables.min.css') }}">

    @endif

    @stack('css')

    <!-- Theme styles -->
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/theme.min.css') }}" data-skin="default">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/theme-dark.min.css') }}" data-skin="dark">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/custom.css') }}">

    <script>
        var skin = localStorage.getItem('skin') || 'default';
        var disabledSkinStylesheet = document.querySelector('link[data-skin]:not([data-skin="' + skin + '"])');
        // Disable unused skin immediately
        disabledSkinStylesheet.setAttribute('rel', '');
        disabledSkinStylesheet.setAttribute('disabled', true);
        // add loading class to html immediately
        document.querySelector('html').classList.add('loading');
    </script>

    @stack('head.js')

</head>
<body>

<div class="preloader">
    <img src="{{ asset('assets/images/preloaders/miniballs.svg') }}" alt="">
</div>

<div class="app">

    @include('layouts.admin.partials.header')

    @include('layouts.admin.partials.sidebar')

    <main class="app-main">

        <div class="wrapper">
            <div class="page">
                <div class="page-inner">

                    @yield('content')

                </div>
            </div>
        </div>

        @include('layouts.admin.partials.footer')

    </main>

</div>

<!-- Begin Base JS -->
<script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/vendor/popper.js/umd/popper.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<!-- End Base JS -->

<!-- Begin Plugins JS -->
<script src="{{ asset('assets/vendor/smoothscroll-for-websites/smooth.scroll.js') }}"></script>
<script src="{{ asset('assets/vendor/pace-progress/pace.min.js') }}"></script>
<script src="{{ asset('assets/vendor/stacked-menu/js/stacked-menu.min.js') }}"></script>
<script src="{{ asset('assets/vendor/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/vendor/toastr/build/toastr.min.js') }}"></script>
<script src="{{ asset('assets/vendor/sweetalert/sweetalert.min.js') }}"></script>

@stack('plugin.js')

<!-- End Plugins JS -->

<!-- Begin Layout JS -->
<script src="{{ asset('assets/dashboard/js/theme.min.js') }}"></script>
<!-- End Layout JS -->

<!-- Begin Page Level JS -->

@include('plugins.session_toastr')

<script src="{{ asset('assets/dashboard/js/layout.js') }}"></script>

@hasSection('datatable')

    @include('plugins.datatable')

@endif

@stack('page.js')

<!-- End Page Level JS -->

</body>

</html>
