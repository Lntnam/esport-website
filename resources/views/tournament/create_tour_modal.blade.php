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
                <div class="form-group">
                    <label for="nameInput">@lang('contents.tour-name')</label>
                    <input id="nameInput" type="text" class="form-control" name="name"
                           value="{{ !empty($input) ? $input['name'] : '' }}"/>
                </div>

                <div class="form-group">
                    <label for="short">@lang('contents.tour-short')</label>
                    <input id="short" type="text" class="form-control" name="short"
                           value="{{ !empty($input) ? $input['short'] : '' }}"/>
                </div>

                <div class="form-group">
                    <label for="type">@lang('contents.tour-type')</label>
                    {!! Form::select('type', ['onlan'=>'ONLAN', 'online'=>'ONLINE', 'other'=>'Other'], !empty($input) ? $input['type'] : null, ['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    <label for="homepage">@lang('contents.tour-homepage')</label>
                    <input id="homepage" type="url" class="form-control" name="homepage"
                           value="{{ !empty($input) ? $input['homepage'] : '' }}"/>
                </div>

                <div class="form-group">
                    <label for="bracket">@lang('contents.tour-bracket')</label>
                    <input id="bracket" type="url" class="form-control" name="bracket"
                           value="{{ !empty($input) ? $input['bracket'] : '' }}"/>
                </div>
            </form>
        </div>
    </div>
@stop
