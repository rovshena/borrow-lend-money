@extends('layouts.visitor.app')

@section('title', $settings['title']->value ?? 'Возьму деньги в долг')

@section('meta.description', $settings['title']->value ?? 'Возьму деньги в долг')

@section('meta.keywords', $settings['title']->value ?? 'Возьму деньги в долг')

@section('og.title', $settings['title']->value ?? 'Возьму деньги в долг')

@section('og.description', $settings['title']->value ?? 'Возьму деньги в долг')

@section('content')
    <section class="pt-5">
        <div class="container pt-5">
            <div class="mx-auto text-center" style="max-width: 856px;">
                @if(isset($settings['title']) && !is_null($settings['title']))
                <h1 class="display-6 mb-4 pb-lg-2">
                    {{ $settings['title']->value }}
                </h1>
                @endif
            </div>
        </div>
    </section>
    @if(isset($settings['header']) && !is_null($settings['header']))
    {!! $settings['header']->value !!}
    @endif
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
                                <a class="nav-link stretched-link" href="{{ route('announcement.show', $announcement->slug) }}">
                                    {{ $announcement->title }}
                                </a>
                            </h3>
                            <p class="mb-2 fs-sm text-muted">
                                {{ Str::limit(strip_tags($announcement->content), 150) }}
                            </p>
                            @if($announcement->type === \App\Models\Announcement::TYPE_LEND && filled($announcement->company))
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
    @if(isset($settings['footer']) && !is_null($settings['footer']))
        {!! $settings['footer']->value !!}
    @endif
@endsection
