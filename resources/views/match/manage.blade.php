@extends('layouts.back')

@section('title', Setting::getMasterListValue('back_games', $game) . ' Fixtures')

@section('head')
    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap-table.min.css') }}"/>
@stop

@section('page-heading', Setting::getMasterListValue('back_games', $game) . ' Fixtures')

@section('content')

    <div class="clearfix">
        <p class="pull-right">
            <button id="btnCreate" type="button" class="btn btn-primary">Create Match</button>
        </p>
    </div>

    <table id="grid"></table>

@stop

@section('foot')
    <script type="text/javascript" src="{{ URL::asset('js/bootstrap-table.min.js') }}"></script>
    <script type="text/javascript">
        $('#grid').bootstrapTable({
            // Style //
            classes: 'table table-no-bordered table-hover',
            striped: true,
            rowStyle: function (row) {
                if (row.over) {
                    if (row.for > row.against) return {classes: 'success'};
                    else if (row.for == row.against) return {classes: 'warning'};
                    else return {classes: 'danger'};
                }
                else return {classes: 'info'};
            },

            // Display //
            search: true,
            searchOnEnterKey: true,
            trimOnSearch: true,
            pagination: true,
            pageSize: {{ config('settings.table_page_size') }},
            showColumns: true,
            showRefresh: true,
            showToggle: true,
            showPaginationSwitch: true,
            pageList: {{ config('settings.table_page_list') }},
            sortable: false,

            // Data Settings //
            idField: 'id',
            uniqueId: 'id',
            sortName: 'schedule',
            sortOrder: 'desc',
            url: '{{ route('back.fixtures.gridData', ['game' => $game]) }}',
            escape: true,

            // Column Definitions //
            columns: [{
                title: 'No.',
                width: 60,
                formatter: function (value, row, index) {
                    return index + 1;
                }
            }, {
                field: 'date',
                width: 150,
                align: 'center',
                title: 'Date'
            }, {
                field: 'time',
                width: 80,
                align: 'center',
                title: 'Time'
            }, {
                field: 'tournament.name',
                width: 400,
                title: 'Tournament',
                formatter: function (value, row) {
                    return value + (row.round != null && row.round != '' ? ' - ' + row.round : '')
                }
            }, {
                width: 400,
                title: 'Opponent',
                formatter: function (value, row) {
                    return row.opponent != null ? row.opponent.name : 'TBD';
                }
            }, {
                width: 100,
                title: 'Best of',
                align: 'center',
                field: 'games'
            }, {
                width: 100,
                title: 'Result',
                align: 'center',
                formatter: function (value, row) {
                    return row.for + ' - ' + row.against;
                }
            }, {
                title: 'Commands',
                width: 100,
                align: 'center',
                formatter: function (value, row) {
                    return [
                        '<a class="btn-sm" href="' +
                        '{!! route('back.fixtures.update', ['id'=>'_id_']) !!}'.replace('_id_', row.id) +
                        '" title="update">' +
                        '<i class="glyphicon glyphicon-edit"></i></a>',

                        '<a class="btn-sm" href="' +
                        '{!! route('back.fixtures.delete', ['id'=>'_id_']) !!}'.replace('_id_', row.id) +
                        '" title="delete">' +
                        '<i class="glyphicon glyphicon-remove"></i></a>'
                    ].join('');
                }
            }]
        });
    </script>
    <script type="text/javascript">
        $('#btnCreate').click(function () {
            window.location.href = '{!! route('back.fixtures.create', ['game' => $game]) !!}'
        });
    </script>
@stop
