@extends('layouts.admin.app')

@section('title', __('Пользователи'))

@php
    $breadcrumbs[] = ['label' => __('Главная'), 'url' => route('admin.index')];
    $breadcrumbs[] = ['label' => __('Пользователи')];
@endphp

@section('content')
    <header class="page-title-bar">
        @include('plugins.breadcrumb', ['breadcrumbs' => $breadcrumbs])
        <h1 class="page-title text-truncate">
            <i class="fas fa-user-friends fa-fw mr-2 text-muted"></i>
            {{ __('Пользователи') }}
        </h1>
    </header>
    <div class="page-section">
        <div class="section-block">
            <div class="card card-body">
                <a href="{{ route('admin.users.create') }}" class="btn btn-primary mr-auto">{{ __('Добавить пользователя') }}</a>
                <hr>
                <table id="datatable" class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th> ID </th>
                            <th> {{ __('Имя пользователя') }} </th>
                            <th> {{ __('Полное имя') }} </th>
                            <th style="width:160px; min-width:160px;"> {{ __('Действия') }} </th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('datatable')
    order: [0, 'asc'],
    ajax: "{{ route('admin.users.index') }}",
    columns: [
    {data: 'id'},
    {data: 'username'},
    {data: 'name'},
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
    window.location.href = "{{ url()->current() }}" + "/" + itemID + "/edit";
    });
@endsection

@include('plugins.delete_item')
