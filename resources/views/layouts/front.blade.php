<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="{{ Setting::get('meta-description') }}">
    <meta name="keywords" content="{{ Setting::get('meta-keywords') }}">
    <meta name="robots" content="index,follow">

    <!-- favicon -- really? does it need to be this complicated??? -->
    <link rel="apple-touch-icon" sizes="57x57" href="{{ URL::asset('favicons/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ URL::asset('favicons/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ URL::asset('favicons/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ URL::asset('favicons/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ URL::asset('favicons/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ URL::asset('favicons/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ URL::asset('favicons/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ URL::asset('favicons/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ URL::asset('favicons/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ URL::asset('favicons/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ URL::asset('favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ URL::asset('favicons/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ URL::asset('favicons/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ URL::asset('favicons/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ URL::asset('favicons/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">

    <title>{{ Setting::get('title') }} - @yield('title')</title>

    <!-- Bootstrap core CSS -->
    <link href="{!! URL::asset('css/bootstrap.min.css') !!}" rel="stylesheet">
    <link href="{{ URL::asset('css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/flag-icon.min.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{!! URL::asset('css/front/landing-page.css') !!}" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600|Roboto:300,400,500&subset=vietnamese"
          rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="{{ URL::asset('css/ie10-viewport-bug-workaround.css') }}" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script type="text/javascript" src="{{ URL::asset('js/html5shiv.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/respond.min.js') }}"></script>
    <![endif]-->

    <!-- SweetAlert -->
    <link href="{{ URL::asset('css/sweetalert.css') }}" rel="stylesheet"/>
    <script type="text/javascript" src="{{ URL::asset('js/sweetalert.min.js') }}"></script>

    @yield('head')
    <link href="{{ URL::asset('css/front/style.css') }}" rel="stylesheet">
    <script type="text/javascript">
        (function (i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function () {
                        (i[r].q = i[r].q || []).push(arguments)
                    }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                    m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

        ga('create', '{!! Setting::get('google-analytics') !!}', 'auto');
        ga('send', 'pageview');
    </script>
</head>
<body>
<!-- Navigation -->
<div class="navbar navbar-default navbar-fixed-top topnav" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="{!! \URL::route('front.home') !!}" class="navbar-brand">
                <span>{!! \Setting::get('brand-name')!!}</span></a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            @include('front._navigation')
        </div>
    </div>
</div> <!-- / navigation -->

@if ($has_header)
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-8 col-sm-7">
                    <h1 id="page_header"
                        data-editable="true">@yield("page-heading")</h1>
                    <p class="lead" id="sub_header"
                       data-editable="true">@yield("page-sub-heading")</p>
                </div>
            </div>
        </div>
    </div>
@endif

@yield('content')

<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-inline">
                    <li class="pull-right"><a href="#top">@lang('contents.btn_back_to_top')</a></li>
                    <li><a href="#">@lang('pages.terms_of_use')</a></li>
                    <li><a href="#">@lang('pages.privacy_policy')</a></li>
                    <li><a href="#">@lang('pages.for_sponsors')</a></li>
                </ul>
                <p>Next Gen &copy; {{ date('Y') }}. Version {{ config('app.version') }}</p>
                <p>Created by <a href="https://www.facebook.com/nestor.nam.jay" rel="nofollow">Nam Le</a>. Contact
                    him
                    at <a href="mailto:me@namle.info">jay@next-gen.vn</a> or visit project's repository at <a
                            href="https://github.com/lntn/esport-website">GitHub</a></p>
                <p>Based on <a href="http://getbootstrap.com" rel="nofollow">Bootstrap</a> and <a href=""
                                                                                                  rel="nofollow">Laravel
                        5</a>. Icons from <a href="http://fortawesome.github.io/Font-Awesome/" rel="nofollow">Font
                        Awesome</a>. Web fonts from <a href="http://www.google.com/webfonts"
                                                       rel="nofollow">Google</a>.
                </p>

            </div>
        </div>
    </div>
</footer>

<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="{{ URL::asset('js/jquery-3.1.0.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/bootstrap-select.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script type="text/javascript" src="{{ URL::asset('js/ie10-viewport-bug-workaround.js') }}"></script>

@yield('foot')
<!-- Language selection -->
<script type="text/javascript">
    $(function () {
        var picker = $('.selectpicker');
        picker.selectpicker({});
        picker.on('change', function () {
            window.location.href = '{{ URL::route('front.lang', ['locale'=>':locale:']) }}'.replace(':locale:', picker.val());
        });

        picker.selectpicker('val', '{{ App::getLocale() }}');
    });
</script>
@if (session('admin_edit_page') === true)
    <script type="text/javascript" src="{!! URL::asset('ckeditor/ckeditor.js') !!}"></script>
    <script type="text/javascript">
        var token = '{!! csrf_token() !!}';
        var postUrl = '{!! route('back.content_block.save', ['view' => $view_name]) !!}';
        $("[data-editable='true']").each(function () {
            $(this).attr('contenteditable', 'true');
        });
        CKEDITOR.dtd.$removeEmpty['span'] = false;
    </script>
    <div class="btnLiveEdit">
        <a href="{!! route('back.content_block.live_edit_end') !!}" type="button"
           class="btn btn-warning">@lang('contents.btn_live_edit_end')</a>
    </div>
@endif
</body>
</html>
