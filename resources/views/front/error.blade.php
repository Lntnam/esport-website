@extends('layouts.front')

@section('title', 'ERROR')

@section('page-heading', 'Error!')

@section('content')
    <div class="alert alert-danger" role="alert">
        Error [{{ Session::get('code') }}]: {{ Session::get('message') }}
    </div>
    <p>Please contact <a href="mailto:admin@next-gen.vn">admin@next-gen.vn</a>.</p>
@stop
