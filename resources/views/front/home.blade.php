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

    <title>{{ Setting::get('title') }}</title>

    <!-- Bootstrap Core CSS -->
    <link href="{!! URL::asset('css/bootstrap.min.css') !!}" rel="stylesheet">
    <link href="{{ URL::asset('css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/flag-icon.min.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{!! URL::asset('css/front/landing-page.css') !!}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{!! URL::asset('css/font-awesome.min.css') !!}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600|Roboto:300,400,500&subset=vietnamese"
          rel="stylesheet" type="text/css">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="{{ URL::asset('css/ie10-viewport-bug-workaround.css') }}" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="{!! URL::asset('js/html5shiv.js') !!}"></script>
    <script src="{!! URL::asset('js/respond.min.js') !!}"></script>
    <![endif]-->

    <link href="{{ URL::asset('css/front/style.css') }}" rel="stylesheet">
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
<nav class="navbar navbar-default navbar-fixed-top topnav" role="navigation">
    <div class="container topnav">
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
            <ul class="nav navbar-nav navbar-left">
                <li><a href="#">
                        <img src="{!! URL::asset('images/nextgen.png') !!}"
                             style="height: 20px; vertical-align: middle"><span> @lang('pages.about_us')</span></a>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="themes">
                        <img src="{!! URL::asset('images/Dota2.png') !!}"
                             style="height: 20px; vertical-align: middle"><span> @lang('pages.dota2')</span>
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu" aria-labelledby="themes">
                        <li>
                            <a href="{!! \URL::route('dota2.fixture.index') !!}">
                                <i class="fa fa-calendar fa-fw" aria-hidden="true"></i> @lang('pages.fixtures')</a>
                        </li>
                        <li>
                            <a href="https://gaming.youtube.com/c/NextGenDOTA2VN" target="_blank">
                                <i class="fa fa-youtube-play fa-fw"
                                   aria-hidden="true"></i> @lang('pages.streaming')</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="themes">
                        <img src="{!! URL::asset('images/league.png') !!}"
                             style="height: 20px; vertical-align: middle"><span> @lang('pages.league_of_legends')</span>
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu" aria-labelledby="themes">
                        <li>
                            <a href="#">
                                <i class="fa fa-ellipsis-h fa-fw" aria-hidden="true"></i> Coming soon</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <select class="selectpicker" data-width="fit">
                        @foreach (config('settings.locales') as $locale=>$details)
                            <option data-content='<span class="flag-icon flag-icon-{{ $details['icon'] }}"></span> {{ $details['title'] }}'
                                    value="{{ $locale }}"></option>
                        @endforeach
                    </select>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>


<!-- Header -->
<a name="about"></a>
<div class="intro-header">
    <div class="container">

        <div class="row">
            <div class="col-lg-12">
                <div class="intro-message">
                    <h1>Next Generation Esports <sup>®</sup></h1>
                    <h3 id="intro_sub_header"
                        data-editable="true">{!! ContentBlock::output($view_name, 'intro_sub_header') !!}</h3>
                    <hr class="intro-divider">
                    <ul class="list-inline intro-social-buttons">
                        <li>
                            <a href="https://www.facebook.com/NextGenDota2/" class="btn btn-default btn-lg"
                               target="_blank"><i
                                        class="fa fa-facebook fa-fw"></i> <span
                                        class="network-name">@lang('pages.dota2_fanpage')</span></a>
                        </li>
                        <li>
                            <a href="https://www.facebook.com/NextGenerationEsports/"
                               class="btn btn-default btn-lg" target="_blank"><i class="fa fa-facebook fa-fw"></i> <span
                                        class="network-name">@lang('pages.league_fanpage')</span></a>
                        </li>
                        <li>
                            <a href="#" class="btn btn-default btn-lg"><i class="fa fa-heart-o fa-fw"></i> <span
                                        class="network-name">@lang('pages.support_us')</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container -->

</div>
<!-- /.intro-header -->

<!-- Page Content -->

<a name="services"></a>
<div class="content-section-a">

    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-sm-6">
                <h2 class="section-heading"
                    id="heading_dota2"
                    data-editable="true">{!! ContentBlock::output($view_name, 'heading_dota2') !!}</h2>
                <p class="lead" id="intro_dota2"
                   data-editable="true">{!! ContentBlock::output($view_name, 'intro_dota2') !!}</p>
                <ul class="list-inline intro-call-to-actions">
                    <li>
                        <a class="btn btn-success btn"
                           href="{!! URL::route('dota2.fixture.index') !!}"><span
                                    class=" network-name"><i class="fa fa-calendar"
                                                             aria-hidden="true"></i> @lang('pages.fixtures')</span></a>
                    </li>
                    <li>
                        <a class="btn btn-info btn"
                           href="https://gaming.youtube.com/c/NextGenDOTA2VN"
                           target="_blank"><span class="network-name"><i class="fa fa-youtube-play fa-fw"
                                                                         aria-hidden="true"></i> @lang('pages.streaming')</span></a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-5 col-lg-offset-2 col-sm-6">
                <img class="img-responsive" src="{!! URL::asset('images/dota2team.jpg') !!}" alt="">
            </div>
        </div>

    </div>
    <!-- /.container -->

</div>
<!-- /.content-section-a -->

