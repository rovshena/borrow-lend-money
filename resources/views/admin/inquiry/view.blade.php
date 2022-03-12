@extends('layouts.admin.app')

@section('title', __('Посмотреть сообщение'))

@php
    $breadcrumbs[] = ['label' => __('Главная'), 'url' => route('admin.index')];
    $breadcrumbs[] = ['label' => __('Сообщения'), 'url' => route('admin.inquiries')];
    $breadcrumbs[] = ['label' => $inquiry->id];
@endphp

@section('content')
    <header class="page-title-bar">
        @include('plugins.breadcrumb', ['breadcrumbs' => $breadcrumbs])
        <h1 class="page-title text-truncate">
            <i class="far fa-envelope-open fa-fw mr-2 text-muted"></i>
            {{ __('Сообщения ID:') . " " . $inquiry->id }}
        </h1>
    </header>
    <div class="page-section">
        <div class="section-block">
            <div class="card card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle">
                        <tbody>
                            <tr>
                                <th style="min-width: 150px;"> ID </th>
                                <td> {{ $inquiry->id }} </td>
                            </tr>
                            <tr>
                                <th> {{ __('Полное имя') }} </th>
                                <td> {{ $inquiry->name }} </td>
                            </tr>
                            <tr>
                                <th> {{ __('Телефон') }} </th>
                                <td> {{ $inquiry->phone }} </td>
                            </tr>
                            <tr>
                                <th> {{ __('Электронная почта') }} </th>
                                <td> {{ $inquiry->email }} </td>
                            </tr>
                            <tr>
                                <th> {{ __('Отправить в') }} </th>
                                <td> {{ optional($inquiry->created_at)->format('d.m.Y H:i:s') }} </td>
                            </tr>
                            <tr>
                                <th> {{ __('Изменено в') }} </th>
                                <td> {{ optional($inquiry->updated_at)->format('d.m.Y H:i:s') }} </td>
                            </tr>
                            <tr>
                                <td colspan="2"> {{ $inquiry->content }} </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
