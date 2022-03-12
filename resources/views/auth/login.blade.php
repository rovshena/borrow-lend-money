<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- SEO -->
    <title> @yield('title', __('Войти | Панель администратора')) </title>
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

    <!-- Theme styles -->
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/theme.min.css') }}" data-skin="default">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/theme-dark.min.css') }}" data-skin="dark">

    <script>
        var skin = localStorage.getItem('skin') || 'default';
        var disabledSkinStylesheet = document.querySelector('link[data-skin]:not([data-skin="' + skin + '"])');
        // Disable unused skin immediately
        disabledSkinStylesheet.setAttribute('rel', '');
        disabledSkinStylesheet.setAttribute('disabled', true);
        // add loading class to html immediately
        document.querySelector('html').classList.add('loading');
    </script>

</head>
<body>

<main class="auth justify-content-center">
    <div class="text-center">
        <img src="{{ asset('assets/images/favicons/android-chrome-192x192.png') }}" alt="{{ __('Логотип') }}" style="max-height: 120px;">
        <h5 class="my-md-3">{{ __('Войти | Панель администратора') }}</h5>
    </div>
    <form class="auth-form" action="{{ route('admin.login') }}" method="POST" onsubmit="disableSubmitButton();">
        @csrf
        <div class="form-group">
            <div class="form-label-group">
                <input type="text" id="username" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                <label for="username">
                    {{ __('Имя пользователя') }} <abbr title="{{ __('Обязательный') }}">*</abbr>
                </label>
                @error('username')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            <div class="form-label-group">
                <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                <label for="password">
                    {{ __('Пароль') }} <abbr title="{{ __('Обязательный') }}">*</abbr>
                </label>
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            <button class="btn btn-lg btn-primary btn-block d-flex align-items-center justify-content-center" type="submit" id="submit-button">
                <span id="loading" class="spinner-border spinner-border-sm d-none mr-2" role="status" aria-hidden="true"></span>
                {{ __('Войти') }}
            </button>
        </div>
    </form>
</main>

<!-- Begin Base JS -->
<script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/vendor/popper.js/umd/popper.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<!-- End Base JS -->

<!-- Begin Layout JS -->
<script src="{{ asset('assets/dashboard/js/theme.min.js') }}"></script>
<!-- End Layout JS -->

<!-- Begin Page Level JS -->
<script>
    function disableSubmitButton() {
        document.getElementById('submit-button').setAttribute('disabled', 'true');
        document.getElementById('loading').classList.remove('d-none');
    }
</script>
<!-- End Page Level JS -->

</body>

</html>
