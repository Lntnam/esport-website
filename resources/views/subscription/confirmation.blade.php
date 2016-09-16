@extends('layouts.front')

@section('title', trans('pages.subscribe'))

@section('page-heading', trans('pages.subscribe'))

@section('content')
    @if (Session::get('success'))
        <p>@lang('texts.email_greeting')</p>
        <p>@lang('texts.subscription_confirmation_content')</p>
        <p></p>
        <p>@lang('texts.subscription_confirmation_goodbye')</p>
    @else
        <p>@lang('texts.email_greeting')</p>
        <p>@lang('texts.subscription_error')</p>
    @endif
@stop
