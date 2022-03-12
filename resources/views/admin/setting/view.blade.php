@extends('layouts.admin.app')

@section('title', __('Посмотреть настройку'))

@php
    $breadcrumbs[] = ['label' => __('Главная'), 'url' => route('admin.index')];
    $breadcrumbs[] = ['label' => __('Настройки'), 'url' => route('admin.settings.index')];
    $breadcrumbs[] = ['label' => $setting->id];
@endphp

@section('content')
    <header class="page-title-bar">
        @include('plugins.breadcrumb', ['breadcrumbs' => $breadcrumbs])
        <h1 class="page-title text-truncate">
            <i class="fas fa-cogs fa-fw mr-2 text-muted"></i>
            {{ __('Настройки ID:') . " " . $setting->id }}
        </h1>
    </header>
    <div class="page-section">
        <div class="section-block">
            <div class="card card-body">
                <a href="{{ route('admin.settings.edit', $setting) }}" class="btn btn-primary mr-auto">{{ __('Изменить') }}</a>
                <hr>
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle">
                        <tbody>
                            <tr>
                                <th style="min-width: 150px;"> ID </th>
                                <td> {{ $setting->id }} </td>
                            </tr>
                            <tr>
                                <th> {{ __('Ключ') }} </th>
                                <td> {{ $setting->key }} </td>
                            </tr>
                            <tr>
                                <th> {{ __('Описание') }} </th>
                                <td> {{ $setting->description }} </td>
                            </tr>
                            @if($setting->type == 'editor')
                                <tr>
                                    <th> {{ __('Значение') }} </th>
                                    <td> {!! $setting->value !!} </td>
                                </tr>
                            @else
                                <tr>
                                    <th> {{ __('Значение') }} </th>
                                    <td> {{ $setting->value }} </td>
                                </tr>
                            @endif
                            <tr>
                                <th> {{ __('Статус') }} </th>
                                <td> {!! $setting->status_badge !!} </td>
                            </tr>
                            <tr>
                                <th> {{ __('Создано в') }} </th>
                                <td> {{ optional($setting->created_at)->format('d.m.Y H:i:s') }} </td>
                            </tr>
                            <tr>
                                <th> {{ __('Изменено в') }} </th>
                                <td> {{ optional($setting->updated_at)->format('d.m.Y H:i:s') }} </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
