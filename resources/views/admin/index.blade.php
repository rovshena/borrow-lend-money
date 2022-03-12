@extends('layouts.admin.app')

@section('title', __('Панель администратора'))

@section('content')
    <header class="page-title-bar">
        <h1 class="page-title text-truncate">
            <i class="fas fa-home fa-fw mr-2 text-muted"></i>
            {{ __('Панель администратора') }}
        </h1>
    </header>
    <div class="page-section">
        <div class="section-block">
            <h5>Привет, {{ auth()->user()->name }}.</h5>
            {{ __('Вот что происходит с вашим бизнесом сегодня.') }}
        </div>
    </div>
@endsection
