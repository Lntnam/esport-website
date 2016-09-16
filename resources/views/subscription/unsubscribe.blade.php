@extends('layouts.front')

@section('title', trans('pages.unsubscribe'))

@section('page-heading', trans('pages.unsubscribe'))

@section('content')
    @if ($success)
        <p>@lang('texts.email_greeting')</p>
        <p>@lang('texts.unsubscribe_success')</p>
        <p></p>
        <p>@lang('texts.subscription_confirmation_goodbye')</p>
    @else
        <p>@lang('texts.email_greeting')</p>
        <p>@lang('texts.unsubscribe_failure')</p>
    @endif
@stop
