@extends('layouts.front')

@section('title', ContentBlock::output($view_name, 'page_header'))

@section('page-heading', ContentBlock::output($view_name, 'page_header'))

@section('page-sub-heading', ContentBlock::output($view_name, 'sub_header'))

@section('head')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        var data = [['@lang('contents.month')', '@lang('contents.wins')', '@lang('contents.losses')', '@lang('contents.ratio')']];
        var maxcount = 0;
        var mincount = 0;

        /* rendering chart */
        google.charts.load('current', {'packages': ['corechart'], callback: drawVisualization});
        $(function () {
            data = google.visualization.arrayToDataTable(data);
            console.log(data);
            var options = {
//            title : 'Monthly Coffee Production by Country',
                hAxis: {title: '@lang('contents.month')'},
                vAxes: {
                    0: {
                        title: '@lang('contents.matches')',
                        format: '0',
                        scaleType: 'linear',
                        gridlines: {
                            count: 6,
                        }
                    },
                    1: {
                        title: '@lang('contents.ratio')',
                        format: 'percent',
                        viewWindow: {
                            max: 1,
                            min: 0
                        },
                        gridlines: {
                            count: 6,
                        }
                    }
                },
                series: {
                    0: {type: 'bars', targetAxisIndex: 0},
                    1: {type: 'bars', targetAxisIndex: 0},
                    2: {type: 'line', targetAxisIndex: 1}
                },
                colors: ['#18BC9C', '#E74C3C', '#EC8F6E']
            };
            console.log(options);
            var chart = new google.visualization.ComboChart(document.getElementById('chart'));
            console.log(chart);
            chart.draw(data, options);
        });
//        google.charts.setOnLoadCallback(function () {
//
//        });
    </script>
@stop

@section('content')
    <div class="col-lg-7 col-md-6 col-sm-12">
        <div class="row">
            <table id="stat-table" class="table">
                <thead>
                <tr>
                    <th width="150px"></th>
                    @for ($i = 0; $i < Config::get('settings.past_stats_months'); $i ++)
                        <th width="100px">{{ strftime('%b', DateTime::createFromFormat('!m', date('n') - $i)->getTimestamp()) }}</th>
                        <script>
                            data.push([
                                '{{ strftime('%B', DateTime::createFromFormat('!m', date('n') - $i)->getTimestamp()) }}',
                                {{ $stats[date('n') - $i]['w'] }},
                                {{ 0 - $stats[date('n') - $i]['l'] }},
                                {{ $stats[date('n') - $i]['t'] == 0 ? 0 : round($stats[date('n') - $i]['w'] / $stats[date('n') - $i]['t'], 1) }}
                            ]);
                            maxcount = Math.max(maxcount, {{ $stats[date('n') - $i]['w'] }});
                            mincount = Math.min(mincount, {{ 0 - $stats[date('n') - $i]['l'] }});
                        </script>
                    @endfor
                    <th width="100px">@lang('contents.all_time')</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>@lang('contents.winrate')</td>
                    @for ($i = 0; $i < Config::get('settings.past_stats_months'); $i ++)
                        <td>{{ $stats[date('n') - $i]['t'] == 0 ? 0 : round($stats[date('n') - $i]['w'] / $stats[date('n') - $i]['t'] * 100) }}
                            %
                        </td>
                    @endfor
                    <td>{{ $stats['all']['t'] == 0 ? 0 : round($stats['all']['w'] / $stats['all']['t'] * 100) }}%</td>
                </tr>
                <tr>
                    <td>@lang('contents.match_played')</td>
                    @for ($i = 0; $i < Config::get('settings.past_stats_months'); $i ++)
                        <td><span class="text-success">{{ $stats[date('n') - $i]['w'] }}</span> /
                            <span class="text-default">{{ $stats[date('n') - $i]['d'] }}</span> /
                            <span class="text-danger">{{ $stats[date('n') - $i]['l'] }}</span></td>
                    @endfor
                    <td><span class="text-success">{{ $stats['all']['w'] }}</span> /
                        <span class="text-default">{{ $stats['all']['d'] }}</span> /
                        <span class="text-danger">{{ $stats['all']['l'] }}</span></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-lg-5 col-md-6 col-sm-12">
        <div id="chart" style="width: 100%;"></div>
    </div>
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
    <script type="text/javascript">
        var rowCount = {{ count($matches) }};
        $('#btnLoadMore').on('click', function () {
            $('#btnLoadMore i').removeClass('fa-caret-square-o-down');
            $('#btnLoadMore i').addClass('fa-spinner fa-pulse');

            $.get('{!! URL::route('dota2.fixture.more_results', ['offset'=>'_offset_']) !!}'.replace('_offset_', rowCount), function (data) {
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
