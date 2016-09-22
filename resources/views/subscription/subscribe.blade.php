@extends('layouts.front')

@section('title', ContentBlock::output($view_name, 'page_header'))

@section('page-heading', ContentBlock::output($view_name, 'page_header'))

@section('page-sub-heading', ContentBlock::output($view_name, 'sub_header'))


@section('head')
    <link href="{{ URL::asset('css/bootstrap-toggle.min.css') }}" rel="stylesheet"/>
@stop

@section('content')
    <div class="container">
        @if (count($errors) > 0)
            <div class="row">
                <div class="col-lg-6">
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-lg-6">
                <form role="form" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="interest[]" value="">
                    <div class="form-group">
                        <label for="email">@lang('contents.your_email')</label>
                        <input type="email"
                               value="{{ !empty($model) && isset($model['email']) ? $model['email'] : '' }}"
                               name="email"
                               class="form-control"
                               id="email">
                    </div>
                    <div class="form-group">
                        <label for="name">@lang('contents.your_name')</label>
                        <input type="name"
                               value="{{ !empty($model) && isset($model['name']) ? $model['name'] : '' }}"
                               name="name"
                               class="form-control"
                               id="name">
                    </div>
                    <div class="form-group">
                        @foreach ($interests as $interest => $label)
                            <div class="checkbox">
                                <label>
                                    <input type="hidden" name="interests[{{ $interest }}]" value="0">
                                    <input type="checkbox"
                                           data-toggle="toggle"
                                           name="interests[{{ $interest }}]"
                                           value="1" {!! isset($model['interests']) && $model['interests'][$interest] ? 'checked' : '' !!}>
                                    @lang('contents.interest_' . $interest)
                                </label>
                            </div>
                        @endforeach
                    </div>
                    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                    <div style="position: absolute; left: -5000px;" aria-hidden="true">
                        <input type="text" name="b_59a9a5aee257480d4f3cbe81e_f848ac684f" tabindex="-1" value="">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success pull-right"><i class="fa fa-envelope-o"
                                                                                    aria-hidden="true"></i> @lang('contents.btn_subscribe')
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('foot')
    <script src="{{ URL::asset('js/bootstrap-toggle.min.js') }}"></script>
@stop
