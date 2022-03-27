@extends('layouts.visitor.app')

@section('title', __('Кредит калькулятор'))

@section('meta.description', __('Кредит калькулятор'))

@section('meta.keywords', __('Кредит калькулятор'))

@section('og.title', __('Кредит калькулятор'))

@section('og.description', __('Кредит калькулятор'))

@section('content')
    <section class="pt-5">
        <div class="container pt-5">
            <div class="mx-auto text-center" style="max-width: 856px;">
                <h1 class="display-6 mb-4 pb-lg-2">
                    Кредит калькулятор
                </h1>
            </div>
        </div>
    </section>
    {!! $credit_calculator->value !!}
@endsection
