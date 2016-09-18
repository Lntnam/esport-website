@extends('layouts.back')

@section('title', trans('pages.delete', ['model'=>'content_block']))

@section('page-heading', trans('pages.delete', ['model'=>'content_block']))

@section('page-sub-heading')
    @if (!empty($model))
        {{ $model['key'] }}
    @endif
@stop

@section('breadcrumbs', Breadcrumbs::render('delete_content_block', $model))

@section('content')

    <div class="row">
        <div class="col-lg-6">
            <form role="form" method="post" action="{{ route('back.content_block.doDelete') }}">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $model['id'] }}">
                <div class="jumbotron">
                    <h3>Content block [<strong>{{ $model['key'] }}</strong>]</h3>
                    <p>Is about to be deleted.</p>
                    <p>This action is irreversible! Are you sure to continue?</p>
                    <p>
                        <button type="submit" class="btn btn-danger">@lang('contents.btn_delete')</button>
                        <button type="button" class="btn btn-link">@lang('contents.btn_back')</button>
                    </p>
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
