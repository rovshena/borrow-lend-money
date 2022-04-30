@extends('layouts.visitor.app')

@section('title', __('О нас'))

@section('meta.description', __('О нас'))

@section('meta.keywords', __('О нас'))

@section('og.title', __('О нас'))

@section('og.description', __('О нас'))

@section('content')
    <section class="py-5">
        <div class="container pt-5">
            <div class="mb-lg-5 mx-auto text-center" style="max-width: 856px;">
                <h1 class="display-6 mb-4 pb-lg-2">
                    {{ $heading }}
                </h1>
                @if(!empty($about_us_excerpt))
                <p class="lead">
                    {{ !is_null($about_us_excerpt) ? $about_us_excerpt->value : '' }}
                </p>
                @endif
            </div>
        </div>
    </section>
    <section class="container mb-5">
        <div class="col-md-10 mx-md-auto mx-3 mt-sm-0 mt-5 py-sm-5 py-4 px-0 rounded-3 bg-light shadow-sm">
            <div class="col-md-10 mx-md-auto mx-3 py-lg-4 px-0">
                {!! $about_us->value !!}
            </div>
        </div>
    </section>
@endsection
