@extends('errors::minimal')

@section('title', __('Запрещено'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'Запрещено'))
