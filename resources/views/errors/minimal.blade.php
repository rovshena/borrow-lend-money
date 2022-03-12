<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>@yield('title')</title>

    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/images/favicons/apple-touch-icon.png') }}"
          type="image/png">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicons/favicon.ico') }}" type="image/x-icon">
    <link rel="icon" sizes="16x16" href="{{ asset('assets/images/favicons/favicon-16x16.png') }}" type="image/png">
    <link rel="icon" sizes="32x32" href="{{ asset('assets/images/favicons/favicon-32x32.png') }}" type="image/png">

    <!-- Google Fonts -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/nunito.css') }}">

    <!-- Plugin styles -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fontawesome/css/all.min.css') }}">

    <!-- Theme styles -->
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/theme.min.css') }}">

</head>
<body class="app">

<main class="empty-state empty-state-fullpage">
    <div class="col-12 empty-state-container">
        <div class="card">
            <div class="card-header bg-light text-left">
                <i class="fa fa-fw fa-circle text-red"></i>
                <i class="fa fa-fw fa-circle text-yellow"></i>
                <i class="fa fa-fw fa-circle text-teal"></i>
            </div>
            <div class="card-body">
                <h3 class="state-header"> @yield('code') </h3>
                <p class="state-description lead"> @yield('message') </p>
                <div class="state-action">
                    <a href="{{ url('/') }}" class="btn btn-lg btn-subtle-primary m-2" title="{{ __('Главная') }}">
                        <i class="fas fa-home fa-fw mr-sm-1"></i>
                        <span class="d-none d-sm-inline">{{ __('Главная') }}</span>
                    </a>
                    <a href="javascript:void(0);" id="previous-link" class="btn btn-lg btn-subtle-success m-2"
                       title="{{ __('Назад') }}">
                        <i class="fas fa-reply fa-fw mr-sm-1"></i>
                        <span class="d-none d-sm-inline">{{ __('Назад') }}</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Begin Base JS -->
<script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/vendor/popper.js/umd/popper.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<!-- End Base JS -->

<!-- Begin Layout JS -->
<script src="{{ asset('assets/dashboard/js/theme.min.js') }}"></script>
<!-- End Layout JS -->

<script>
    $(document).ready(function () {
        $('#previous-link').click(function () {
            parent.history.back();
            return false;
        });
    });
</script>

</body>
</html>
