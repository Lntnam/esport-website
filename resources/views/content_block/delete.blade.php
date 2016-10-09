@extends('layouts.back')

@section('title', 'Deleting Content Block')

@section('page-heading', 'Deleting Content Block')

@section('page-sub-heading', $model['view'] . ' / ' . $model['key'])

@section('content')

    <div class="row">
        <div class="col-lg-6">
            <form role="form" method="post" action="{{ route('back.content_block.doDelete') }}">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $model['id'] }}">
                <div class="jumbotron">
                    <h3>Content block [<strong>{{ $model['view'] . ' / ' . $model['key'] }}</strong>]</h3>
                    <p>Is about to be deleted.</p>
                    <p>This action is irreversible! Are you sure to continue?</p>
                    <p>
                        <button type="submit" class="btn btn-danger">Delete</button>
                        <a href="{!! route('back.content_block.index') !!}" type="button" class="btn btn-link">&laquo; Back</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
@stop
