@extends('layouts.visitor.app')

@section('title', __('Политика конфиденциальности'))

@section('meta.description', __('Политика конфиденциальности'))

@section('meta.keywords', __('Политика конфиденциальности'))

@section('og.title', __('Политика конфиденциальности'))

@section('og.description', __('Политика конфиденциальности'))

@section('content')
    <section class="pt-5">
        <div class="container pt-5">
            <div class="mx-auto text-center" style="max-width: 856px;">
                <h1 class="display-6 mb-4 pb-lg-2">
                    {{ $heading }}
                </h1>
            </div>
        </div>
    </section>
    <section class="container mb-5">
        <div class="col-md-10 mx-md-auto mx-3 mt-sm-0 mt-5 py-sm-5 py-4 px-0 rounded-3 bg-light shadow-sm">
            <div class="col-md-10 mx-md-auto mx-3 py-lg-4 px-0">
                {!! $policy->value !!}
            </div>
        </div>
    </section>
@endsection
