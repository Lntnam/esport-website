@extends('layouts.blank')

@section('title')
    {!! trans('pages.login') !!}
@stop

@section('head')
    <link href="{{ URL::asset('css/signin.css') }}" rel="stylesheet">
@stop

@section('content')

    <div class="form-login">
        <h2 class="form-login-heading">Next Gen Staff Login</h2>

        <h3 class="text-danger">You should use Chrome's Incognito mode.</h3>
        <!-- <a href="#" class="btn btn-lg btn-primary btn-block facebook" type="submit">Facebook</a> -->

        <a href="{{ route('social.redirect', ['provider' => 'google']) }}"
           class="btn btn-lg btn-primary btn-block google" type="submit">Google</a>
    </div>

@stop
