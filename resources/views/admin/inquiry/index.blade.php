@extends('layouts.admin.app')

@section('title', __('Inquiries'))

@php
    $breadcrumbs[] = ['label' => __('Baş sahypa'), 'url' => route('admin.index')];
    $breadcrumbs[] = ['label' => __('Inquiries')];
@endphp

@section('content')
    <header class="page-title-bar">
        @include('plugins.breadcrumb', ['breadcrumbs' => $breadcrumbs])
        <h1 class="page-title text-truncate">
            <i class="fas fa-inbox fa-fw mr-2 text-muted"></i>
            {{ __('Inquiries') }}
        </h1>
    </header>
    <div class="page-section">
        <div class="section-block">
            <div class="card card-body">
                <table id="datatable" class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th style="width:60px; min-width:60px;"></th>
                            <th style="width:60px; min-width:60px;"></th>
                            <th> ID </th>
                            <th> {{ __('Name') }} </th>
                            <th> {{ __('Phone') }} </th>
                            <th> {{ __('Email') }} </th>
                            <th> {{ __('Send at') }} </th>
                            <th style="width:120px; min-width:120px;"> {{ __('Actions') }} </th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('datatable')
    order: [2, 'desc'],
    ajax: "{{ route('admin.inquiries') }}",
    columns: [
    {data: 'is_read', orderable: false, searchable: false},
    {data: 'icon', orderable: false, searchable: false},
    {data: 'id'},
    {data: 'name'},
    {data: 'phone'},
    {data: 'email'},
    {data: 'created_at'},
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
