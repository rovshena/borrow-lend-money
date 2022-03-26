@extends('layouts.admin.app')

@section('title', __('Страны'))

@php
    $breadcrumbs[] = ['label' => __('Главная'), 'url' => route('admin.index')];
    $breadcrumbs[] = ['label' => __('Страны')];
@endphp

@section('content')
    <header class="page-title-bar">
        @include('plugins.breadcrumb', ['breadcrumbs' => $breadcrumbs])
        <h1 class="page-title text-truncate">
            <i class="fas fa-globe fa-fw mr-2 text-muted"></i>
            {{ __('Страны') }}
        </h1>
    </header>
    <div class="page-section">
        <div class="section-block">
            <div class="card card-body">
                <a href="{{ route('admin.countries.create') }}" class="btn btn-primary mr-auto">{{ __('Добавить страну') }}</a>
                <hr>
                <table id="datatable" class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th> ID </th>
                            <th> {{ __('Название') }} </th>
                            <th> {{ __('Slug') }} </th>
                            <th> {{ __('ISO 3') }} </th>
                            <th> {{ __('ISO 2') }} </th>
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
    ajax: "{{ route('admin.countries.index') }}",
    columns: [
    {data: 'id'},
    {data: 'name'},
    {data: 'slug'},
    {data: 'iso3'},
    {data: 'iso2'},
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
