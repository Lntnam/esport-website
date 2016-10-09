@extends('layouts.back')

@section('title', 'Create Staff')

@section('page-heading', 'Create Staff')

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <form role="form" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" placeholder="Name or nick name"
                           name="name" value="{{ old('name', $input['name']) }}">
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" placeholder="someone@gmail.com"
                           name="email" value="{{ old('email', $input['email']) }}">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="reset" class="btn btn-default">Reset</button>
                    <a href="{!! route('back.staff.index') !!}" type="button" class="btn btn-link">&laquo; Back</a>
                </div>
            </form>
        </div>
    </div>
@stop
