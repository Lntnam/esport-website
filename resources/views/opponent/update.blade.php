@extends('layouts.back')

@section('title', 'Updating ' . Setting::getMasterListValue('back_games', $game) . ' Opponent')

@section('page-heading', 'Updating ' . Setting::getMasterListValue('back_games', $game) . ' Opponent')

@section('page-sub-heading', $model->name)

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <form role="form" method="post" action="{!! route('back.opponents.doUpdate') !!}">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{ old('id', $model->id) }}">

                @include('opponent._form')

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">@lang('contents.btn_submit')</button>
                    <button type="reset" class="btn btn-default">@lang('contents.btn_reset')</button>
                    <a href="{{ route('back.tournaments.index', ['game' => $model->game]) }}" type="button" class="btn btn-link">&laquo; Back</a>
                </div>
            </form>
        </div>
    </div>
@stop