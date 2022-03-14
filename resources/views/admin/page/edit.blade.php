@extends('layouts.admin.app')

@section('title', __('Изменить страницу'))

@php
    $breadcrumbs[] = ['label' => __('Главная'), 'url' => route('admin.index')];
    $breadcrumbs[] = ['label' => __('Страницы'), 'url' => route('admin.pages.index')];
    $breadcrumbs[] = ['label' => __('Изменить')];
@endphp

@section('content')
    <header class="page-title-bar">
        @include('plugins.breadcrumb', ['breadcrumbs' => $breadcrumbs])
        <h1 class="page-title text-truncate">
            <i class="fas fa-file-alt fa-fw mr-2 text-muted"></i>
            {{ $payload['title'] }}
        </h1>
    </header>
    <div class="page-section">
        <div class="section-block">
            <div class="card card-body">
                <form method="post" action="{{ route('admin.pages.update', $payload['key']) }}" onsubmit="disableSubmitButton();">
                    @csrf
                    @method('PUT')
                    @foreach($payload['settings'] as $setting)
                        @if($setting->type == 'text')
                            <div class="form-group">
                                <label for="{{ $setting->key }}">
                                    {{ $setting->description }} <abbr title="{{ __('Обязательный') }}">*</abbr>
                                </label>
                                <input type="text" class="form-control @error($setting->key) is-invalid @enderror" id="{{ $setting->key }}" value="{{ $setting->value }}" name="{{ $setting->key }}" required>
                                @error($setting->key)
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        @endif

                        @if($setting->type == 'textarea')
                            <div class="form-group">
                                <label for="{{ $setting->key }}">
                                    {{ $setting->description }} <abbr title="{{ __('Обязательный') }}">*</abbr>
                                </label>
                                <textarea name="{{ $setting->key }}" id="{{ $setting->key }}" rows="8" required class="form-control @error($setting->key) is-invalid @enderror">{{ $setting->value }}</textarea>
                                @error($setting->key)
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        @endif

                        @if($setting->type == 'editor')
                            <div class="form-group">
                                <label for="{{ $setting->key }}">
                                    {{ $setting->description }} <abbr title="{{ __('Обязательный') }}">*</abbr>
                                </label>
                                <textarea name="{{ $setting->key }}" rows="10" id="{{ $setting->key }}" data-toggle="summernote" class="summernote form-control @error($setting->key) is-invalid @enderror">{{ $setting->value }}</textarea>
                                @error($setting->key)
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        @endif

                        @if($setting->type == 'code')
                            <div class="form-group">
                                <label for="{{ $setting->key }}">
                                    {{ $setting->description }} <abbr title="{{ __('Обязательный') }}">*</abbr>
                                </label>
                                <textarea name="{{ $setting->key }}" rows="10" id="{{ $setting->key }}" class="code-mirror form-control @error($setting->key) is-invalid @enderror">{{ $setting->value }}</textarea>
                                @error($setting->key)
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        @endif
                    @endforeach
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary d-flex align-items-center justify-content-center" id="submit-button">
                            <span id="loading" class="spinner-border spinner-border-sm d-none mr-2" role="status" aria-hidden="true"></span> {{ __('Сохранить') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@include('plugins.summernote')

@push('head.js')
    <link rel="stylesheet" href="{{ mix('assets/dashboard/css/code-mirror.css') }}">
@endpush

@push('page.js')
    @if ($errors->any())
        <script>
            $('.invalid-feedback').show();
        </script>
    @endif
    <script src="{{ mix('assets/dashboard/js/code-mirror.js') }}"></script>
@endpush
