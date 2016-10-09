@extends('layouts.back')

@section('title', 'Manage Staffs')

@section('head')
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.11.0/bootstrap-table.min.css"/>
@stop

@section('page-heading', 'Manage Staffs')

@section('content')

    <p class="pull-right">
        <a href="{!! route('back.staff.create') !!}" id="btnCreate" type="button" class="btn btn-primary">Create Staff</a>
    </p>

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
                if (row.root) {
                    return {classes: 'danger'};
                }
                else if (row.deleted_at != null) {
                    return {classes: 'warning'};
                }
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
                title: 'No.',
                width: 60,
                formatter: function (value, row, index) {
                    return index + 1;
                }
            }, {
                field: 'name',
                width: 400,
                sortable: true,
                title: 'Name'
            }, {
                field: 'email',
                width: 400,
                sortable: true,
                title: 'Email'
            }, {
                field: 'created_at',
                width: 200,
                sortable: true,
                title: 'Created At'
            }, {
                field: 'updated_at',
                width: 200,
                sortable: true,
                title: 'Updated At'
            }, {
                field: 'deleted_at',
                width: 200,
                sortable: true,
                title: 'Deleted At'
            }, {
                title: 'Commands',
                width: 100,
                align: 'center',
                formatter: function (value, row) {
                    var buttons = [];
                    if (row.deleted_at != null && row.deleted_at != '') {
                        buttons.push('<a class="btn-sm" href="javascript:void(0)" onclick="restoreClick(' + row.id +
                                ')" title="restore">' +
                                '<i class="glyphicon glyphicon-refresh"></i></a>');
                    }
                    else {
                        buttons.push('<a class="btn-sm" href="' +
                                '{!! route('back.staff.update', ['id'=>'_id_']) !!}'.replace('_id_', row.id) +
                                '" title="update">' +
                                '<i class="glyphicon glyphicon-edit"></i></a>');

                        if (!row.root) {
                            buttons.push('<a class="btn-sm" href="' +
                                    '{!! route('back.staff.delete', ['id'=>'_id_']) !!}'.replace('_id_', row.id) +
                                    '" title="delete">' +
                                    '<i class="glyphicon glyphicon-remove"></i></a>');
                        }
                    }
                    return buttons.join('');
                }
            }]
        });
    </script>
    <script type="text/javascript">
        function restoreClick(id) {
            $.ajax('{!! route('back.staff.restore', ['id'=>'_id_']) !!}'.replace('_id_', id), {
                success: function (data) {
                    swal({
                        title: data.success ? 'Staff '+data.model.name+' was successfully restored' : data.msg,
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
                }
            });
        }
    </script>
@stop
