@extends('layouts.back')

@section('title', trans('pages.manage_matches'))

@section('head')
    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap-table.min.css') }}"/>
@stop

@section('page-heading', trans('pages.manage_matches'))

@section('breadcrumbs', Breadcrumbs::render('manage_matches'))

@section('content')

    <div class="clearfix">
        <p class="pull-right">
            <button id="btnCreate" type="button" class="btn btn-primary">
                @lang('contents.btn-create-model', ['model'=>trans('contents.match')])</button>
        </p>
    </div>

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
            url: '{{ route('back.match.gridData') }}',
            escape: true,

            // Column Definitions //
            columns: [{
                title: '@lang('table.col-no')',
                width: 60,
                formatter: function (value, row, index) {
                    return index + 1;
                }
            }, {
                field: 'date',
                width: 150,
                align: 'center',
                title: '@lang('contents.match-date')'
            }, {
                field: 'time',
                width: 80,
                align: 'center',
                title: '@lang('contents.match-time')'
            }, {
                field: 'tournament.name',
                width: 400,
                title: '@lang('contents.match-tour')',
                formatter: function(value, row) {
                    return value + (row.round != null && row.round != '' ? ' - '+row.round : '')
                }
            }, {
                field: 'opponent.name',
                width: 400,
                title: '@lang('contents.match-opponent')'
            }, {
                width: 100,
                title: '@lang('contents.match-best-of')',
                align: 'center',
                field: 'games'
            }, {
                width: 100,
                title: '@lang('contents.match-result')',
                align: 'center',
                formatter: function (value, row) {
                    return row.for + ' - ' + row.against;
                }
            }, {
                title: '@lang('table.col-command')',
                width: 100,
                align: 'center',
                formatter: function (value, row) {
                    return [
                        '<a class="btn-sm" href="' +
                        '{!! route('back.match.update', ['id'=>'_id_']) !!}'.replace('_id_', row.id) +
                        '" title="@lang('contents.btn-update')">' +
                        '<i class="glyphicon glyphicon-edit"></i></a>',

                        '<a class="btn-sm" href="' +
                        '{!! route('back.match.delete', ['id'=>'_id_']) !!}'.replace('_id_', row.id) +
                        '" title="@lang('contents.btn-delete')">' +
                        '<i class="glyphicon glyphicon-remove"></i></a>'
                    ].join('');
                }
            }]
        });
    </script>
    <script type="text/javascript">
        $('#btnCreate').click(function () {
            window.location.href = '{!! route('back.match.create') !!}'
        });
    </script>
@stop
