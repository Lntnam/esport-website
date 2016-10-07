@extends('layouts.front')

@section('title', ContentBlock::output($view_name, 'page_header'))

@section('page-heading', ContentBlock::output($view_name, 'page_header'))

@section('content')
    <div class="container">
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
        <div class="row">
            <p class="alert alert-info"
               id="payment_purpose_{{ $source }}"
               data-editable="true">{{ ContentBlock::output($view_name, 'payment_purpose_'.$source) }}</p>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <form role="form" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="source" value="{{ $source }}">
                    <div class="form-group">
                        <label for="name">@lang('contents.your_name')</label>
                        <input type="name"
                               value="{{ old('name') }}"
                               name="name"
                               class="form-control"
                               id="name">
                    </div>
                    <div class="form-group">
                        <label for="provider">@lang('contents.card_provider')</label>
                        <select name="provider" class="form-control" id="provider">
                            @foreach ($providers as $p => $p_name)
                                <option value="{{ $p }}" {!! old('provider') == $p ? 'selected' : '' !!} >{{ $p_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="pin">@lang('contents.card_pin')
                            <small>(@lang('contents.omit_the_slashes'))</small>
                        </label>
                        <input type="text"
                               value="{{ old('pin') }}"
                               name="pin"
                               class="form-control"
                               required
                               id="pin">
                    </div>
                    <div class="form-group">
                        <label for="serial">@lang('contents.card_serial')</label>
                        <input type="text"
                               value="{{ old('serial') }}"
                               name="serial"
                               class="form-control"
                               required
                               id="serial">
                    </div>

                    <div class="form-group">
                        <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha')['site_key'] }}"></div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success">@lang('contents.btn_submit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('foot')
    <script src='https://www.google.com/recaptcha/api.js'></script>
@stop