<div class="content-section-b">

    <div class="container">

        <div class="row">
            <div class="col-lg-5 col-lg-offset-1 col-sm-push-6  col-sm-6">
                <h2 class="section-heading" id="heading_lol"
                    data-editable="true">{!! ContentBlock::output($view_name, 'heading_lol') !!}</h2>
                <p class="lead" id="intro_lol"
                   data-editable="true">{!! ContentBlock::output($view_name, 'intro_lol') !!}</p>
                <ul class="list-inline intro-call-to-actions">
                    <li>
                        <a class="btn btn-default btn" href="javascript:void(0)"><span
                                    class="network-name">Coming soon.</span></a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-5 col-sm-pull-6  col-sm-6">
                <img class="img-responsive" src="{!! URL::asset('images/lolteam.jpg') !!}" alt="">
            </div>
        </div>

    </div>
    <!-- /.container -->

</div>
<!-- /.content-section-b -->

<div class="content-section-a">

    <div class="container">

        <div class="row">
            <div class="col-lg-5 col-sm-6">
                <hr class="section-heading-spacer">
                <div class="clearfix"></div>
                <h2 class="section-heading"
                    id="heading_nextgen"
                    data-editable="true">{!! ContentBlock::output($view_name, 'heading_nextgen') !!}</h2>
                <p class="lead" id="intro_nextgen"
                   data-editable="true">{!! ContentBlock::output($view_name, 'intro_nextgen') !!}</p>
                <ul class="list-inline intro-call-to-actions">
                    <li>
                        <a class="btn btn-success btn" href="javascript:void(0)"><span
                                    class="network-name"><i class="fa fa-user-secret" aria-hidden="true"></i> @lang('pages.the_management')</span></a>
                    </li>
                    <li>
                        <a class="btn btn-info btn" href="javascript:void(0)"><span
                                    class="network-name"><i class="fa fa-object-ungroup" aria-hidden="true"></i> @lang('pages.our_missions')</span></a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-5 col-lg-offset-2 col-sm-6">
                <img class="img-responsive" src="{!! URL::asset('images/esport-011.jpg') !!}" alt="">
            </div>
        </div>

    </div>
    <!-- /.container -->

</div>
<!-- /.content-section-a -->

<a name="contact"></a>
<div class="banner">

    <div class="container">

        <div class="row">
            <div class="col-lg-6">
                <h2 id="heading_subscription"
                    data-editable="true">{!! ContentBlock::output($view_name, 'heading_subscription') !!}</h2>
            </div>
            <div class="col-lg-6">
                <form role="form" class="form-inline" method="post"
                      action="{!! URL::route('subscription.create') !!}">
                    {{ csrf_field() }}
                    <input type="hidden" name="interests[5d5a7db8ef]" value="1">
                    <input type="hidden" name="interests[d796835b62]" value="1">
                    <div class="form-group col-lg-8">
                        <label class="sr-only" for="email">Your email address</label>
                        <input type="email" value="" name="email" class="form-control input-lg" id="email"
                               placeholder="@lang('contents.your_email')" style="width: 100%">
                    </div>
                    <button type="submit" class="btn btn-success input-lg"><i class="fa fa-envelope-o" aria-hidden="true"></i> @lang('contents.btn_subscribe')</button>
                    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                    <div style="position: absolute; left: -5000px;" aria-hidden="true">
                        <input type="text" name="b_59a9a5aee257480d4f3cbe81e_f848ac684f" tabindex="-1" value="">
                    </div>
                </form>
            </div>

        </div>

    </div>
    <!-- /.container -->

</div>
<!-- /.banner -->

<!-- Footer -->
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
                <p>Created by <a href="https://www.facebook.com/nestor.nam.jay" rel="nofollow">Nam Le</a>. Contact him
                    at <a href="mailto:me@namle.info">jay@next-gen.vn</a> or visit project's repository at <a
                            href="https://github.com/lntn/esport-website">GitHub</a></p>
                <p>Based on <a href="http://getbootstrap.com" rel="nofollow">Bootstrap</a> and <a href=""
                                                                                                  rel="nofollow">Laravel
                        5</a>. Icons from <a href="http://fortawesome.github.io/Font-Awesome/" rel="nofollow">Font
                        Awesome</a>. Web fonts from <a href="http://www.google.com/webfonts" rel="nofollow">Google</a>.
                </p>

            </div>
        </div>
    </div>
</footer>

<!-- Bootstrap core JavaScript -->
<script src="{{ URL::asset('js/jquery-3.1.0.min.js') }}"></script>
<script src="{{ URL::asset('js/bootstrap-select.min.js') }}"></script>
<script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="{{ URL::asset('js/ie10-viewport-bug-workaround.js') }}"></script>
<!-- language selection -->
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
    <script src="{!! URL::asset('ckeditor/ckeditor.js') !!}"></script>
    <script>
        var token = '{!! csrf_token() !!}';
        var postUrl = '{!! route('back.content_block.save', ['view' => $view_name]) !!}';
        $("[data-editable='true']").each(function () {
            $(this).attr('contenteditable', 'true');
        });
    </script>
    <div class="btnLiveEdit">
        <a href="{!! route('back.content_block.live_edit_end') !!}" type="button"
           class="btn btn-warning">@lang('contents.btn_live_edit_end')</a>
    </div>
@endif
</body>
</html>
