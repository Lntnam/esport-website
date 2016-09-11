@extends('layouts.front')

@section('title', trans('pages.home'))

@section('content')
    <div class="jumbotron">
        <h1>@lang('texts.home-welcome')</h1>
        <p>@lang('texts.home-intro')</p>
        <p>@lang('texts.home-call-out')</p>
        <p class="text-info">@lang('texts.home-contact')</p>
        <p>@lang('texts.home-for-fan')</p>
        <p> </p>
        <p class="text-muted">@lang('texts.website-under-construction')</p>
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4">
                <p>
                    <a class="btn btn-success btn-lg" href="{!! URL::route('front.fixture.index') !!}">@lang('contents.btn-call-fixtures')</a>
                </p>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4">
                <p>
                    <a class="btn btn-info btn-lg" href="https://gaming.youtube.com/c/NextGenDOTA2VN" target="_blank">@lang('contents.btn-call-stream')</a>
                </p>
            </div>
        </div>
    </div>
@stop