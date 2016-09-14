@extends('layouts.back')

@section('title', trans('pages.site_settings'))

@section('page-heading', trans('pages.site_settings'))

@section('breadcrumbs', Breadcrumbs::render('site_settings'))

@section('content')

    <div class="row">
        <div class="col-lg-6">
            <form role="form" method="post">
                {{ csrf_field() }}
                @foreach ($settings as $setting)
                    <div class="form-group">
                        <label for="setting-{{ $setting->key }}">{{ $setting->title }}</label>
                        @if (!empty($setting->options))
                            {{ $options = json_decode($setting->options) }}
                            <select id="setting-{{ $setting->key }}" class="form-control" name="setting-{{ $setting->key }}">
                                @foreach ($options as $val => $text)
                                    <option value="{{ $val }}" {{ $val == $setting->value ? '"selected"' : '' }}>{{ $text }}</option>
                                @endforeach
                            </select>
                        @elseif ($setting->lines == 1)
                            <input id="setting-{{ $setting->key }}" type="text" class="form-control" placeholder="{{ $setting->hint }}"
                                   name="setting-{{ $setting->key }}" value="{{ $setting->value }}">
                        @else
                            <textarea id="setting-{{ $setting->key }}" class="form-control" rows="{{ $setting->lines }}"
                                      name="setting-{{ $setting->key }}">{{ $setting->value }}</textarea>
                        @endif
                    </div>
                @endforeach

                <button type="submit" class="btn btn-primary">@lang('contents.btn-submit')</button>
                <button type="reset" class="btn btn-default">@lang('contents.btn-reset')</button>
            </form>
        </div>
    </div>
@stop