@extends('layouts.front')

@section('title', ContentBlock::output($view_name, 'page_header'))

@section('page-heading', ContentBlock::output($view_name, 'page_header'))

@section('page-sub-heading', ContentBlock::output($view_name, 'sub_header'))

@section('content')
    <div class="col-lg-12">
        <p class="text-info pull-left">@lang('messages.timezone-statement', ['value'=>config('settings.default_timezone_value')])</p>
        <div class="row">
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
                @include('match._results')
                </tbody>
            </table>
        </div>
        <p class="pull-right"><a type="button" class="btn btn-default btn-sm"
                                 href="{{ URL::route('dota2.fixture.index') }}"><span
                        class="fa fa-hand-o-left"></span> @lang('contents.btn_back_to_fixtures')</a></p>
        @if ($hasMore)
            <p id="btnLoadMore"><a class="btn btn-success btn-sm" type="button" href="javascript:void(0)"><i
                            class="fa fa-caret-square-o-down" aria-hidden="true"></i> @lang('contents.btn_load_more')
                </a></p>
        @endif
    </div>
@stop

@section('foot')
    <script>
        var rowCount = {{ count($matches) }};
        $('#btnLoadMore').on('click', function () {
            $('#btnLoadMore i').removeClass('fa-caret-square-o-down');
            $('#btnLoadMore i').addClass('fa-spinner fa-pulse');

            $.get('{!! URL::route('dota2.fixture.more_results', ['offset'=>'_offset_']) !!}'.replace('_offset_', rowCount) , function (data) {
                $('#recent-table > tbody').append(data['html']);
                rowCount += data['count'];
                if (data['hasMore']) {
                    $('#btnLoadMore i').removeClass('fa-spinner fa-pulse');
                    $('#btnLoadMore i').addClass('fa-caret-square-o-down');
                }
                else {
                    $('#btnLoadMore').off();
                    $('#btnLoadMore').hide();
                }
            });
        })
    </script>
@stop
