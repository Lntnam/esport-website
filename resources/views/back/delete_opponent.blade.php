@extends('layouts.back')

@section('title', trans('pages.delete', ['model'=>'opponent']))

@section('page-heading', trans('pages.delete', ['model'=>'opponent']))

@section('page-sub-heading')
    @if (!empty($model))
        {{ $model['name'] }}
    @endif
@stop

@section('breadcrumbs', Breadcrumbs::render('delete_opponent', $model))

@section('content')

    @if ($deletable)
        <div class="row">
            <div class="col-lg-6">
                <form role="form" method="post" action="{{ route('back.opponent.doDelete') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $model['id'] }}">
                    <div class="jumbotron">
                        <h3><strong>{{ $model['name'] }}</strong></h3>
                        <p>@lang('messages.delete_message_1')</p>
                        <p>@lang('messages.delete_message_2')</p>
                        <p>
                            <button type="submit" class="btn btn-danger">@lang('contents.btn_delete')</button>
                            <button type="button" class="btn btn-link">@lang('contents.btn_back')</button>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-lg-6">
                <div class="jumbotron">
                    <h3><strong>{{ $model['name'] }}</strong></h3>
                    <p>@lang('messages.cannot_delete')</p>
                    <p>
                        <button type="button" class="btn btn-link">@lang('contents.btn_back')</button>
                    </p>
                </div>
            </div>
        </div>
    @endif
@stop

@section('foot')
    <script type="text/javascript">
        $('.btn-link').click(function () {
            window.location.href = '{{ route('back.opponent.index') }}'
        });
    </script>
@stop
