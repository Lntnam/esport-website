@extends('layouts.back')

@section('title', trans('pages.update', ['model'=>'tournament']))

@section('page-heading', trans('pages.update', ['model'=>'tournament']))

@section('page-sub-heading')
    @if (!empty($model))
        {{ $model['name'] }}
    @endif
@stop

@section('breadcrumbs', Breadcrumbs::render('update_tournament', $model))

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <form role="form" method="post" action="{!! URL::route('back.tournament.doUpdate') !!}">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $model['id'] }}">
                <div class="form-group">
                    <label for="nameInput">@lang('contents.tour-name')</label>
                    <input id="nameInput" type="text" class="form-control" name="name"
                           value="{{ !empty($model) ? $model['name'] : '' }}"/>
                </div>

                <div class="form-group">
                    <label for="short">@lang('contents.tour-short')</label>
                    <input id="short" type="text" class="form-control" name="short"
                           value="{{ !empty($model) ? $model['short'] : '' }}"/>
                </div>

                <div class="form-group">
                    <label for="type">@lang('contents.tour-type')</label>
                    {!! Form::select('type', ['onlan'=>'ONLAN', 'online'=>'ONLINE', 'other'=>'Other'], !empty($model) ? $model['type'] : null, ['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    <label for="homepage">@lang('contents.tour-homepage')</label>
                    <input id="homepage" type="url" class="form-control" name="homepage"
                           value="{{ !empty($model) ? $model['homepage'] : '' }}"/>
                </div>

                <div class="form-group">
                    <label for="bracket">@lang('contents.tour-bracket')</label>
                    <input id="bracket" type="url" class="form-control" name="bracket"
                           value="{{ !empty($model) ? $model['bracket'] : '' }}"/>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">@lang('contents.btn-submit')</button>
                    <button type="reset" class="btn btn-default">@lang('contents.btn-reset')</button>
                    <button type="button" class="btn btn-link">@lang('contents.btn-back')</button>
                </div>
            </form>
        </div>
    </div>
@stop

@section('foot')
    <script type="text/javascript">
        $('.btn-link').click(function () {
            window.location.href = '{{ route('back.tournament.index') }}'
        });
    </script>
@stop