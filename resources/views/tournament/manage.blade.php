@extends('layouts.back')

@section('title', Setting::getMasterListValue('back_games', $game) . ' Tournaments')

@section('head')
    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap-table.min.css') }}"/>
@stop

@section('page-heading', Setting::getMasterListValue('back_games', $game) . ' Tournaments')

@section('content')

    <table id="grid"></table>

@stop

@section('foot')
    <script type="text/javascript" src="{{ URL::asset('js/bootstrap-table.min.js') }}"></script>
    <script type="text/javascript">
        $('#grid').bootstrapTable({
            // Style //
            classes: 'table table-no-bordered table-hover',
            striped: true,

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
            sortName: 'name',
            sortOrder: 'asc',
            url: '{{ route('back.tournaments.gridData', ['game' => $game]) }}',
            escape: true,

            // Column Definitions //
            columns: [{
                title: 'No.',
                width: 60,
                formatter: function (value, row, index) {
                    return index + 1;
                }
            }, {
                field: 'name',
                width: 400,
                title: 'Tournament Name'
            }, {
                field: 'short',
                width: 300,
                title: 'Short Name'
            }, {
                field: 'type',
                width: 300,
                title: 'Type',
                formatter: function(value) {
                    return value.toUpperCase();
                }
            }, {
                field: 'homepage',
                width: 300,
                title: 'Info Link',
                formatter: function(value) {
                    if (value != '')
                        return '<a href="'+value+'" title="" target="_blank">Link</a>';
                    else
                        return '';
                }
            }, {
                field: 'bracket',
                width: 300,
                title: 'Bracket Link',
                formatter: function(value) {
                    if (value != '')
                        return '<a href="'+value+'" title="" target="_blank">Link</a>';
                    else
                        return '';
                }
            }, {
                title: 'Commands',
                width: 100,
                align: 'center',
                formatter: function (value, row) {
                    return [
                        '<a class="btn-sm" href="' +
                        '{!! route('back.tournaments.update', ['id'=>'_id_']) !!}'.replace('_id_', row.id) +
                        '" title="update">' +
                        '<i class="glyphicon glyphicon-edit"></i></a>',

                        '<a class="btn-sm" href="' +
                        '{!! route('back.tournaments.delete', ['id'=>'_id_']) !!}'.replace('_id_', row.id) +
                        '" title="delete">' +
                        '<i class="glyphicon glyphicon-remove"></i></a>'
                    ].join('');
                }
            }]
        });
    </script>
@stop
