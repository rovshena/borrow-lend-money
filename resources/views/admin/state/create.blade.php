@extends('layouts.admin.app')

@section('title', __('Добавить регион'))

@php
    $breadcrumbs[] = ['label' => __('Главная'), 'url' => route('admin.index')];
    $breadcrumbs[] = ['label' => __('Регионы'), 'url' => route('admin.states.index')];
    $breadcrumbs[] = ['label' => __('Добавить регион')];
@endphp

@section('content')
    <header class="page-title-bar">
        @include('plugins.breadcrumb', ['breadcrumbs' => $breadcrumbs])
        <h1 class="page-title text-truncate">
            <i class="fas fa-globe fa-fw mr-2 text-muted"></i>
            {{ __('Добавить регион') }}
        </h1>
    </header>
    <div class="page-section">
        <div class="section-block">
            <div class="card card-body">
                <form method="post" action="{{ route('admin.states.store') }}" onsubmit="disableSubmitButton();">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-lg-6 form-group">
                            <label for="name">
                                {{ __('Название регион') }} <abbr title="{{ __('Обязательный') }}">*</abbr>
                            </label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name') }}" name="name" required autofocus>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="row">
                                <div class="col-lg-6 form-group">
                                    <label for="iso_code">
                                        {{ __('Код ISO') }} <abbr title="{{ __('Обязательный') }}">*</abbr>
                                    </label>
                                    <input type="text" class="form-control @error('iso_code') is-invalid @enderror" id="iso_code" value="{{ old('iso_code') }}" name="iso_code" maxlength="10" required>
                                    @error('iso_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-lg-6 form-group" lang="{{ app()->getLocale() }}">
                                    <label for="country_id">
                                        {{ __('Страна') }}
                                        <abbr title="{{ __('Должен быть выбран') }}">*</abbr>
                                    </label>
                                    <select name="country_id" id="country_id"
                                            class="custom-select @error('country_id') is-invalid @enderror"
                                            data-placeholder="{{ __('Выбирать') }}" data-toggle="select2"
                                            data-allow-clear="true" required>
                                        <option value=""></option>
                                        @forelse ($countries as $id => $name)
                                            <option value="{{ $id }}" {{ old('country_id') == $id ? 'selected' : '' }}>
                                                {{ $name }}
                                            </option>
                                        @empty
                                        @endforelse
                                    </select>
                                    @error('country_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-12 form-actions">
                            <button type="submit" class="btn btn-primary d-flex align-items-center justify-content-center" id="submit-button">
                                <span id="loading" class="spinner-border spinner-border-sm d-none mr-2" role="status" aria-hidden="true"></span> {{ __('Добавить регион') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@include('plugins.select2')
