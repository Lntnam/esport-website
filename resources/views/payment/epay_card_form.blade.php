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
                            <small id="pin_format"></small>
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
                        <button type="submit" class="btn btn-success">@lang('contents.btn_submit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('foot')
    <script type="text/javascript">
        $('#provider').on('change', function () {
            setPinPattern();
        });
        $(document).ready(function () {
            setPinPattern();
        });

        function setPinPattern() {
            var provider = $('#provider').val();
            switch (provider) {
                case 'VNP':
                case 'MGC':
                case 'ONC':
                case 'ZING':
//                    $('#pin').attr('pattern', '^\\d{12}$');
                    $('#pin_format').text('@lang('messages.card_pin_format', ['length' => 12])');
                    break;
                case 'VMS':
//                    $('#pin').attr('pattern', '^\\d{14}$');
                    $('#pin_format').text('@lang('messages.card_pin_format', ['length' => 14])');
                    break;
                case 'FPT':
//                    $('#pin').attr('pattern', '^\\d{10}$');
                    $('#pin_format').text('@lang('messages.card_pin_format', ['length' => 10])');
                    break;
                case 'VTT':
//                    $('#pin').attr('pattern', '^\\d{13,15}$');
                    $('#pin_format').text('@lang('messages.card_pin_format', ['length' => '13-15'])');
                    break;
            }
        }
    </script>
@stop