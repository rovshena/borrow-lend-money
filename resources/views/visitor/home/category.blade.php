@extends('layouts.visitor.app')

@section('title', $settings['title']->value . ' | ' . (Arr::exists($shared_settings, 'title') ? $shared_settings['title'] : ''))

@section('meta.description', $settings['title']->value . ', ' . (Arr::exists($shared_settings, 'description') ? $shared_settings['description'] : ''))

@section('meta.keywords', $settings['title']->value . ', ' . (Arr::exists($shared_settings, 'keyword') ? $shared_settings['keyword'] : ''))

@section('og.title', $settings['title']->value . ' | ' . (Arr::exists($shared_settings, 'title') ? $shared_settings['title'] : ''))

@section('og.description', $settings['title']->value . ', ' . (Arr::exists($shared_settings, 'description') ? $shared_settings['description'] : ''))

@section('content')
    <div id="app">
        <section class="pt-5">
            <div class="container pt-5">
                <div class="mx-auto text-center" style="max-width: 856px;">
                    <h1 class="display-6 mb-4 pb-lg-2">
                        {{ $settings['title']->value }}
                    </h1>
                </div>
            </div>
        </section>
        @if(!request()->route()->hasParameter('city'))
            {!! $settings['header']->value !!}
        @endif
        @if(request()->route()->hasParameter('country') || request()->route()->hasParameter('city'))
            <section class="container mb-5">
                <div class="col-md-10 mx-md-auto mx-3 mt-sm-0 mt-5 py-sm-5 py-4 px-0 rounded-3 bg-light shadow-sm">
                    <div class="col-md-10 mx-md-auto mx-3 py-lg-4 px-0">
                        {!! $settings['content']->value !!}
                    </div>
                </div>
            </section>
        @endif
        @if(request()->route()->parameter('category') == 'geo' && !request()->route()->hasParameter('city'))
            <section class="pb-5">
                <div class="container">
                    <div class="mx-auto text-center" style="max-width: 856px;">
                        <h6 class="mb-2 text-left">Поиск по городов</h6>
                        <div class="form-group form-group-lg rounded-pill">
                            <input
                                class="form-control"
                                type="text"
                                placeholder="Что вы ищете?"
                                @input="searchCities"
                            >
                        </div>
                    </div>
                </div>
            </section>
            <section v-if="!cities.length" class="container">
                <div class="row g-4 mb-3 pb-3 justify-content-center">
                    @forelse($announcements as $announcement)
                        <div class="col-sm-6 col-xl-3">
                            <div class="card shadow-sm card-hover border-0 h-100">
                                <div class="card-body pb-3">
                                    <h3 class="h6 mb-2 fs-base">
                                        <a class="nav-link stretched-link" href="{{ route('category', ['geo', request()->route()->parameter('country'), $announcement->slug]) }}">
                                            {{ $announcement->name }}
                                        </a>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    @empty
                    @endforelse
                </div>
                <div class="d-flex mb-4 justify-content-center text-center">
                    {{ $announcements->links() }}
                </div>
            </section>
            <section v-else class="container">
                <div class="row g-4 mb-3 pb-3 justify-content-center">
                    <div v-for="city in cities"
                         :key="city.id"
                         class="col-sm-6 col-xl-3"
                    >
                        <div class="card shadow-sm card-hover border-0 h-100">
                            <div class="card-body pb-3">
                                <h3 class="h6 mb-2 fs-base">
                                    <a
                                        :href="`/category/geo/{{ request()->route()->parameter('country') }}/${ city.slug }`"
                                        class="nav-link stretched-link"
                                        v-html="city.name"
                                    >
                                    </a>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @else
            <section class="container">
                <div class="row g-4 mb-3 pb-3 justify-content-center">
                    @forelse($announcements as $announcement)
                        <div class="col-sm-6 col-xl-3">
                            <div class="card shadow-sm card-hover border-0 h-100">
                                <div class="card-body pb-3">
                                    <h4 class="mb-1">
                                        @if($announcement->is_vip)
                                            <i class="star-rating-icon active fi-star-filled"></i>
                                        @endif
                                        {!! $announcement->type_value !!}
                                    </h4>
                                    <h3 class="h6 mb-2 fs-base">
                                        <a class="nav-link stretched-link" href="{{ route('announcement.show', [$announcement->id, $announcement->slug]) }}">
                                            {{ $announcement->title }}
                                        </a>
                                    </h3>
                                    <p class="mb-2 fs-sm text-muted">
                                        {{ Str::limit(strip_tags($announcement->content), 150) }}
                                    </p>
                                    @if($announcement->type === \App\Models\Announcement::TYPE_LEND)
                                        <div class="fs-sm">
                                            <i class="fi-building mt-n1 me-2"></i>
                                            {{ $announcement->company }}
                                        </div>
                                    @endif
                                    <div class="fs-sm">
                                        <i class="fi-map-pin mt-n1 me-2"></i>
                                        {{ $announcement->country->name }} / {{ $announcement->city->name }}
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="text-body fs-sm">
                                <span class="me-2 pe-1">
                                    <i class="fi-calendar-alt opacity-60 mt-n1 me-1"></i>
                                    @if(optional($announcement->created_at)->diffInDays(now()) >= 7)
                                        {{ optional($announcement->created_at)->format('d.m.Y') }}
                                    @else
                                        {{ optional($announcement->created_at)->diffForHumans() }}
                                    @endif
                                </span>
                                        <span>
                                    <i class="fi-chat-circle opacity-60 mt-n1 me-1"></i>
                                    {{ $announcement->comments()->count() }}
                                </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                    @endforelse
                </div>
                <div class="d-flex mb-4 justify-content-center text-center">
                    {{ $announcements->links() }}
                </div>
            </section>
        @endif
        {!! $settings['footer']->value !!}
    </div>
@endsection

@if(request()->route()->parameter('category') == 'geo' && !request()->route()->hasParameter('city'))
@push('page.js')
    <script>
        window.searchApiUrl = {{ \Illuminate\Support\Js::from(route('search.city', $country->id)) }};
    </script>
    <script src="{{ asset(mix('assets/visitor/js/app.min.js')) }}"></script>
@endpush
@endif
