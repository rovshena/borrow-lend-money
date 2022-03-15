@extends('layouts.admin.app')

@section('title', __('Объявления'))

@php
    $breadcrumbs[] = ['label' => __('Главная'), 'url' => route('admin.index')];
    $breadcrumbs[] = ['label' => __('Объявления')];
@endphp

@section('content')
    <header class="page-title-bar">
        @include('plugins.breadcrumb', ['breadcrumbs' => $breadcrumbs])
        <h1 class="page-title text-truncate">
            <i class="fas fa-bullhorn fa-fw mr-2 text-muted"></i>
            {{ __('Объявления') }}
        </h1>
    </header>
    <div class="page-section">
        <div class="section-block">
            <div class="card card-body">
                <table id="datatable" class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th> ID</th>
                            <th> {{ __('Страна') }} </th>
                            <th> {{ __('Область') }} </th>
                            <th> {{ __('Заголовок') }} </th>
                            <th> {{ __('Тип') }} </th>
                            <th> {{ __('VIP') }} </th>
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
    ajax: "{{ route('admin.announcements.index') }}",
    columns: [
    {data: 'id'},
    {data: 'country_id'},
    {data: 'state_id'},
    {data: 'title'},
    {data: 'type'},
    {data: 'is_vip'},
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
