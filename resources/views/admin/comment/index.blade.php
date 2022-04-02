@extends('layouts.admin.app')

@section('title', __('Комментарии'))

@php
    $breadcrumbs[] = ['label' => __('Главная'), 'url' => route('admin.index')];
    $breadcrumbs[] = ['label' => __('Комментарии')];
@endphp

@section('content')
    <header class="page-title-bar">
        @include('plugins.breadcrumb', ['breadcrumbs' => $breadcrumbs])
        <h1 class="page-title text-truncate">
            <i class="fas fa-comments fa-fw mr-2 text-muted"></i>
            {{ __('Комментарии') }}
        </h1>
    </header>
    <div class="page-section">
        <div class="section-block">
            <div class="card card-body">
                <table id="datatable" class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th> ID </th>
                            <th> {{ __('Полное имя') }} </th>
                            <th> {{ __('Электронная почта') }} </th>
                            <th> {{ __('Отзыв') }} </th>
                            <th style="width:120px; min-width:120px;">{{ __('Действия') }} </th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('datatable')
    order: [0, 'asc'],
    ajax: "{{ route('admin.comments.index') }}",
    columns: [
    {data: 'id'},
    {data: 'name'},
    {data: 'email'},
    {data: 'content'},
    {
    data: 'actions',
    className: 'text-right',
    orderable: false,
    searchable: false
    }
    ]
@endsection

@section('datatable-select-event')
    datatable.on('select', function(e, dt, type, indexes){
    var itemID = datatable.rows(indexes).data()[0].id;
    window.location.href = "{{ url()->current() }}" + "/" + itemID;
    });
@endsection

@include('plugins.delete_item')
