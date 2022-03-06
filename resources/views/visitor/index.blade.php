@extends('layouts.visitor.app')

@section('title', Arr::exists($shared_settings, 'title') ? $shared_settings['title'] : '')

@section('meta.description', Arr::exists($shared_settings, 'description') ? $shared_settings['description'] : '')

@section('meta.keywords', Arr::exists($shared_settings, 'keyword') ? $shared_settings['keyword'] : '')

@section('og.title', Arr::exists($shared_settings, 'title') ? $shared_settings['title'] : '')

@section('og.description', Arr::exists($shared_settings, 'description') ? $shared_settings['description'] : '')

@section('content')
    <section class="py-5">
        <div class="container pt-5 pb-5">
            <div class="mb-lg-5 mx-auto text-center" style="max-width: 856px;">
                <h1 class="mb-2 pb-1">
                    Деньги <span class="text-primary">срочно!</span>
                </h1>
                <p class="mb-3">
                    Приветствуем Вас на сайте доске объявлений, где каждый человек или же организация может взять или дать деньги в долг другому частному лицу или предприятию. Как правило, людям деньги требуются срочно и займы составляют от 500 гривен и, до нескольких сотен тысяч.
                </p>
                <form class="form-group form-group-lg form-group-light rounded-pill">
                    <input class="form-control" type="text" placeholder="What are you looking for?">
                    <button class="btn btn-lg btn-primary rounded-pill px-sm-4 px-3" type="submit">
                        <i class="fi-search me-sm-2"></i>
                        <span class="d-sm-inline d-none">Search</span>
                    </button>
                </form>
            </div>
        </div>
    </section>
@endsection
