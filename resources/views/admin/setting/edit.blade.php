@extends('layouts.admin.app')

@section('title', __('Изменить настройку'))

@php
    $breadcrumbs[] = ['label' => __('Главная'), 'url' => route('admin.index')];
    $breadcrumbs[] = ['label' => __('Настройки'), 'url' => route('admin.settings.index')];
    $breadcrumbs[] = ['label' => __('Настройки ID:') . " " . $setting->id, 'url' => route('admin.settings.show', $setting)];
    $breadcrumbs[] = ['label' => __('Изменить')];
@endphp

@section('content')
    <header class="page-title-bar">
        @include('plugins.breadcrumb', ['breadcrumbs' => $breadcrumbs])
        <h1 class="page-title text-truncate">
            <i class="fas fa-cogs fa-fw mr-2 text-muted"></i>
            {{ __('Ключ настройки:') . " " . $setting->key }}
        </h1>
    </header>
    <div class="page-section">
        <div class="section-block">
            <div class="card card-body">
                <form method="post" action="{{ route('admin.settings.update', $setting) }}" onsubmit="disableSubmitButton();">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="description">
                            {{ __('Описание') }} <abbr title="{{ __('Обязательный') }}">*</abbr>
                        </label>
                        <input type="text" class="form-control @error('description') is-invalid @enderror" id="description" value="{{ $setting->description }}" name="description" required autofocus>
                        @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    @if($setting->type == 'text')
                        <div class="form-group">
                            <label for="value">
                                {{ __('Значение') }} <abbr title="{{ __('Обязательный') }}">*</abbr>
                            </label>
                            <input type="text" class="form-control @error('value') is-invalid @enderror" id="value" value="{{ $setting->value }}" name="value" required>
                            @error('value')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    @endif

                    @if($setting->type == 'textarea')
                        <div class="form-group">
                            <label for="value">
                                {{ __('Значение') }} <abbr title="{{ __('Обязательный') }}">*</abbr>
                            </label>
                            <textarea name="value" id="value" rows="3" required class="form-control @error('value') is-invalid @enderror">{{ $setting->value }}</textarea>
                            @error('value')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    @endif

                    @if($setting->type == 'editor')
                        <div class="form-group">
                            <label for="value">
                                {{ __('Значение') }} <abbr title="{{ __('Обязательный') }}">*</abbr>
                            </label>
                            <textarea name="value" id="value" data-toggle="summernote" class="summernote form-control @error('value') is-invalid @enderror">{{ $setting->value }}</textarea>
                            @error('value')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    @endif

                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input @error('status') is-invalid @enderror" name="status" id="status" {{ $setting->status ? 'checked' : '' }}>
                            <label class="custom-control-label" for="status">{{ __('Статус') }}</label>
                            @error('status')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
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

@push('page.js')
    @if ($errors->any())
        <script>
            $('.invalid-feedback').show();
        </script>
    @endif
@endpush
