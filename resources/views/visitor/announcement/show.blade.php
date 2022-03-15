@extends('layouts.visitor.app')

@section('title', $announcement->title . ' | ' . (Arr::exists($shared_settings, 'title') ? $shared_settings['title'] : ''))

@section('meta.description', $announcement->title . ', ' . (Arr::exists($shared_settings, 'description') ? $shared_settings['description'] : ''))

@section('meta.keywords', $announcement->title . ', ' . (Arr::exists($shared_settings, 'keyword') ? $shared_settings['keyword'] : ''))

@section('og.title', $announcement->title . ' | ' . (Arr::exists($shared_settings, 'title') ? $shared_settings['title'] : ''))

@section('og.description', $announcement->title . ', ' . (Arr::exists($shared_settings, 'description') ? $shared_settings['description'] : ''))

@section('content')
    {!! $header->value !!}
    <div class="container mt-5 mb-md-4 py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <h1 class="h2 mb-4 text-center">
                    {{ $announcement->title }}
                </h1>
                <div class="mb-4 pb-1 d-flex justify-content-center">
                    <ul class="list-unstyled d-flex flex-wrap mb-0 text-nowrap">
                        <li class="me-3">
                            <i class="fi-calendar-alt me-2 mt-n1 opacity-60"></i>
                            @if(optional($announcement->created_at)->diffInDays(now()) >= 7)
                                {{ optional($announcement->created_at)->format('d.m.Y') }}
                            @else
                                {{ optional($announcement->created_at)->diffForHumans() }}
                            @endif
                        </li>
                        <li class="me-3 border-end"></li>
                        <li class="me-2">
                            {!! $announcement->type_value !!}
                        </li>
                        <li class="me-3 border-end"></li>
                        <li class="me-3">
                            <i class="fi-chat-circle me-2 mt-n1 opacity-60"></i>
                            {{ $announcement->comments()->count() }}
                        </li>
                        <li class="me-3 border-end"></li>
                        <li class="me-3">
                            <i class="fi-map-pin mt-n1 me-2"></i>
                            {{ $announcement->country->name }} / {{ $announcement->state->name }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="mb-4 pb-md-3">
                    <div class="d-flex align-items-center text-body text-decoration-none">
                        <img class="rounded-circle" src="{{ asset('assets/images/avatars/placeholder.jpg') }}" width="70" alt="{{ $announcement->name }}">
                        <div class="ps-3">
                            <h2 class="h6 mb-1">{{ $announcement->name }}</h2>
                            <span class="fs-sm me-2">
                                <i class="fi-phone me-2"></i>{{ $announcement->phone }}
                            </span>
                            <span class="fs-sm me-2">
                                <i class="fi-mail me-2"></i>{{ $announcement->email }}
                            </span>
                            @if($announcement->type === \App\Models\Announcement::TYPE_LEND)
                                <span class="fs-sm me-2">
                                    <i class="fi-building me-2"></i>{{ $announcement->company }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="mb-5" style="text-align: justify">
                    {{ $announcement->content }}
                </div>
                @if($announcement->masterComments->isNotEmpty())
                    <div class="mt-4 mb-4 mb-md-5" id="comments">
                        <h4 class="mb-4 pb-2">{{ $announcement->comments()->count() }} comments</h4>
                        @foreach($announcement->masterComments as $comment)
                        <div class="border-bottom pb-4 mb-4">
                            <p>{{ $comment->content }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center pe-2">
                                    <img class="rounded-circle me-1" src="{{ asset('assets/images/avatars/placeholder.jpg') }}" width="48" alt="{{ $comment->name }}">
                                    <div class="ps-2">
                                        <h6 class="fs-base mb-0">{{ $comment->name }}</h6>
                                        <span class="text-muted fs-sm">
                                            @if(optional($comment->created_at)->diffInDays(now()) >= 7)
                                                {{ optional($comment->created_at)->format('d.m.Y') }}
                                            @else
                                                {{ optional($comment->created_at)->diffForHumans() }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <button class="btn btn-link btn-sm" type="button">
                                    <i class="fi-reply fs-lg me-2"></i>
                                    <span class="fw-normal">Reply</span>
                                </button>
                            </div>
                            @if($comment->comments->isNotEmpty())
                                @foreach($comment->comments as $child_comment)
                                    <div class="border-start border-4 ps-4 ms-4 mt-4">
                                        <p>{{ $child_comment->content }}</p>
                                        <div class="d-flex align-items-center pe-2"><img class="rounded-circle me-1" src="{{ asset('assets/images/avatars/placeholder.jpg') }}" width="48" alt="{{ $child_comment->name }}">
                                            <div class="ps-2">
                                                <h6 class="fs-base mb-0">
                                                    {{ $child_comment->name }}
                                                </h6>
                                                <span class="text-muted fs-sm">
                                                    @if(optional($child_comment->created_at)->diffInDays(now()) >= 7)
                                                        {{ optional($child_comment->created_at)->format('d.m.Y') }}
                                                    @else
                                                        {{ optional($child_comment->created_at)->diffForHumans() }}
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
        <div class="card py-md-4 py-3 shadow-sm">
            <div class="card-body col-lg-8 col-md-10 mx-auto px-md-0 px-4">
                <h3 class="mb-4 pb-sm-2">Leave your comment</h3>
                <form class="needs-validation row gy-md-4 gy-3" novalidate="">
                    <div class="col-sm-6">
                        <label class="form-label" for="comment-name">Name</label>
                        <input class="form-control form-control-lg" type="text" id="comment-name" placeholder="Enter your name" required="">
                        <div class="invalid-feedback">Please enter your name.</div>
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label" for="comment-email">Email</label>
                        <input class="form-control form-control-lg" type="email" id="comment-email" placeholder="Enter your email" required="">
                        <div class="invalid-feedback">Please provide a valid email address.</div>
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="comment-text">Comment</label>
                        <textarea class="form-control form-control-lg" id="comment-text" rows="4" placeholder="Type comment here" required=""></textarea>
                        <div class="invalid-feedback">Please type your comment.</div>
                    </div>
                    <div class="col-12 py-2">
                        <button class="btn btn-lg btn-primary" type="submit">Post comment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {!! $footer->value !!}
@endsection
