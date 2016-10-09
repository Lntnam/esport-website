@extends('layouts.modal')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            @if (count($errors) > 0)
                <div class="row">
                    <div class="col-lg-6">
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif
            <form role="form" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="game" value="{{ $game }}">
                @include('tournament._form')
            </form>
        </div>
    </div>
@stop
