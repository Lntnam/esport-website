@extends('layouts.back')

@section('title', trans('pages.manage_tournaments'))

@section('head')
    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap-table.min.css') }}"/>
@stop

@section('page-heading', trans('pages.manage_tournaments'))

@section('breadcrumbs', Breadcrumbs::render('manage_tournaments'))

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
            url: '{{ route('back.tournament.gridData') }}',
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
                title: '@lang('contents.tour-name')'
            }, {
                field: 'short',
                width: 300,
                title: '@lang('contents.tour-short')'
            }, {
                field: 'type',
                width: 300,
                title: '@lang('contents.tour-type')',
                formatter: function(value) {
                    return value.toUpperCase();
                }
            }, {
                field: 'homepage',
                width: 300,
                title: '@lang('contents.tour-homepage')',
                formatter: function(value) {
                    if (value != '')
                        return '<a href="'+value+'" title="" target="_blank">@lang('contents.tour-homepage')</a>';
                    else
                        return '';
                }
            }, {
                field: 'bracket',
                width: 300,
                title: '@lang('contents.tour-bracket')',
                formatter: function(value) {
                    if (value != '')
                        return '<a href="'+value+'" title="" target="_blank">@lang('contents.tour-bracket')</a>';
                    else
                        return '';
                }
            }, {
                title: '@lang('table.col-command')',
                width: 100,
                align: 'center',
                formatter: function (value, row) {
                    return [
                        '<a class="btn-sm" href="' +
                        '{!! route('back.tournament.update', ['id'=>'_id_']) !!}'.replace('_id_', row.id) +
                        '" title="@lang('contents.btn-update')">' +
                        '<i class="glyphicon glyphicon-edit"></i></a>',

                        '<a class="btn-sm" href="' +
                        '{!! route('back.tournament.delete', ['id'=>'_id_']) !!}'.replace('_id_', row.id) +
                        '" title="@lang('contents.btn_delete')">' +
                        '<i class="glyphicon glyphicon-remove"></i></a>'
                    ].join('');
                }
            }]
        });
    </script>
@stop
