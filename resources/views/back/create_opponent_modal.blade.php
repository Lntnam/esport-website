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
                    <label for="nameInput">@lang('contents.team-name')</label>
                    <input id="nameInput" type="text" class="form-control" name="name"
                           value="{{ !empty($input) ? $input['name'] : '' }}"/>
                </div>

                <div class="form-group">
                    <label for="short">@lang('contents.team-short')</label>
                    <input id="short" type="text" class="form-control" name="short"
                           value="{{ !empty($input) ? $input['short'] : '' }}"/>
                </div>

                <div class="form-group">
                    <label for="country">@lang('contents.team-country')</label>
                    {!! Form::select('country',
                        \CountryList::getList(\App::getLocale()),
                        !empty($input) ? $input['country'] : null,
                        ['class'=>'form-control'])
                    !!}
                </div>

                <div class="form-group">
                    <label for="flag">@lang('contents.team-flag')</label>
                    <input id="flag" type="url" class="form-control" name="flag"
                           value="{{ !empty($input) ? $input['flag'] : '' }}"/>
                </div>
            </form>
        </div>
    </div>
@stop