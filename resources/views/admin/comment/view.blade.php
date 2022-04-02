@extends('layouts.admin.app')

@section('title', __('Посмотреть комментарий'))

@php
    $breadcrumbs[] = ['label' => __('Главная'), 'url' => route('admin.index')];
    $breadcrumbs[] = ['label' => __('Комментарии'), 'url' => route('admin.comments.index')];
    $breadcrumbs[] = ['label' => $comment->id];
@endphp

@section('content')
    <header class="page-title-bar">
        @include('plugins.breadcrumb', ['breadcrumbs' => $breadcrumbs])
        <h1 class="page-title text-truncate">
            <i class="fas fa-comments fa-fw mr-2 text-muted"></i>
            {{ __('Комментарий ID:') . " " . $comment->id }}
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
                                <td> {{ $comment->id }} </td>
                            </tr>
                            <tr>
                                <th> {{ __('Полное имя') }} </th>
                                <td> {{ filled($comment->name) ? $comment->name : 'Аноним' }} </td>
                            </tr>
                            <tr>
                                <th> {{ __('Электронная почта') }} </th>
                                <td> {{ $comment->email }} </td>
                            </tr>
                            <tr>
                                <th> {{ __('Отзыв') }} </th>
                                <td> {{ $comment->content }} </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
