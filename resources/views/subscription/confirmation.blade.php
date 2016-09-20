@extends('layouts.front')

@section('title', ContentBlock::output($view_name, 'page_header'))

@section('page-heading', ContentBlock::output($view_name, 'page_header'))

@section('content')
    @if (Session::get('success'))
        <p id="successful_text" data-editable="true">{!! ContentBlock::output($view_name, 'successful_text') !!}</p>
    @else
        <p id="unsuccessful_text" data-editable="true">{!! ContentBlock::output($view_name, 'unsuccessful_text') !!}</p>
    @endif
@stop
