@extends('layouts.back')

@section('title', 'Donation')

@section('page-heading', 'Donation')

@section('content')

    <div class="row">
        @foreach ($donations as $key => $donation)
            <div class="col-lg-4">
                <form role="form" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="key" value="{{ $key }}">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="input-group">
                                <span class="input-group-addon" id="target-{{ $key }}">{{ $key }}</span>
                                <input type="text"
                                       class="form-control"
                                       name="target"
                                       value="{{ $donation['target'] }}"
                                       aria-describedby="target-{{ $key }}">
                            </div>
                        </div>
                        <div class="panel-body">
                            <ul class="list-group">
                                @foreach ($donation['sources'] as $source => $value)
                                    <input type="hidden" name="source[]" value="{{ $source }}">
                                    <li class="list-group-item">
                                        <div class="input-group">
                                            <span class="input-group-addon"
                                                  id="source-{{ $source }}">{{ $source }}</span>
                                            <input type="text"
                                                   class="form-control"
                                                   name="value[]"
                                                   value="{{ $value }}"
                                                   aria-describedby="source-{{ $source }}">
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="input-group pull-right">
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        @endforeach
    </div>
@stop
