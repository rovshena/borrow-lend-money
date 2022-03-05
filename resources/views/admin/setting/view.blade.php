@extends('layouts.admin.app')

@section('title', __('View Setting'))

@php
    $breadcrumbs[] = ['label' => __('Home'), 'url' => route('admin.index')];
    $breadcrumbs[] = ['label' => __('Settings'), 'url' => route('admin.settings.index')];
    $breadcrumbs[] = ['label' => $setting->id];
@endphp

@section('content')
    <header class="page-title-bar">
        @include('plugins.breadcrumb', ['breadcrumbs' => $breadcrumbs])
        <h1 class="page-title text-truncate">
            <i class="fas fa-cogs fa-fw mr-2 text-muted"></i>
            {{ __('Setting ID:') . " " . $setting->id }}
        </h1>
    </header>
    <div class="page-section">
        <div class="section-block">
            <div class="card card-body">
                <a href="{{ route('admin.settings.edit', $setting) }}" class="btn btn-primary mr-auto">{{ __('Update') }}</a>
                <hr>
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle">
                        <tbody>
                            <tr>
                                <th style="min-width: 150px;"> ID </th>
                                <td> {{ $setting->id }} </td>
                            </tr>
                            <tr>
                                <th> {{ __('Key') }} </th>
                                <td> {{ $setting->key }} </td>
                            </tr>
                            <tr>
                                <th> {{ __('Description') }} </th>
                                <td> {{ $setting->description }} </td>
                            </tr>
                            @if($setting->type == 'editor')
                                <tr>
                                    <th> {{ __('Value') }} </th>
                                    <td> {!! $setting->value !!} </td>
                                </tr>
                            @else
                                <tr>
                                    <th> {{ __('Value') }} </th>
                                    <td> {{ $setting->value }} </td>
                                </tr>
                            @endif
                            <tr>
                                <th> {{ __('Status') }} </th>
                                <td> {!! $setting->status_badge !!} </td>
                            </tr>
                            <tr>
                                <th> {{ __('Created at') }} </th>
                                <td> {{ optional($setting->created_at)->format('d.m.Y H:i:s') }} </td>
                            </tr>
                            <tr>
                                <th> {{ __('Updated at') }} </th>
                                <td> {{ optional($setting->updated_at)->format('d.m.Y H:i:s') }} </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
