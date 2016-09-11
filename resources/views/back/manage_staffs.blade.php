@extends('layouts.back')

@section('title', trans('pages.manage_staffs'))

@section('head')
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.11.0/bootstrap-table.min.css"/>
@stop

@section('page-heading', trans('pages.manage_staffs'))

@section('breadcrumbs', Breadcrumbs::render('manage_staffs'))

@section('content')

    <p class="pull-right">
        <button id="btnCreate" type="button" class="btn btn-primary">
            @lang('contents.btn-create-model', ['model'=>trans('contents.staff')])</button>
    </p>

    <table id="grid"></table>

@stop

@section('foot')
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.11.0/bootstrap-table.min.js"></script>
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
                if (row.root) {
                    return {classes: 'danger'};
                }
                else if (row.deleted_at != null) {
                    return {classes: 'warning'};
                }
                ;
                return {};
            },

            // Display //
            sortable: true,
            silentSort: false,

            // Data Settings //
            idField: 'id',
            uniqueId: 'id',
            sortName: 'name',
            sortOrder: 'asc',
            url: '{{ route('back.staff.gridData') }}',
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
                sortable: true,
                title: '@lang('contents.name')'
            }, {
                field: 'email',
                width: 400,
                sortable: true,
                title: '@lang('contents.email')'
            }, {
                field: 'created_at',
                width: 200,
                sortable: true,
                title: '@lang('contents.created_at')'
            }, {
                field: 'updated_at',
                width: 200,
                sortable: true,
                title: '@lang('contents.updated_at')'
            }, {
                field: 'deleted_at',
                width: 200,
                sortable: true,
                title: '@lang('contents.deleted_at')'
            }, {
                title: '@lang('table.col-command')',
                width: 100,
                align: 'center',
                formatter: function (value, row, index) {
                    var buttons = [];
                    if (row.deleted_at != null && row.deleted_at != '') {
                        buttons.push('<a class="btn-sm" href="javascript:void(0)" onclick="restoreClick(' + row.id +
                                ')" title="@lang('contents.btn-restore')">' +
                                '<i class="glyphicon glyphicon-refresh"></i></a>');
                    }
                    else {
                        buttons.push('<a class="btn-sm" href="' +
                                '{!! route('back.staff.update', ['id'=>'_id_']) !!}'.replace('_id_', row.id) +
                                '" title="@lang('contents.btn-update')">' +
                                '<i class="glyphicon glyphicon-edit"></i></a>');

                        if (!row.root) {
                            buttons.push('<a class="btn-sm" href="' +
                                    '{!! route('back.staff.delete', ['id'=>'_id_']) !!}'.replace('_id_', row.id) +
                                    '" title="@lang('contents.btn-delete')">' +
                                    '<i class="glyphicon glyphicon-remove"></i></a>');
                        }
                    }
                    return buttons.join('');
                }
            }]
        });
    </script>
    <script type="text/javascript">
        $('#btnCreate').click(function () {
            window.location.href = '{!! route('back.staff.create') !!}'
        });
        function restoreClick(id) {
            $.ajax('{!! route('back.staff.restore', ['id'=>'_id_']) !!}'.replace('_id_', id), {
                success: function (data) {
                    swal({
                        title: data.success ? '@lang('success.restored', ['model'=>'staff'])' : data.msg,
                        type: data.success ? 'success' : 'error'
                    });
                    if (data.success) {
                        $('#grid').bootstrapTable('updateByUniqueId', {id: data.model.id, row: data.model});
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    swal({
                        title: textStatus,
                        text: errorThrown,
                        type: data.success ? 'success' : 'error'
                    });
                },
            });
        }
    </script>
@stop