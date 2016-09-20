@extends('layouts.back')

@section('title', trans('pages.create', ['model'=>'content_block']))

@section('page-heading', trans('pages.create', ['model'=>'content_block']))

@section('breadcrumbs', Breadcrumbs::render('create_content_block'))

@section('content')
<!-- Add tournament modal -->
<div class="row">
    <div class="col-lg-6">
        <form role="form" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="view">@lang('contents.content_block_view')</label>
                <input id="view" type="text" class="form-control" name="view"
                       value="{{ !empty($model) ? $model['view'] : '' }}"/>
            </div>
            <div class="form-group">
                <label for="key">@lang('contents.content_block_key')</label>
                <input id="key" type="text" class="form-control" name="key"
                       value="{{ !empty($model) ? $model['key'] : '' }}"/>
            </div>
            <div class="form-group">
                <label for="description">@lang('contents.content_block_description')</label>
                <input id="description" type="text" class="form-control" name="description"
                       value="{{ !empty($model) ? $model['description'] : '' }}"/>
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
        $('.btn-link').click(function() {window.location.href = '{{ route('back.content_block.index') }}'});
    </script>
@stop
