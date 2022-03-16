@extends('layouts.admin.app')

@section('title', __('Изменить объявление'))

@php
    $breadcrumbs[] = ['label' => __('Главная'), 'url' => route('admin.index')];
    $breadcrumbs[] = ['label' => __('Объявления'), 'url' => route('admin.announcements.index')];
    $breadcrumbs[] = ['label' => __('Объявление ID:') . " " . $announcement->id];
    $breadcrumbs[] = ['label' => __('Изменить')];
@endphp

@section('content')
    <header class="page-title-bar">
        @include('plugins.breadcrumb', ['breadcrumbs' => $breadcrumbs])
        <h1 class="page-title text-truncate">
            <i class="fas fa-bullhorn fa-fw mr-2 text-muted"></i>
            @if($announcement->type == \App\Models\Announcement::TYPE_BORROW)
                Возьму деньги в долг
            @else
                Дам деньги в долг
            @endif
        </h1>
    </header>
    <div class="page-section">
        <div class="section-block">
            <div class="card card-body">
                <form method="post" action="{{ route('admin.announcements.update', $announcement) }}" onsubmit="disableSubmitButton();">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-12 col-md-6 form-group">
                            <label for="country">
                                {{ __('Страна') }} <abbr title="{{ __('Обязательный') }}">*</abbr>
                            </label>
                            <input type="text" class="form-control" id="country" value="{{ $announcement->country->name }}" disabled>
                        </div>
                        <div class="col-12 col-md-6 form-group">
                            <label for="state">
                                {{ __('Область') }} <abbr title="{{ __('Обязательный') }}">*</abbr>
                            </label>
                            <input type="text" class="form-control" id="state" value="{{ $announcement->state->name }}" disabled>
                        </div>
                        <div class="col-12 form-group">
                            <label for="title">
                                {{ __('Заголовок') }} <abbr title="{{ __('Обязательный') }}">*</abbr>
                            </label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" value="{{ $announcement->title }}" name="title" required autofocus>
                            @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-12 form-group">
                            <label for="content">
                                {{ __('Содержание') }} <abbr title="{{ __('Обязательный') }}">*</abbr>
                            </label>
                            <textarea name="content" id="content" data-toggle="summernote" class="summernote form-control @error('content') is-invalid @enderror">{{ $announcement->content }}</textarea>
                            @error('content')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="name">
                                {{ __('Полное имя') }} <abbr title="{{ __('Обязательный') }}">*</abbr>
                            </label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ $announcement->name }}" name="name" required>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="email">
                                {{ __('Электронная почта') }}
                            </label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ $announcement->email }}" name="email">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="phone">
                                {{ __('Телефон') }}
                            </label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" value="{{ $announcement->phone }}" name="phone">
                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="company">
                                {{ __('Название компании') }}
                                @if($announcement->type == \App\Models\Announcement::TYPE_LEND)
                                    <abbr title="{{ __('Обязательный') }}">*</abbr>
                                @endif
                            </label>
                            @php($required = $announcement->type == \App\Models\Announcement::TYPE_LEND)
                            <input type="text" class="form-control @error('company') is-invalid @enderror" id="company" value="{{ $announcement->company }}" name="company" {{ $required ? 'required' : '' }}>
                            @error('company')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-12 form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input @error('is_vip') is-invalid @enderror" name="is_vip" id="is_vip" {{ $announcement->is_vip ? 'checked' : '' }}>
                                <label class="custom-control-label" for="is_vip">{{ __('VIP') }}</label>
                                @error('is_vip')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 form-actions">
                            <button type="submit" class="btn btn-primary d-flex align-items-center justify-content-center" id="submit-button">
                                <span id="loading" class="spinner-border spinner-border-sm d-none mr-2" role="status" aria-hidden="true"></span>
                                {{ __('Сохранить') }}
                            </button>
                        </div>
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
