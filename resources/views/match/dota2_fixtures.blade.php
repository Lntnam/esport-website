@extends('layouts.front')

@section('title', ContentBlock::output($view_name, 'page_header'))

@section('page-heading', ContentBlock::output($view_name, 'page_header'))

@section('page-sub-heading', ContentBlock::output($view_name, 'sub_header'))

@section('content')
    <div class="col-lg-12">
        <p class="text-info pull-left">@lang('messages.timezone-statement', ['value'=>config('settings.default_timezone_value')])</p>
        <p class="pull-right">
            <a href="{!! URL::route('dota2.fixture.rss', ['locale'=>\App::getLocale()]) !!}" title="RSS"
               target="_blank"><span class="fa fa-rss-square fa-2x"></span></a></p>
        <div class="clearfix"></div>
        <div class="row">
            <h2 id="live_heading" data-editable="true">{!! ContentBlock::output($view_name, 'live_heading') !!}</h2>
            <table id="live-table" class="table table-striped table-hover">
                <thead>
                <tr>
                    <th width="40px">#</th>
                    <th width="150px">@lang('contents.match-date')</th>
                    <th width="200px">@lang('contents.match-tour')</th>
                    <th width="300px">@lang('contents.match-opponent')</th>
                    <th width="80px" style="text-align: center;">@lang('contents.match-best-of')</th>
                    <th width="100px" style="text-align: center;">@lang('contents.match-result')</th>
                    <th width="30px" style="text-align: center;"></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td colspan="7"><i id="live-loading" class="fa fa-circle-o-notch fa-spin"
                                       style="font-size:20px"></i></td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="row">
            <h2 id="upcoming_heading" data-editable="true">{!! ContentBlock::output($view_name, 'upcoming_heading') !!}</h2>
            <table id="upcoming-table" class="table table-striped table-hover">
                <thead>
                <tr>
                    <th width="40px">#</th>
                    <th width="150px">@lang('contents.match-date')</th>
                    <th width="200px">@lang('contents.match-tour')</th>
                    <th width="300px">@lang('contents.match-opponent')</th>
                    <th width="80px" style="text-align: center;">@lang('contents.match-best-of')</th>
                    <th width="100px" style="text-align: center;">@lang('contents.match-result')</th>
                    <th width="30px" style="text-align: center;"></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td colspan="7"><i id="upcoming-loading" class="fa fa-circle-o-notch fa-spin"
                                       style="font-size:20px"></i></td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="row">
            <h2 id="recent_heading" data-editable="true">{!! ContentBlock::output($view_name, 'recent_heading') !!}</h2>
            <table id="recent-table" class="table table-striped table-hover">
                <thead>
                <tr>
                    <th width="40px">#</th>
                    <th width="150px">@lang('contents.match-date')</th>
                    <th width="200px">@lang('contents.match-tour')</th>
                    <th width="300px">@lang('contents.match-opponent')</th>
                    <th width="80px" style="text-align: center;">@lang('contents.match-best-of')</th>
                    <th width="100px" style="text-align: center;">@lang('contents.match-result')</th>
                    <th width="30px" style="text-align: center;"></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td colspan="7"><i id="recent-loading" class="fa fa-circle-o-notch fa-spin"
                                       style="font-size:20px"></i></td>
                </tr>
                </tbody>
            </table>
            <p class="pull-right"><a class="btn btn-default btn-sm"
                                     href="{{ URL::route('dota2.fixture.results') }}"><span
                            class="fa fa-link"></span> @lang('contents.btn_all_results')</a></p>
        </div>
        <div class="row">
            <h2 id="subscribe_heading" data-editable="true">{!! ContentBlock::output($view_name, 'subscribe_heading') !!}</h2>
            @include('subscription._form', ['interest' => 'd796835b62'])
        </div>
    </div>
@stop

@section('foot')
    <script type="text/javascript">
        $('document').ready(function () {
            $.get('{!! URL::route('dota2.fixture.data', ['kind'=>'live']) !!}', function (data) {
                $('#live-loading').hide();
                $('#live-table > tbody').html(data);
            });
            $.get('{!! URL::route('dota2.fixture.data', ['kind'=>'upcoming']) !!}', function (data) {
                $('#upcoming-loading').hide();
                $('#upcoming-table > tbody').html(data);
            });
            $.get('{!! URL::route('dota2.fixture.data', ['kind'=>'recent']) !!}', function (data) {
                $('#recent-loading').hide();
                $('#recent-table > tbody').html(data);
            });

            startCounter();
        });

        function startCounter() {
            setTimeout(startCounter, 10000);
            $.get('{!! URL::route('dota2.fixture.data', ['kind'=>'live']) !!}', function (data) {
                $('#live-loading').hide();
                $('#live-table > tbody').html(data);
            });
            $.get('{!! URL::route('dota2.fixture.data', ['kind'=>'upcoming']) !!}', function (data) {
                $('#upcoming-loading').hide();
                $('#upcoming-table > tbody').html(data);
            });
            $.get('{!! URL::route('dota2.fixture.data', ['kind'=>'recent']) !!}', function (data) {
                $('#recent-loading').hide();
                $('#recent-table > tbody').html(data);
            });
        }
    </script>
@stop
