@extends('layouts.back')

@section('title', 'Manage Content Blocks')

@section('head')
    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap-table.min.css') }}"/>
@stop

@section('page-heading', 'Manage Content Blocks')

@section('content')

    <div class="clearfix">
        <ul class="list-inline pull-right">
            <li>
                <a id="btnEdit" type="button" class="btn btn-info" href="{!! route('back.content_block.live_edit_start') !!}">Live Edit</a>
            </li>
        </ul>
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

            // Display //
            search: false,
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
            uniqueId: 'key',
            url: '{{ route('back.content_block.gridData') }}',
            escape: true,

            // Column Definitions //
            columns: [{
                title: 'No.',
                width: 60,
                formatter: function (value, row, index) {
                    return index + 1;
                }
            }, {
                field: 'view',
                width: 100,
                title: 'View Name'
            }, {
                field: 'key',
                width: 200,
                title: 'Key'
            }, {
                field: 'description',
                width: 400,
                title: 'Description'
            }, {
                title: 'Commands',
                width: 100,
                align: 'center',
                formatter: function (value, row) {
                    return [
                        '<a class="btn-sm" href="' +
                        '{!! route('back.content_block.delete', ['id'=>'_id_']) !!}'.replace('_id_', row.id) +
                        '" title="delete">' +
                        '<i class="glyphicon glyphicon-remove"></i></a>'
                    ].join('');
                }
            }]
        });
    </script>
@stop
