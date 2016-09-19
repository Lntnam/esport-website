@extends('layouts.back')

@section('title', trans('pages.manage', ['model' => trans('contents.content_block')]))

@section('head')
    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap-table.min.css') }}"/>
@stop

@section('page-heading', trans('pages.manage', ['model' => trans('contents.content_block')]))

@section('breadcrumbs', Breadcrumbs::render('manage_content_blocks'))

@section('content')

    <div class="clearfix">
        <p class="pull-right">
            <button id="btnCreate" type="button" class="btn btn-primary">
                @lang('contents.btn_create_model', ['model' => trans('contents.content_block')])</button>
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

            // Display //
            search: false,
            pagination: true,
            pageSize: {{ config('settings.table_page_size') }},
            showColumns: true,
            showRefresh: true,
            showToggle: true,
            showPaginationSwitch: true,
            pageList: {{ config('settings.table_page_list') }},
            sortable: true,

            // Data Settings //
            idField: 'id',
            uniqueId: 'key',
            sortName: 'key',
            sortOrder: 'asc',
            url: '{{ route('back.content_block.gridData') }}',
            escape: true,

            // Column Definitions //
            columns: [{
                title: '@lang('table.col-no')',
                width: 60,
                formatter: function (value, row, index) {
                    return index + 1;
                }
            }, {
                field: 'key',
                width: 200,
                title: '@lang('contents.content_block_key')'
            }, {
                field: 'description',
                width: 400,
                title: '@lang('contents.content_block_description')'
            }, {
                title: '@lang('table.col-command')',
                width: 100,
                align: 'center',
                formatter: function (value, row) {
                    return [
                        '<a class="btn-sm" href="' +
                        '{!! route('back.content_block.update', ['id'=>'_id_']) !!}'.replace('_id_', row.id) +
                        '" title="@lang('contents.btn-update')">' +
                        '<i class="glyphicon glyphicon-edit"></i></a>',

                        '<a class="btn-sm" href="' +
                        '{!! route('back.content_block.delete', ['id'=>'_id_']) !!}'.replace('_id_', row.id) +
                        '" title="@lang('contents.btn_delete')">' +
                        '<i class="glyphicon glyphicon-remove"></i></a>'
                    ].join('');
                }
            }]
        });
    </script>
    <script type="text/javascript">
        $('#btnCreate').click(function () {
            window.location.href = '{!! route('back.content_block.create') !!}'
        });
    </script>
@stop
