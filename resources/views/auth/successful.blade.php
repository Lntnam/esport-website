@extends('layouts.blank')

@section('title')
    {!! trans('pages.login') !!}
@stop

@section('content')

    <div class="form-login">
        Successful!

        <a href="{{ route('back.logout') }}" class="btn btn-lg btn-primary btn-block" type="submit">Logout</a>
    </div>

@stop