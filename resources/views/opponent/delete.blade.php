@extends('layouts.back')

@section('title', 'Deleting ' . Setting::getMasterListValue('back_games', $model->game) . ' Opponent')

@section('page-heading', 'Deleting ' . Setting::getMasterListValue('back_games', $model->game) . ' Opponent')

@section('page-sub-heading', $model->name)

@section('content')

    @if ($deletable)
        <div class="row">
            <div class="col-lg-6">
                <form role="form" method="post" action="{{ route('back.opponents.doDelete') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $model->id }}">
                    <div class="jumbotron">
                        <h3><strong>{{ $model->name }}</strong></h3>
                        <p>Is about to be deleted.</p>
                        <p>This action is irreversible! Are you sure to continue?</p>
                        <p>
                            <button type="submit" class="btn btn-danger">Delete</button>
                            <a href="{{ route('back.opponents.index', ['game' => $model->game]) }}" type="button" class="btn btn-link">&laquo; Back</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-lg-6">
                <div class="jumbotron">
                    <h3><strong>{{ $model->name }}</strong></h3>
                    <p>This opponent cannot be deleted.</p>
                    <p>
                        <a href="{{ route('back.opponents.index', ['game' => $model->game]) }}" type="button" class="btn btn-link">&laquo; Back</a>
                    </p>
                </div>
            </div>
        </div>
    @endif
@stop