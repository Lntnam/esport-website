@extends('layouts.back')

@section('title', trans('pages.create', ['model'=>'User']))

@section('page-heading', trans('pages.create', ['model'=>'Staff']))

@section('breadcrumbs', Breadcrumbs::render('create_staff'))

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <form role="form" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name">@lang('contents.name')</label>
                    <input type="text" class="form-control" placeholder="Name or nick name"
                           name="name" value="{{ !empty($input) ? $input['name'] : '' }}">
                </div>

                <div class="form-group">
                    <label for="email">@lang('contents.email')</label>
                    <input type="text" class="form-control" placeholder="someone@gmail.com"
                           name="email" value="{{ !empty($input) ? $input['email'] : '' }}">
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
            window.location.href = '{{ route('back.staff.index') }}'
        });
    </script>
@stop
