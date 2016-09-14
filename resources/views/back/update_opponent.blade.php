@extends('layouts.back')

@section('title', trans('pages.update', ['model'=>'opponent']))

@section('page-heading', trans('pages.update', ['model'=>'opponent']))

@section('page-sub-heading')
    @if (!empty($model))
        {{ $model['name'] }}
    @endif
@stop

@section('breadcrumbs', Breadcrumbs::render('update_opponent', $model))

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <form role="form" method="post" action="{!! URL::route('back.opponent.doUpdate') !!}">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $model['id'] }}">
                <div class="form-group">
                    <label for="nameInput">@lang('contents.team-name')</label>
                    <input id="nameInput" type="text" class="form-control" name="name"
                           value="{{ !empty($model) ? $model['name'] : '' }}"/>
                </div>

                <div class="form-group">
                    <label for="short">@lang('contents.team-short')</label>
                    <input id="short" type="text" class="form-control" name="short"
                           value="{{ !empty($model) ? $model['short'] : '' }}"/>
                </div>

                <div class="form-group">
                    <label for="country">@lang('contents.team-country')</label>
                    {!! Form::select('country',
                        \CountryList::getList(\App::getLocale()),
                        !empty($model) ? $model['country'] : null,
                        ['class'=>'form-control'])
                    !!}
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">@lang('contents.btn_submit')</button>
                    <button type="reset" class="btn btn-default">@lang('contents.btn_reset')</button>
                    <button type="button" class="btn btn-link">@lang('contents.btn_back')</button>
                </div>
            </form>
        </div>
    </div>
@stop

@section('foot')
    <script type="text/javascript">
        $('.btn-link').click(function () {
            window.location.href = '{{ route('back.opponent.index') }}'
        });
    </script>
@stop
