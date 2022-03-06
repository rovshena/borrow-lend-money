@extends('layouts.visitor.app')

@section('title', __('Contact Us') . ' | ' . (Arr::exists($shared_settings, 'title') ? $shared_settings['title'] : ''))

@section('meta.description', __('Contact Us') . ', ' . (Arr::exists($shared_settings, 'description') ? $shared_settings['description'] : ''))

@section('meta.keywords', __('Contact Us') . ', ' . (Arr::exists($shared_settings, 'keyword') ? $shared_settings['keyword'] : ''))

@section('og.title', __('Contact Us') . ' | ' . (Arr::exists($shared_settings, 'title') ? $shared_settings['title'] : ''))

@section('og.description', __('Contact Us') . ', ' . (Arr::exists($shared_settings, 'description') ? $shared_settings['description'] : ''))

@section('content')
    <section class="container mt-5 mb-5 pt-5 pb-2 pb-md-4 pb-lg-5">
        <div class="row align-items-center gy-4">
            <div class="col-md-6">
                <div class="mx-md-0 mx-auto mb-md-5 mb-4 pb-md-4 text-center">
                    <h1 class="mb-4">Get in touch!</h1>
                    <p class="mb-0 fs-lg text-muted">Fill out the form and out team will try to get back to you within 24 hours.</p>
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
                                {{ __('Name') }}
                                <abbr class="text-danger" title="{{ __('Required') }}">*</abbr>
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
                                {{ __('Phone') }}
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
                                {{ __('E-mail') }}
                            </label>
                            <div class="input-group mb-3">
                                <span class="input-group-text">
                                    <i class="far fa-envelope fa-fw"></i>
                                </span>
                                <input type="email" class="form-control @error('contact_email') is-invalid @enderror" id="contact_email" value="{{ old('contact_email') }}" name="contact_email">
                                @error('contact_email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <label for="contact_content" class="form-label">
                                {{ __('Message') }}
                                <abbr class="text-danger" title="{{ __('Required') }}">*</abbr>
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
                            <button type="submit" class="btn btn-primary d-flex align-items-center justify-content-center" id="submit-button">
                                <span id="loading" class="spinner-border spinner-border-sm d-none me-2" role="status" aria-hidden="true"></span>
                                <i class="far fa-paper-plane fa-fw me-1"></i>
                                {{ __('Send') }}
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
                <a class="icon-box card card-hover h-100" href="{{ isset($shared_settings['email']) ? 'mailto:' . $shared_settings['email'] : 'javascript:void(0);' }}">
                    <div class="card-body">
                        <div class="icon-box-media text-primary rounded-circle shadow-sm mb-3">
                            <i class="fi-mail"></i>
                        </div>
                        <span class="d-block mb-1 text-body">Drop us a line</span>
                        <h3 class="h4 icon-box-title mb-0 opacity-90">{{ isset($shared_settings['email']) ? $shared_settings['email'] : '' }}</h3>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a class="icon-box card card-hover h-100" href="{{ isset($shared_settings['phone']) ? 'tel:' . $shared_settings['phone'] : 'javascript:void(0);' }}">
                    <div class="card-body">
                        <div class="icon-box-media text-primary rounded-circle shadow-sm mb-3">
                            <i class="fi-device-mobile"></i>
                        </div>
                        <span class="d-block mb-1 text-body">Call us any time</span>
                        <h3 class="h4 icon-box-title mb-0 opacity-90">{{ isset($shared_settings['phone']) ? $shared_settings['phone'] : '' }}</h3>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a class="icon-box card card-hover h-100" href="javascript:void(0);">
                    <div class="card-body">
                        <div class="icon-box-media text-primary rounded-circle shadow-sm mb-3">
                            <i class="fi-home"></i>
                        </div>
                        <span class="d-block mb-1 text-body">Address</span>
                        <h3 class="h4 icon-box-title mb-0 opacity-90">{{ isset($shared_settings['address']) ? $shared_settings['address'] : '' }}</h3>
                    </div>
                </a>
            </div>
        </div>
    </section>
@endsection
