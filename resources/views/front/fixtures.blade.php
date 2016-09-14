@extends('layouts.front')

@section('title', trans('pages.fixtures'))

@section('page-heading', trans('pages.fixtures'))
@section('page-sub-heading', trans('pages.sub_fixtures'))

@section('content')
    <div class="col-lg-12">
        <p class="text-info pull-left">@lang('messages.timezone-statement', ['value'=>config('settings.default_timezone_value')])</p>
        <p class="pull-right">
            <a href="{!! URL::route('front.fixture.rss', ['locale'=>\App::getLocale()]) !!}" title="RSS" target="_blank"><span class="fa fa-rss-square fa-2x"></span></a></p>
        <div class="clearfix"></div>
        <div class="row">
            <h2 id="live">@lang('pages.live')</h2>
            <table id="live-table" class="table table-striped table-hover">
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
                </tbody>
            </table>
        </div>
        <div class="row">
            <h2 id="upcoming" class="panel-danger">@lang('pages.upcoming')</h2>
            <table id="upcoming-table" class="table table-striped table-hover">
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
                </tbody>
            </table>
        </div>
        <div class="row">
            <h2 id="recent">@lang('pages.recent')</h2>
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
                </tbody>
            </table>
            <p class="pull-right"><a class="btn btn-default btn-sm" href="{{ URL::route('front.fixture.results') }}"><span class="fa fa-link"></span> @lang('contents.btn_all_results')</a></p>
        </div>
        <div class="row">
            <h2 id="subscribe">@lang('pages.subscribe')</h2>
            <!-- Begin MailChimp Signup Form -->
            <div class="col-lg-6">
                <form action="//next-gen.us14.list-manage.com/subscribe/post?u=59a9a5aee257480d4f3cbe81e&amp;id=f848ac684f"
                      method="post" target="_blank" novalidate>
                    <input type="hidden" name="group[443][1]" value="1">
                    <div class="form-group">
                        <label for="mce-EMAIL">@lang('contents.your-email')</label>
                        <input type="email" value="" name="EMAIL" class="form-control" id="mce-EMAIL">
                    </div>
                    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                    <div style="position: absolute; left: -5000px;" aria-hidden="true">
                        <input type="text" name="b_59a9a5aee257480d4f3cbe81e_f848ac684f" tabindex="-1" value="">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">@lang('contents.btn-subscribe')</button>
                    </div>
                </form>
            </div>
        </div>
        <!--End mc_embed_signup-->

    </div>
@stop

@section('foot')
    <script type="text/javascript">
        function load(kind) {
            $('#' + kind + '-table > tbody').load('{!! URL::route('front.fixture.data', ['kind'=>':kind:']) !!}'.replace(':kind:', kind));
        }
        $('document').ready(function () {
            load('live');
            load('upcoming');
            load('recent');
            startCounter();
        });

        function startCounter() {
            setTimeout(startCounter, 10000);
            load('live');
            load('upcoming');
            load('recent');
        }
    </script>
@stop
