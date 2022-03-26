@extends('layouts.visitor.app')

@section('title', __('Дать деньги'))

@section('meta.description', __('Дать деньги'))

@section('meta.keywords', __('Дать деньги'))

@section('og.title', __('Дать деньги'))

@section('og.description', __('Дать деньги'))

@section('content')
    <div class="container mt-5 mb-md-4 py-5">
        <div class="row justify-content-center pb-sm-2">
            <div class="col-lg-11 col-xl-10 mt-5">
                <div class="text-center pb-4 mb-3 mt-2">
                    <h1 class="h2 mb-4">
                        Подать бесплатное объявление (Дать деньги)
                    </h1>
                </div>
                <div class="bg-faded-info rounded-3 p-4 p-md-5 mb-3">
                    <form action="{{ route('lend.money.store') }}" method="post" onsubmit="disableSubmitButton();">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6 mb-4">
                                <label class="form-label" for="country_id">
                                    Страна <abbr class="text-danger" title="{{ __('Обязательный') }}">*</abbr>
                                </label>
                                <select class="form-select form-select-lg @error('country_id') is-invalid @enderror" id="country_id" name="country_id" required>
                                    <option value="">Не выбрано</option>
                                    @foreach($countries as $country)
                                        <option value="{{ $country->id }}" {{ old('country_id') == $country->id ? 'selected' : (count($countries) == 1 ? 'selected' : '') }}>{{ $country->name }}</option>
                                    @endforeach
                                </select>
                                @error('country_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-sm-6 mb-4">
                                <label class="form-label" for="city_id">
                                    Город <abbr class="text-danger" title="{{ __('Обязательный') }}">*</abbr>
                                </label>
                                <select class="form-select form-select-lg @error('city_id') is-invalid @enderror" id="city_id" name="city_id" required disabled>
                                    <option value="">Не выбрано</option>
                                </select>
                                @error('city_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-12 mb-4">
                                <label class="form-label" for="title">
                                    Заголовок <abbr class="text-danger" title="{{ __('Обязательный') }}">*</abbr>
                                </label>
                                <input class="form-control form-control-lg @error('title') is-invalid @enderror" type="text" id="title" name="title" value="{{ old('title') }}" required>
                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-12 mb-4">
                                <label class="form-label" for="content">
                                    Условия займа и сроки возврата <abbr class="text-danger" title="{{ __('Обязательный') }}">*</abbr>
                                </label>
                                <textarea class="form-control form-control-lg @error('content') is-invalid @enderror" name="content" id="content" cols="30" rows="6" required>{{ old('content') }}</textarea>
                                @error('content')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-4">
                                <label class="form-label" for="name">
                                    Полное имя <abbr class="text-danger" title="{{ __('Обязательный') }}">*</abbr>
                                </label>
                                <input class="form-control form-control-lg @error('name') is-invalid @enderror" type="text" id="name" name="name" value="{{ old('name') }}" required>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-4">
                                <label class="form-label" for="email">
                                    Электронная почта
                                </label>
                                <input class="form-control form-control-lg @error('email') is-invalid @enderror" type="email" id="email" name="email" value="{{ old('email') }}">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-4">
                                <label class="form-label" for="phone">
                                    Телефон
                                </label>
                                <input class="form-control form-control-lg @error('phone') is-invalid @enderror" type="text" id="phone" name="phone" value="{{ old('phone') }}" maxlength="15">
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-4">
                                <label class="form-label" for="company">
                                    Название компании <abbr class="text-danger" title="{{ __('Обязательный') }}">*</abbr>
                                </label>
                                <input class="form-control form-control-lg @error('company') is-invalid @enderror" type="text" id="company" name="company" value="{{ old('company') }}" required>
                                @error('company')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-8 mb-4">
                                <div class="mb-4">
                                    <label class="form-label" for="captcha">
                                        Код с картинки <abbr class="text-danger" title="{{ __('Обязательный') }}">*</abbr>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <button id="reload-captcha" type="button" class="btn btn-secondary btn-sm me-1">
                                                <i class="fas fa-sync"></i>
                                            </button>
                                            <span class="captcha"> {!! captcha_img() !!} </span>
                                        </span>
                                        <input id="captcha" class="form-control form-control-lg @error('captcha') is-invalid @enderror" type="text" name="captcha" required>
                                        @error('captcha')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-lg rounded-pill d-flex align-items-center justify-content-center" id="submit-button">
                                    <span id="loading" class="spinner-border spinner-border-sm d-none me-2" role="status" aria-hidden="true"></span> {{ __('Опубликовать') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page.js')
    <script>
        $(function () {
            $('#reload-captcha').click(function () {
                const $icon = $(this).find('i')
                const $button = $(this)
                $icon.addClass('fa-spin')
                $button.prop('disabled', true)
                $.ajax({
                    type: 'GET',
                    url: '{{ route('reload-captcha') }}',
                    success: function (data) {
                        $('.captcha').html(data.captcha);
                    },
                    complete: function () {
                        setTimeout(function () {
                            $icon.removeClass('fa-spin')
                            $button.prop('disabled', false)
                        }, 500)
                    }
                });
            })

            $('#country_id').change(async function () {
                const country_id = this.value
                const $citySelectBox = $('#city_id')
                $citySelectBox.children().remove()
                $citySelectBox.append(`<option value="">Не выбрано</option>`)
                if (country_id !== '') {
                    $citySelectBox.prop('disabled', false)
                    await loadCities(country_id, $citySelectBox)
                } else {
                    $citySelectBox.append(`<option value="">Не выбрано</option>`)
                    $citySelectBox.prop('disabled', true)
                }
            })

            async function loadCities(country_id, $citySelectBox) {
                await $.ajax({
                    type: 'get',
                    url: `{{ route('country.cities', 'country') }}`.replace('country', country_id),
                    success: (response, textStatus, xhr) => {
                        if (response && Array.isArray(response) && response.length) {
                            const oldCityId = {{ \Illuminate\Support\Js::from(old('city_id')) }}
                            response.forEach((city) => {
                                $citySelectBox.append(`
                                    <option value="${ city.id }" ${ parseInt(oldCityId) === city.id ? 'selected' : '' }>${ city.name }</option>
                                `);
                            })
                        }
                    },
                    error: (error) => {
                        console.log(error)
                    },
                })
            }

            $('#country_id').trigger('change')
        })
    </script>
@endpush
