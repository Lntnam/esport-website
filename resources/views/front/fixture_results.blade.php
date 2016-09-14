@extends('layouts.front')

@section('title', trans('pages.results'))

@section('page-heading', trans('pages.results'))

@section('content')
    <div class="col-lg-12">
        <p class="text-info pull-left">@lang('messages.timezone-statement', ['value'=>config('settings.default_timezone_value')])</p>
        <div class="row">
            <table id="recent-table" class="table table-striped table-hover">
                <thead>
                <tr>
                    <th width="40px">#</th>
                    <th width="200px">@lang('contents.match-date')</th>
                    <th width="180px">@lang('contents.match-tour')</th>
                    <th width="300px">@lang('contents.match-opponent')</th>
                    <th width="80px" style="text-align: center;">@lang('contents.match-best-of')</th>
                    <th width="100px" style="text-align: center;">@lang('contents.match-result')</th>
                    <th width="30px" style="text-align: center;"></th>
                </tr>
                </thead>
                <tbody>
                @if (empty($matches) || count($matches) == 0)
                    <tr>
                        <td colspan="7">@lang('messages.no-matches-found')</td>
                    </tr>
                @else
                    @foreach($matches as $match)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                {{ $match->date }}
                            </td>
                            <td>
                                @if (!empty($match->tournament->bracket))
                                    <a href="{{ $match->tournament->bracket }}" title="bracket"
                                       target="_blank">{{ $match->tournament->short }}</a>
                                @else
                                    {{ $match->tournament->short }}
                                @endif
                            </td>
                            <td>
                                @if ($match->opponent != null)
                                    <span title="{{ $match->opponent->country_name }}"
                                          class="flag-icon flag-icon-{{ strtolower($match->opponent->country) }}"></span> {{ $match->opponent->name }}
                                @endif
                            </td>
                            <td align="center">{{ $match->games }}</td>
                            <td align="center">
                                {{ $match->for }} - {{ $match->against }}
                            </td>
                            <td align="center">
                                @if (!empty($match->stream))
                                    <a href="{{ $match->stream }}" target="_blank">
                                        <span class="fa fa-play fa-lg"></span>
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
        <p class="pull-right"><a class="btn btn-default btn-sm" href="{{ URL::route('front.fixture.index') }}"><span class="fa fa-link"></span> @lang('contents.btn_back_to_fixtures')</a></p>
    </div>
@stop
