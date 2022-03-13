@component('mail::message')
# {{ __('Контактная форма отправлена') }}

Электронная почта: **{{ $inquiry->email }}**<br>
Полное имя: **{{ $inquiry->name }}**<br>
@if(filled($inquiry->phone))
Телефон: **{{ $inquiry->phone }}**<br>
@endif

{{ $inquiry->content }}

@endcomponent
