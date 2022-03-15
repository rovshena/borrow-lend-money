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
                    {!! $announcement->content !!}
                </div>
                @if($comments->isNotEmpty())
                    <div class="mt-4 mb-4 mb-md-5" id="comments">
                        <h4 class="mb-4 pb-2">{{ $announcement->comments()->count() }} комментарии</h4>
                        @foreach($comments as $comment)
                        <div class="border-bottom pb-4 mb-4">
                            <p>{{ $comment->content }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center pe-2">
                                    <img class="rounded-circle me-1" src="{{ asset('assets/images/avatars/placeholder.jpg') }}" width="48" alt="{{ $comment->name }}">
                                    <div class="ps-2">
                                        <h6 class="fs-base mb-0">{{ filled($comment->name) ? $comment->name : 'Аноним' }}</h6>
                                        <span class="text-muted fs-sm">
                                            @if(optional($comment->created_at)->diffInDays(now()) >= 7)
                                                {{ optional($comment->created_at)->format('d.m.Y') }}
                                            @else
                                                {{ optional($comment->created_at)->diffForHumans() }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <button class="btn btn-link btn-sm" data-comment-parent="{{ $comment->id }}" data-comment-owner="{{ filled($comment->name) ? $comment->name : 'Аноним' }}" type="button" data-bs-toggle="modal" data-bs-target="#replyCommentModal">
                                    <i class="fi-reply fs-lg me-2"></i>
                                    <span class="fw-normal">Ответить</span>
                                </button>
                            </div>
                            @if($comment->comments->isNotEmpty())
                                @foreach($comment->comments as $child_comment)
                                    <div class="border-start border-4 ps-4 ms-4 mt-4">
                                        <p>{{ $child_comment->content }}</p>
                                        <div class="d-flex align-items-center pe-2"><img class="rounded-circle me-1" src="{{ asset('assets/images/avatars/placeholder.jpg') }}" width="48" alt="{{ $child_comment->name }}">
                                            <div class="ps-2">
                                                <h6 class="fs-base mb-0">
                                                    {{ filled($child_comment->name) ? $child_comment->name : 'Аноним' }}
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
                    <div class="d-flex mb-4 justify-content-center text-center">
                        {{ $comments->links() }}
                    </div>
                @endif
            </div>
        </div>
        <div class="card py-md-4 py-3 shadow-sm">
            <div class="card-body col-lg-8 col-md-10 mx-auto px-md-0 px-4">
                <h3 class="mb-4 pb-sm-2">Добавить комментарий</h3>
                <form class="needs-validation row gy-md-4 gy-3" action="{{ route('announcement.comment', $announcement) }}" method="post" onsubmit="disableSubmitButton();">
                    @csrf
                    <div class="col-sm-6">
                        <label class="form-label" for="name">Полное имя</label>
                        <input class="form-control form-control-lg @error('name') is-invalid @enderror" type="text" id="name" value="{{ old('name') }}" name="name">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label" for="email">Электронная почта</label>
                        <input class="form-control form-control-lg @error('email') is-invalid @enderror" type="email" id="email" value="{{ old('email') }}" name="email">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="content">
                            Отзыв <abbr class="text-danger" title="{{ __('Обязательный') }}">*</abbr>
                        </label>
                        <textarea class="form-control form-control-lg @error('content') is-invalid @enderror" name="content" id="content" cols="30" rows="6" required>{{ old('content') }}</textarea>
                        @error('content')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-12 py-2">
                        <button class="btn btn-lg btn-primary" type="submit">Комментировать</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Reply Comment Modal --}}
    <div class="modal fade" id="replyCommentModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header d-block position-relative border-0 pb-0 px-sm-5 px-4">
                    <h5 class="modal-title mt-4 text-center">Ответить на <span class="modal-reply-to text-primary"></span></h5>
                    <button class="btn-close position-absolute top-0 end-0 mt-3 me-3" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-sm-5 px-4">
                    <form id="reply-comment-modal-form" action="{{ route('announcement.comment.reply', [$announcement, '?']) }}" method="post" onsubmit="disableSubmitButton();">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6 mb-3">
                                <label class="form-label" for="name">Полное имя</label>
                                <input class="form-control form-control-lg @error('name') is-invalid @enderror" type="text" id="name" value="{{ old('name') }}" name="name">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-sm-6 mb-3">
                                <label class="form-label" for="email">Электронная почта</label>
                                <input class="form-control form-control-lg @error('email') is-invalid @enderror" type="email" id="email" value="{{ old('email') }}" name="email">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label" for="content">
                                    Отзыв <abbr class="text-danger" title="{{ __('Обязательный') }}">*</abbr>
                                </label>
                                <textarea class="form-control form-control-lg @error('content') is-invalid @enderror" name="content" id="content" cols="30" rows="6" required>{{ old('content') }}</textarea>
                                @error('content')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary mb-4" type="submit">Комментировать</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {!! $footer->value !!}
@endsection

@push('page.js')
    <script>
        const replyCommentModal = document.getElementById('replyCommentModal')
        replyCommentModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget
            const replyTo = button.getAttribute('data-comment-owner')
            const parentId = button.getAttribute('data-comment-parent')
            const modalTitle = replyCommentModal.querySelector('.modal-reply-to')
            const form = document.getElementById('reply-comment-modal-form')
            form.action = (form.action).replace('?', parentId)
            modalTitle.textContent = replyTo || ''
        })

        replyCommentModal.addEventListener('hidden.bs.modal', function(event) {
            const modalTitle = replyCommentModal.querySelector('.modal-reply-to')
            modalTitle.textContent = ''
            const form = document.getElementById('reply-comment-modal-form')
            form.action = `{{ route('announcement.comment.reply', [$announcement, '?']) }}`;
        })
    </script>
@endpush
