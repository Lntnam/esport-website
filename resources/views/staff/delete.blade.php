@extends('layouts.back')

@section('title', 'Deleting Staff')

@section('page-heading', 'Deleting Staff')

@section('page-sub-heading', $model['name'])

@section('content')

    <div class="row">
        <div class="col-lg-6">
            <form role="form" method="post" action="{{ route('back.staff.doDelete') }}">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $model['id'] }}">
                <div class="jumbotron">
                    <h1>{{ $model['name'] }}</h1>
                    <h3>{{ $model['email'] }}</h3>
                    <p>Is about to be deleted.</p>
                    <p>This action is irreversible! Are you sure to continue?</p>
                    <p>
                        <button type="submit" class="btn btn-danger">Delete</button>
                        <a href="{!! route('back.staff.index') !!}" type="button" class="btn btn-link">&laquo; Back</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
@stop
