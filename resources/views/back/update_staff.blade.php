@extends('layouts.back')

@section('title', trans('pages.update', ['model'=>'User']))

@section('page-heading', trans('pages.update', ['model'=>'Staff']))

@section('page-sub-heading')
    @if (!empty($model))
        {{ $model['name'] }}
    @endif
@stop

@section('breadcrumbs', Breadcrumbs::render('update_staff', $model))

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <form role="form" method="post" action="{!! route('back.staff.doUpdate') !!}">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $model['id'] }}">
                <div class="form-group">
                    <label for="name">@lang('contents.name')</label>
                    <input type="text" class="form-control" placeholder="Name or nick name"
                           name="name" value="{{ $model['name'] }}">
                </div>

                <div class="form-group">
                    <label for="email">@lang('contents.email')</label>
                    <input type="text" class="form-control" placeholder="someone@gmail.com"
                           name="email" value="{{ $model['email'] }}">
                </div>

                <button type="submit" class="btn btn-primary">@lang('contents.btn-submit')</button>
                <button type="reset" class="btn btn-default">@lang('contents.btn-reset')</button>
                <button type="button" class="btn btn-link" >@lang('contents.btn-back')</button>
            </form>
        </div>
    </div>
@stop

@section('foot')
    <script type="text/javascript">
        $('.btn-link').click(function() {window.location.href = '{{ route('back.staff.index') }}'});
    </script>
@stop
