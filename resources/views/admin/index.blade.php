@extends('layouts.admin.app')

@section('title', __('Dashboard'))

@section('content')
    <header class="page-title-bar">
        <h1 class="page-title text-truncate">
            <i class="fas fa-home fa-fw mr-2 text-muted"></i>
            {{ __('Dashboard') }}
        </h1>
    </header>
    <div class="page-section">
        <div class="section-block">
            <h5>Hi, {{ auth()->user()->name }}.</h5>
            {{ __("Here's what's happening with your business today.") }}
        </div>
    </div>
@endsection
