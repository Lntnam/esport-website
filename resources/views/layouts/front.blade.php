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
    <link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/flatly/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.2/css/bootstrap-select.min.css"
          rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/0.8.2/css/flag-icon.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="{{ URL::asset('css/ie10-viewport-bug-workaround.css') }}" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- SweetAlert -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

    @yield('head')
    <link href="{{ URL::asset('css/front/custom.css') }}" rel="stylesheet">
    <script>
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
<div class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a href="{!! \URL::route('front.home') !!}" class="navbar-brand">
                <img src="{!! URL::asset('images/logo-small.png') !!}" alt="" class="logo-small">
                <span>{{ \Setting::get('brand-name') }}</span></a>
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="navbar-collapse collapse" id="navbar-main">
            {{--<ul class="nav navbar-nav navbar-left">--}}
            {{--<li class="dropdown">--}}
            {{--<a class="dropdown-toggle" data-toggle="dropdown" href="#" id="themes">--}}
            {{--<i class="fa fa-heart fa-fw" aria-hidden="true"></i> @lang('pages.we-need-support')--}}
            {{--<span class="caret"></span></a>--}}
            {{--<ul class="dropdown-menu" aria-labelledby="themes">--}}
            {{--<li><a href="#">@lang('pages.join-supporter-club')</a></li>--}}
            {{--<li><a href="#">@lang('pages.sponsor')</a></li>--}}
            {{--<li class="divider"></li>--}}
            {{--<li><a href="#">@lang('pages.buy-badge')</a></li>--}}
            {{--<li><a href="#">@lang('pages.follow-us')</a></li>--}}
            {{--<li><a href="#">@lang('pages.spread-the-words')</a></li>--}}
            {{--</ul>--}}
            {{--</li>--}}
            {{--</ul>--}}
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="{!! \URL::route('front.fixture.index') !!}">
                        <i class="fa fa-calendar fa-fw" aria-hidden="true"></i> @lang('pages.fixtures')</a>
                </li>
                {{--<li>--}}
                {{--<a href="#">--}}
                {{--<i class="fa fa-users fa-fw" aria-hidden="true"></i> @lang('pages.team-roster')</a>--}}
                {{--</li>--}}
                {{--<li><a href="#" target="_blank">--}}
                {{--<i class="fa fa-envelope-o fa-fw" aria-hidden="true"></i> @lang('pages.get-in-touch')</a></li>--}}
                <li>
                    <a href="https://gaming.youtube.com/c/NextGenDOTA2VN" target="_blank">
                        <i class="fa fa-youtube-play fa-fw" aria-hidden="true"></i> @lang('pages.youtube-channel')</a>
                </li>
                {{--<li><a href="https://gaming.youtube.com/c/NextGenDOTA2VN/" target="_blank">--}}
                {{--<i class="fa fa-youtube fa-lg" aria-hidden="true"></i> @lang('pages.youtube-channel')</a></li>--}}
                <li><a href="https://www.facebook.com/NextGenDota2/" target="_blank">
                        <i class="fa fa-facebook-official fa-lg" aria-hidden="true"></i></a></li>
                <li>
                    <select class="selectpicker" data-width="fit">
                        @foreach (\Config::get('settings.locales') as $locale=>$details)
                            <option data-content='<span class="flag-icon flag-icon-{{ $details['icon'] }}"></span> {{ $details['title'] }}'
                                    value="{{ $locale }}"></option>
                        @endforeach
                    </select>
                </li>
            </ul>

        </div>
    </div>
</div> <!-- / navigation -->

<div class="navbar bannerbar">
    <div class="container">
        <div class="row banner">
            <img src="{!! URL::asset('images/banner.png') !!}">
        </div>
    </div>
</div>

<!-- container -->
<div class="container">
    <div class="page-header" id="banner">
        <div class="row">
            <div class="col-lg-9 col-md-8 col-sm-7">
                <h1>@yield("page-heading")</h1>
                <p class="lead">@yield("page-sub-heading")</p>
            </div>
        </div>
    </div>

    @yield('content')

    <footer>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">
                    <li class="pull-right"><a href="#top">@lang('contents.btn-back-to-top')</a></li>
                    <li><a href="#">Terms of use</a></li>
                    <li><a href="#">Privacy</a></li>
                    <li><a href="#">Contact</a></li>
                    <li><a href="#">Road map</a></li>
                    <li><a href="https://www.facebook.com/NextGenDota2/" target="_blank">Facebook</a></li>
                </ul>
                <p>Next Gen &copy; {{ date('Y') }}.</p>
                <p>Created by <a href="https://www.facebook.com/nestor.nam.jay" rel="nofollow">Nam Le</a>. Contact him
                    at <a href="mailto:me@namle.info">jay@next-gen.vn</a> or visit project's repository at <a
                            href="https://github.com/lntn/next-gen">GitHub</a></p>
                <p>Based on <a href="http://getbootstrap.com" rel="nofollow">Bootstrap</a> and <a href=""
                                                                                                  rel="nofollow">Laravel
                        5</a>. Icons from <a href="http://fortawesome.github.io/Font-Awesome/" rel="nofollow">Font
                        Awesome</a>. Web fonts from <a href="http://www.google.com/webfonts" rel="nofollow">Google</a>.
                </p>

            </div>
        </div>

    </footer>
</div> <!-- / container -->

<!-- Bootstrap core JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.2/js/bootstrap-select.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="https://maxcdn.bootstrapcdn.com/js/ie10-viewport-bug-workaround.js"></script>

@yield('foot')
<script type="text/javascript">
    $(function () {
        $('.selectpicker').selectpicker({});
        $('.selectpicker').on('change', function () {
            window.location.href = '{{ URL::route('front.lang', ['locale'=>':locale:']) }}'.replace(':locale:', $('.selectpicker').val());
        });

        $('.selectpicker').selectpicker('val', '{{ App()->getLocale() }}');
    });
</script>
</body>
</html>