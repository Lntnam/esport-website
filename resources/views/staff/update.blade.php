@extends('layouts.back')

@section('title', 'Updating Staff')

@section('page-heading', 'Updating Staff')

@section('page-sub-heading', $model['name'])

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <form role="form" method="post" action="{!! route('back.staff.doUpdate') !!}">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{ old('id', $model['id']) }}">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" placeholder="Name or nick name"
                           name="name" value="{{ old('name', $model['name']) }}">
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" placeholder="someone@gmail.com"
                           name="email" value="{{ old('email', $model['email']) }}">
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-default">Reset</button>
                <a href="{!! route('back.staff.index') !!}" type="button" class="btn btn-link" >&laquo; Back</a>
            </form>
        </div>
    </div>
@stop
