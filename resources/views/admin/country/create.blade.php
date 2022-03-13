@extends('layouts.admin.app')

@section('title', __('Добавить страну'))

@php
    $breadcrumbs[] = ['label' => __('Главная'), 'url' => route('admin.index')];
    $breadcrumbs[] = ['label' => __('Страны'), 'url' => route('admin.countries.index')];
    $breadcrumbs[] = ['label' => __('Добавить страну')];
@endphp

@section('content')
    <header class="page-title-bar">
        @include('plugins.breadcrumb', ['breadcrumbs' => $breadcrumbs])
        <h1 class="page-title text-truncate">
            <i class="fas fa-globe fa-fw mr-2 text-muted"></i>
            {{ __('Добавить страну') }}
        </h1>
    </header>
    <div class="page-section">
        <div class="section-block">
            <div class="card card-body">
                <form method="post" action="{{ route('admin.countries.store') }}" onsubmit="disableSubmitButton();">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-md-6 form-group">
                            <label for="name">
                                {{ __('Название страны') }} <abbr title="{{ __('Обязательный') }}">*</abbr>
                            </label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name') }}" name="name" required autofocus>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="iso3">
                                        {{ __('ISO 3') }} <abbr title="{{ __('Обязательный') }}">*</abbr>
                                    </label>
                                    <input type="text" class="form-control @error('iso3') is-invalid @enderror" id="iso3" value="{{ old('iso3') }}" name="iso3" maxlength="3" required>
                                    @error('iso3')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="iso2">
                                        {{ __('ISO 2') }} <abbr title="{{ __('Обязательный') }}">*</abbr>
                                    </label>
                                    <input type="text" class="form-control @error('iso2') is-invalid @enderror" id="iso2" value="{{ old('iso2') }}" name="iso2" maxlength="2" required>
                                    @error('iso2')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-12 form-actions">
                            <button type="submit" class="btn btn-primary d-flex align-items-center justify-content-center" id="submit-button">
                                <span id="loading" class="spinner-border spinner-border-sm d-none mr-2" role="status" aria-hidden="true"></span> {{ __('Добавить страну') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
