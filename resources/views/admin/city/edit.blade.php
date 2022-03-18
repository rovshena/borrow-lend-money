@extends('layouts.admin.app')

@section('title', __('Изменить город'))

@php
    $breadcrumbs[] = ['label' => __('Главная'), 'url' => route('admin.index')];
    $breadcrumbs[] = ['label' => __('Города'), 'url' => route('admin.cities.index')];
    $breadcrumbs[] = ['label' => __('Город ID:') . " " . $city->id];
    $breadcrumbs[] = ['label' => __('Изменить')];
@endphp

@section('content')
    <header class="page-title-bar">
        @include('plugins.breadcrumb', ['breadcrumbs' => $breadcrumbs])
        <h1 class="page-title text-truncate">
            <i class="fas fa-globe fa-fw mr-2 text-muted"></i>
            {{ __('Город ID:') . " " . $city->id }}
        </h1>
    </header>
    <div class="page-section">
        <div class="section-block">
            <div class="card card-body">
                <form method="post" action="{{ route('admin.cities.update', $city) }}" onsubmit="disableSubmitButton();">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label for="name">
                                    {{ __('Название города') }} <abbr title="{{ __('Обязательный') }}">*</abbr>
                                </label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ $city->name }}" name="name" required autofocus>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group" lang="{{ app()->getLocale() }}">
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
                                        <option value="{{ $id }}" {{ $city->country_id == $id ? 'selected' : '' }}>
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
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input @error('status') is-invalid @enderror" name="status" id="status" {{ $city->status ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="status">{{ __('Статус') }}</label>
                                    @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-12 form-actions">
                            <button type="submit" class="btn btn-primary d-flex align-items-center justify-content-center" id="submit-button">
                                <span id="loading" class="spinner-border spinner-border-sm d-none mr-2" role="status" aria-hidden="true"></span> {{ __('Сохранить') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@include('plugins.select2')
