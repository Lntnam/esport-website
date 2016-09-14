@extends('layouts.back')

@section('title', trans('pages.manage_opponents'))

@section('head')
    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap-table.min.css') }}"/>
    <link rel="stylesheet" href="{{ URL::asset('css/flag-icon.min.css') }}"/>
@stop

@section('page-heading', trans('pages.manage_opponents'))

@section('breadcrumbs', Breadcrumbs::render('manage_opponents'))

@section('content')

    <table id="grid"></table>

@stop

@section('foot')
    <script type="text/javascript" src="{{ URL::asset('js/bootstrap-table.min.js') }}"></script>
    <script type="text/javascript">
        $('#grid').bootstrapTable({
            // Localization //
            formatLoadingMessage: function () {
                return '@lang('table.loading')';
            },
            formatRecordsPerPage: function (pageNumber) {
                return '@lang('table.record-per-page')'.replace('%1', pageNumber);
            },
            formatShowingRows: function (pageFrom, pageTo, totalRows) {
                return '@lang('table.showing-rows')'.replace('%1', pageFrom).replace('%2', pageTo).replace('%3', totalRows);
            },
            formatDetailPagination: function (totalRows) {
                return '@lang('table.detail-pagination')'.replace('%1', totalRows);
            },
            formatSearch: function () {
                return '@lang('table.search')';
            },
            formatNoMatches: function () {
                return '@lang('table.no-matches')';
            },
            formatRefresh: function () {
                return '@lang('table.refresh')';
            },
            formatToggle: function () {
                return '@lang('table.toggle')';
            },
            formatColumns: function () {
                return '@lang('table.columns')';
            },
            formatAllRows: function () {
                return '@lang('table.all-rows')';
            },

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
            url: '{{ route('back.opponent.gridData') }}',
            escape: true,

            // Column Definitions //
            columns: [{
                title: '@lang('table.col-no')',
                width: 60,
                formatter: function (value, row, index) {
                    return index + 1;
                }
            }, {
                field: 'name',
                width: 400,
                title: '@lang('contents.team-name')'
            }, {
                field: 'short',
                width: 300,
                title: '@lang('contents.team-short')'
            }, {
                field: 'country_name',
                width: 300,
                title: '@lang('contents.team-country')',
                formatter: function (value, row) {
                    return '<span class="flag-icon flag-icon-'+row.country.toLowerCase()+'"></span> '+value;
                }
            }, {
                field: 'matches_count',
                width: 150,
                align: 'center',
                title: '@lang('contents.team_matches_count')'
            }, {
                title: '@lang('table.col-command')',
                width: 100,
                align: 'center',
                formatter: function (value, row) {
                    return [
                        '<a class="btn-sm" href="' +
                        '{!! route('back.opponent.update', ['id'=>'_id_']) !!}'.replace('_id_', row.id) +
                        '" title="@lang('contents.btn-update')">' +
                        '<i class="glyphicon glyphicon-edit"></i></a>',

                        '<a class="btn-sm" href="' +
                        '{!! route('back.opponent.delete', ['id'=>'_id_']) !!}'.replace('_id_', row.id) +
                        '" title="@lang('contents.btn-delete')">' +
                        '<i class="glyphicon glyphicon-remove"></i></a>'
                    ].join('');
                }
            }]
        });
    </script>
@stop
