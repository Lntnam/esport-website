@extends('layouts.back')

@section('title', Setting::getMasterListValue('back_games', $game) . ' Opponents')

@section('head')
    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap-table.min.css') }}"/>
    <link rel="stylesheet" href="{{ URL::asset('css/flag-icon.min.css') }}"/>
@stop

@section('page-heading', Setting::getMasterListValue('back_games', $game) . ' Opponents')

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
            url: '{{ route('back.opponents.gridData', ['game' => $game]) }}',
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
                title: 'Team Name'
            }, {
                field: 'short',
                width: 300,
                title: 'Short Name'
            }, {
                field: 'country_name',
                width: 300,
                title: 'Country',
                formatter: function (value, row) {
                    return '<span class="flag-icon flag-icon-'+row.country.toLowerCase()+'"></span> '+value;
                }
            }, {
                field: 'matches_count',
                width: 150,
                align: 'center',
                title: 'Match Count'
            }, {
                title: 'Commands',
                width: 100,
                align: 'center',
                formatter: function (value, row) {
                    return [
                        '<a class="btn-sm" href="' +
                        '{!! route('back.opponents.update', ['id'=>'_id_']) !!}'.replace('_id_', row.id) +
                        '" title="update">' +
                        '<i class="glyphicon glyphicon-edit"></i></a>',

                        '<a class="btn-sm" href="' +
                        '{!! route('back.opponents.delete', ['id'=>'_id_']) !!}'.replace('_id_', row.id) +
                        '" title="delete">' +
                        '<i class="glyphicon glyphicon-remove"></i></a>'
                    ].join('');
                }
            }]
        });
    </script>
@stop
