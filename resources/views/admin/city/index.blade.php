@extends('layouts.admin.app')

@section('title', __('Города'))

@php
    $breadcrumbs[] = ['label' => __('Главная'), 'url' => route('admin.index')];
    $breadcrumbs[] = ['label' => __('Города')];
@endphp

@section('content')
    <header class="page-title-bar">
        @include('plugins.breadcrumb', ['breadcrumbs' => $breadcrumbs])
        <h1 class="page-title text-truncate">
            <i class="fas fa-globe fa-fw mr-2 text-muted"></i>
            {{ __('Города') }}
        </h1>
    </header>
    <div class="page-section">
        <div class="section-block">
            <div class="card card-body">
                <a href="{{ route('admin.cities.create') }}" class="btn btn-primary mr-auto">{{ __('Добавить город') }}</a>
                <hr>
                <table id="datatable" class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th> ID </th>
                            <th> {{ __('Название') }} </th>
                            <th> {{ __('Область') }} </th>
                            <th> {{ __('Регион') }} </th>
                            <th> {{ __('Страна') }} </th>
                            <th> {{ __('Статус') }} </th>
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
    ajax: "{{ route('admin.cities.index') }}",
    columns: [
    {data: 'id'},
    {data: 'name'},
    {data: 'oblast'},
    {data: 'region'},
    {data: 'country_id'},
    {data: 'status'},
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
