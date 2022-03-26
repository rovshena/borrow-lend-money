@extends('layouts.visitor.app')

@section('title', __('Связаться с нами'))

@section('meta.description', __('Связаться с нами'))

@section('meta.keywords', __('Связаться с нами'))

@section('og.title', __('Связаться с нами'))

@section('og.description', __('Связаться с нами'))

@section('content')
    <section class="container mt-5 mb-5 pt-5 pb-2 pb-md-4 pb-lg-5">
        <div class="row align-items-center gy-4">
            <div class="col-md-6">
                <div class="mx-md-0 mx-auto mb-md-5 mb-4 pb-md-4 text-center">
                    <h1 class="mb-4">Напишите нам!</h1>
                    <p class="mb-0 fs-lg text-muted">
                        Заполните форму, и наша команда постарается связаться с вами в течение 24 часов.
                    </p>
                </div>
                <img class="d-block mx-auto" style="max-height: 300px;" src="{{ asset('assets/images/illustrations/contact.gif') }}" alt="Illustration">
            </div>
            <div class="col-md-6">
                <div class="card border-0 bg-secondary p-sm-3 p-2">
                    <div class="card-body m-1">
                        <form method="post" action="{{ route('contact.post') }}" onsubmit="disableSubmitButton();">
                            @csrf
                            @method('PUT')
                            <label for="contact_name" class="form-label">
                                {{ __('Полное имя') }}
                                <abbr class="text-danger" title="{{ __('Обязательный') }}">*</abbr>
                            </label>
                            <div class="input-group mb-3">
                                <span class="input-group-text">
                                    <i class="far fa-user fa-fw"></i>
                                </span>
                                <input type="text" class="form-control @error('contact_name') is-invalid @enderror" id="contact_name" value="{{ old('contact_name') }}" name="contact_name" required>
                                @error('contact_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="contact_phone" class="form-label">
                                {{ __('Телефон') }}
                            </label>
                            <div class="input-group mb-3">
                                <span class="input-group-text">
                                    <i class="fas fa-mobile-alt fa-fw"></i>
                                </span>
                                <input type="text" class="form-control @error('contact_phone') is-invalid @enderror" id="contact_phone" value="{{ old('contact_phone') }}" name="contact_phone" maxlength="15">
                                @error('contact_phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="contact_email" class="form-label">
                                {{ __('Электронная почта') }}
                                <abbr class="text-danger" title="{{ __('Обязательный') }}">*</abbr>
                            </label>
                            <div class="input-group mb-3">
                                <span class="input-group-text">
                                    <i class="far fa-envelope fa-fw"></i>
                                </span>
                                <input type="email" class="form-control @error('contact_email') is-invalid @enderror" id="contact_email" value="{{ old('contact_email') }}" name="contact_email" required>
                                @error('contact_email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="contact_content" class="form-label">
                                {{ __('Сообщение') }}
                                <abbr class="text-danger" title="{{ __('Обязательный') }}">*</abbr>
                            </label>
                            <div class="input-group mb-3">
                                <span class="input-group-text">
                                    <i class="far fa-comment-alt fa-fw"></i>
                                </span>
                                <textarea name="contact_content" id="contact_content" rows="5" required class="form-control @error('contact_content') is-invalid @enderror">{{ old('contact_content') }}</textarea>
                                @error('contact_content')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="captcha">
                                    Код с картинки <abbr class="text-danger" title="{{ __('Обязательный') }}">*</abbr>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <button id="reload-captcha" type="button" class="btn btn-secondary btn-sm me-1">
                                            <i class="fas fa-sync"></i>
                                        </button>
                                        <span class="captcha"> {!! captcha_img() !!} </span>
                                    </span>
                                    <input id="captcha" class="form-control form-control-lg @error('captcha') is-invalid @enderror" type="text" name="captcha" required>
                                    @error('captcha')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary d-flex align-items-center justify-content-center" id="submit-button">
                                <span id="loading" class="spinner-border spinner-border-sm d-none me-2" role="status" aria-hidden="true"></span>
                                <i class="far fa-paper-plane fa-fw me-1"></i>
                                {{ __('Отправить') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="container mb-5 pb-2 pb-md-4 pb-lg-5">
        <div class="row g-4">
            <div class="col-md-4">
                <a class="icon-box card card-hover h-100" href="{{ isset($shared_settings['vk_link']) ? $shared_settings['vk_link'] : 'javascript:void(0);' }}">
                    <div class="card-body">
                        <div class="icon-box-media text-primary rounded-circle shadow-sm mb-3">
                            <i class="fi-vk"></i>
                        </div>
                        <span class="d-block mb-1 text-body">Подписывайтесь на нас</span>
                        <h3 class="h4 icon-box-title mb-0 opacity-90">
                            В Контакте
                        </h3>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a class="icon-box card card-hover h-100" href="{{ isset($shared_settings['telegram_link']) ? $shared_settings['telegram_link'] : 'javascript:void(0);' }}">
                    <div class="card-body">
                        <div class="icon-box-media text-primary rounded-circle shadow-sm mb-3">
                            <i class="fi-telegram"></i>
                        </div>
                        <span class="d-block mb-1 text-body">Подписывайтесь на нас</span>
                        <h3 class="h4 icon-box-title mb-0 opacity-90">
                            Telegram
                        </h3>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a class="icon-box card card-hover h-100" href="{{ isset($shared_settings['messenger_link']) ? $shared_settings['messenger_link'] : 'javascript:void(0);' }}">
                    <div class="card-body">
                        <div class="icon-box-media text-primary rounded-circle shadow-sm mb-3">
                            <i class="fi-messenger"></i>
                        </div>
                        <span class="d-block mb-1 text-body">Подписывайтесь на нас</span>
                        <h3 class="h4 icon-box-title mb-0 opacity-90">
                            Messenger
                        </h3>
                    </div>
                </a>
            </div>
        </div>
    </section>
@endsection

@push('page.js')
    <script>
        $(function () {
            $('#reload-captcha').click(function () {
                const $icon = $(this).find('i')
                const $button = $(this)
                $icon.addClass('fa-spin')
                $button.prop('disabled', true)
                $.ajax({
                    type: 'GET',
                    url: '{{ route('reload-captcha') }}',
                    success: function (data) {
                        $('.captcha').html(data.captcha);
                    },
                    complete: function () {
                        setTimeout(function () {
                            $icon.removeClass('fa-spin')
                            $button.prop('disabled', false)
                        }, 500)
                    }
                });
            })
        })
    </script>
@endpush
