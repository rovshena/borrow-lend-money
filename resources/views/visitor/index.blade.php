@extends('layouts.visitor.app')

@section('title', Arr::exists($shared_settings, 'title') ? $shared_settings['title'] : '')

@section('meta.description', Arr::exists($shared_settings, 'description') ? $shared_settings['description'] : '')

@section('meta.keywords', Arr::exists($shared_settings, 'keyword') ? $shared_settings['keyword'] : '')

@section('og.title', Arr::exists($shared_settings, 'title') ? $shared_settings['title'] : '')

@section('og.description', Arr::exists($shared_settings, 'description') ? $shared_settings['description'] : '')

@section('content')
    <div id="app">
        <section class="pt-5 pb-3">
            <div class="container pt-5 pb-3">
                <div class="mx-auto text-center" style="max-width: 856px;">
                    @if($settings->where('key', 'home_page_title')->isNotEmpty())
                    <h1 class="mb-2 pb-1">
                        {{ $settings->where('key', 'home_page_title')->first()->value }}
                    </h1>
                    @endif
                    @if($settings->where('key', 'home_page_excerpt')->isNotEmpty())
                    <p class="mb-4">
                        {{ $settings->where('key', 'home_page_excerpt')->first()->value }}
                    </p>
                    @endif
                    <h6 class="mb-2 text-left">Поиск по обьявлениям городов</h6>
                    <div class="form-group form-group-lg rounded-pill">
                        <input
                            class="form-control"
                            type="text"
                            placeholder="Что вы ищете?"
                            @input="searchAnnouncements"
                        >
                    </div>
                </div>
            </div>
        </section>
        <section v-if="!announcements.length" class="container">
            <div class="row g-4 mb-4 pb-3 pt-4 justify-content-center">
                @forelse($cities as $city)
                    <div class="col-sm-6 col-xl-3">
                        <div class="card shadow-sm card-hover border-0 h-100">
                            <div class="card-body pb-3">
                                <h3 class="h6 mb-2 fs-base">
                                    <a class="nav-link stretched-link" href="{{ route('country', [$city->country_slug, $city->city_slug]) }}">
                                        {{ $city->country }} / {{ $city->city }}
                                    </a>
                                </h3>
                            </div>
                        </div>
                    </div>
                @empty
                @endforelse
            </div>
            <div class="d-flex mb-4 justify-content-center text-center">
                {{ $cities->links() }}
            </div>
        </section>
        <section v-else class="container">
            <div class="row g-4 mb-4 pb-3 pt-4 justify-content-center">
                <div
                    v-for="announcement in announcements"
                    :key="announcement.id"
                    class="col-sm-6 col-xl-3"
                >
                    <div class="card shadow-sm card-hover border-0 h-100">
                        <div class="card-body pb-3">
                            <h3 class="h6 mb-2 fs-base">
                                <a
                                    class="nav-link stretched-link"
                                    :href="`/announcement/${ announcement.slug }`"
                                    v-html="announcement.title"
                                >
                                </a>
                            </h3>
                            <div class="fs-sm">
                                <i class="fi-map-pin mt-n1 me-2"></i>
                                <span v-html="announcement.country"></span> / <span v-html="announcement.city"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('page.js')
    <script>
        window.searchApiUrl = {{ \Illuminate\Support\Js::from(route('search')) }};
    </script>
    <script src="{{ asset(mix('assets/visitor/js/app.min.js')) }}"></script>
@endpush
