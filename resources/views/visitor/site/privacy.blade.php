@extends('layouts.visitor.app')

@section('title', __('Privacy Policy') . ' | ' . (Arr::exists($shared_settings, 'title') ? $shared_settings['title'] : ''))

@section('meta.description', __('Privacy Policy') . ', ' . (Arr::exists($shared_settings, 'description') ? $shared_settings['description'] : ''))

@section('meta.keywords', __('Privacy Policy') . ', ' . (Arr::exists($shared_settings, 'keyword') ? $shared_settings['keyword'] : ''))

@section('og.title', __('Privacy Policy') . ' | ' . (Arr::exists($shared_settings, 'title') ? $shared_settings['title'] : ''))

@section('og.description', __('Privacy Policy') . ', ' . (Arr::exists($shared_settings, 'description') ? $shared_settings['description'] : ''))

@section('content')

@endsection
