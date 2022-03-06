@extends('layouts.visitor.app')

@section('title', __('Privacy Policy') . ' | ' . (Arr::exists($shared_settings, 'title') ? $shared_settings['title'] : ''))

@section('meta.description', __('Privacy Policy') . ', ' . (Arr::exists($shared_settings, 'description') ? $shared_settings['description'] : ''))

@section('meta.keywords', __('Privacy Policy') . ', ' . (Arr::exists($shared_settings, 'keyword') ? $shared_settings['keyword'] : ''))

@section('og.title', __('Privacy Policy') . ' | ' . (Arr::exists($shared_settings, 'title') ? $shared_settings['title'] : ''))

@section('og.description', __('Privacy Policy') . ', ' . (Arr::exists($shared_settings, 'description') ? $shared_settings['description'] : ''))

@section('content')
    <section class="pt-5">
        <div class="container pt-5">
            <div class="mx-auto text-center" style="max-width: 856px;">
                <h1 class="display-6 mb-4 pb-lg-2">
                    Privacy Policy
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
