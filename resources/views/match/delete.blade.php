@extends('layouts.back')

@section('title', 'Delete ' . Setting::getMasterListValue('back_games', $game) . ' Match')

@section('page-heading', 'Delete ' . Setting::getMasterListValue('back_games', $game) . ' Match')

@section('page-sub-heading', ' vs ' . (!empty($model->opponent) ? $model->opponent->name : 'TBD' ))

@section('content')

    <div class="row">
        <div class="col-lg-6">
            <form role="form" method="post" action="{{ route('back.fixtures.doDelete') }}">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $model['id'] }}">
                <div class="jumbotron">
                    <h3>Match against <strong>{{ !empty($model->opponent) ? $model->opponent->name : 'TBD' }}</strong></h3>
                    <h3>on <strong>{{ \Timezone::convertFromUTC($model['schedule'], config('settings.default_timezone')) }}</strong></h3>
                    <p>Is about to be deleted.</p>
                    <p>This action is irreversible! Are you sure to continue?</p>
                    <p>
                        <button type="submit" class="btn btn-danger">Delete</button>
                        <a href="{{ route('back.fixtures.index', ['game' => $game]) }}" type="button" class="btn btn-link">&laquo; Back</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
@stop
