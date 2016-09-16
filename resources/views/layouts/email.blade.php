<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd">
<html style="font-size: 100%; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>{{ \Setting::get('title') }}</title>

</head>
<body style="font-family: 'Segoe UI','Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 13px; line-height: 20px; color: #333; background-color: #fff; margin: 0;" bgcolor="#fff">
<style type="text/css">
    a:focus { outline: 5px auto -webkit-focus-ring-color !important; outline-offset: -2px !important; }
    a:hover { outline: 0 !important; }
    a:active { outline: 0 !important; }
    .clearfix:before { display: table !important; content: "" !important; line-height: 0 !important; }
    .clearfix:after { display: table !important; content: "" !important; line-height: 0 !important; }
    .clearfix:after { clear: both !important; }
    a:hover { color: #003e7e !important; text-decoration: underline !important; }
    .row:before { display: table !important; content: "" !important; line-height: 0 !important; }
    .row:after { display: table !important; content: "" !important; line-height: 0 !important; }
    .row:after { clear: both !important; }
    .row-fluid:before { display: table !important; content: "" !important; line-height: 0 !important; }
    .row-fluid:after { display: table !important; content: "" !important; line-height: 0 !important; }
    .row-fluid:after { clear: both !important; }
    .container:before { display: table !important; content: "" !important; line-height: 0 !important; }
    .container:after { display: table !important; content: "" !important; line-height: 0 !important; }
    .container:after { clear: both !important; }
    .container-fluid:before { display: table !important; content: "" !important; line-height: 0 !important; }
    .container-fluid:after { display: table !important; content: "" !important; line-height: 0 !important; }
    .container-fluid:after { clear: both !important; }
    .dl-horizontal:before { display: table !important; content: "" !important; line-height: 0 !important; }
    .dl-horizontal:after { display: table !important; content: "" !important; line-height: 0 !important; }
    .dl-horizontal:after { clear: both !important; }
    blockquote small:before { content: '\2014 \00A0' !important; }
    blockquote.pull-right small:before { content: '' !important; }
    blockquote.pull-right small:after { content: '\00A0 \2014' !important; }
    q:before { content: "" !important; }
    q:after { content: "" !important; }
    blockquote:before { content: "" !important; }
    blockquote:after { content: "" !important; }
    .table-hover tbody tr:hover td { background-color: #f5f5f5 !important; }
    .table-hover tbody tr:hover th { background-color: #f5f5f5 !important; }
    .table-hover tbody tr.success:hover td { background-color: #d0e9c6 !important; }
    .table-hover tbody tr.error:hover td { background-color: #ebcccc !important; }
    .table-hover tbody tr.warning:hover td { background-color: #faf2cc !important; }
    .table-hover tbody tr.info:hover td { background-color: #c4e3f3 !important; }
    .dropdown-menu>li>a:hover>[class^="icon-"] { background-image: url("https://az340737.vo.msecnd.net/resources/glyphicons-halflings-white.png") !important; }
    .dropdown-menu>li>a:hover>[class*=" icon-"] { background-image: url("https://az340737.vo.msecnd.net/resources/glyphicons-halflings-white.png") !important; }
    .btn:hover { color: #333 !important; background-color: #e6e6e6 !important; *background-color: #d9d9d9 !important; }
    .btn:active { color: #333 !important; background-color: #e6e6e6 !important; *background-color: #d9d9d9 !important; }
    .btn:active { background-color: #ccc \9 !important; }
    .btn:hover { color: #333 !important; text-decoration: none !important; background-color: #e6e6e6 !important; *background-color: #d9d9d9 !important; background-position: 0 -15px !important; -webkit-transition: background-position .1s linear !important; -moz-transition: background-position .1s linear !important; -o-transition: background-position .1s linear !important; transition: background-position .1s linear !important; }
    .btn:focus { outline: 5px auto -webkit-focus-ring-color !important; outline-offset: -2px !important; }
    .btn:active { background-color: #d9d9d9 \9 !important; background-image: none !important; outline: 0 !important; -webkit-box-shadow: inset 0 2px 4px rgba(0,0,0,0.15),0 1px 2px rgba(0,0,0,0.05) !important; -moz-box-shadow: inset 0 2px 4px rgba(0,0,0,0.15),0 1px 2px rgba(0,0,0,0.05) !important; box-shadow: inset 0 2px 4px rgba(0,0,0,0.15),0 1px 2px rgba(0,0,0,0.05) !important; }
    .btn-primary:hover { color: #fff !important; background-color: #003e7e !important; *background-color: #003164 !important; }
    .btn-primary:active { color: #fff !important; background-color: #003e7e !important; *background-color: #003164 !important; }
    .btn-primary:active { background-color: #00254a \9 !important; }
    .btn-warning:hover { color: #fff !important; background-color: #f89406 !important; *background-color: #df8505 !important; }
    .btn-warning:active { color: #fff !important; background-color: #f89406 !important; *background-color: #df8505 !important; }
    .btn-warning:active { background-color: #c67605 \9 !important; }
    .btn-danger:hover { color: #fff !important; background-color: #bd362f !important; *background-color: #a9302a !important; }
    .btn-danger:active { color: #fff !important; background-color: #bd362f !important; *background-color: #a9302a !important; }
    .btn-danger:active { background-color: #942a25 \9 !important; }
    .btn-success:hover { color: #fff !important; background-color: #51a351 !important; *background-color: #499249 !important; }
    .btn-success:active { color: #fff !important; background-color: #51a351 !important; *background-color: #499249 !important; }
    .btn-success:active { background-color: #408140 \9 !important; }
    .btn-info:hover { color: #fff !important; background-color: #2f96b4 !important; *background-color: #2a85a0 !important; }
    .btn-info:active { color: #fff !important; background-color: #2f96b4 !important; *background-color: #2a85a0 !important; }
    .btn-info:active { background-color: #24748c \9 !important; }
    .btn-inverse:hover { color: #fff !important; background-color: #222 !important; *background-color: #151515 !important; }
    .btn-inverse:active { color: #fff !important; background-color: #222 !important; *background-color: #151515 !important; }
    .btn-inverse:active { background-color: #080808 \9 !important; }
    .btn-link:active { background-color: transparent !important; background-image: none !important; -webkit-box-shadow: none !important; -moz-box-shadow: none !important; box-shadow: none !important; }
    .btn-link:hover { color: #003e7e !important; text-decoration: underline !important; background-color: transparent !important; }
    .btn-link[disabled]:hover { color: #333 !important; text-decoration: none !important; }
    .btn-group>.btn:hover { z-index: 2 !important; }
    .btn-group>.btn:focus { z-index: 2 !important; }
    .btn-group>.btn:active { z-index: 2 !important; }
    .btn-group .dropdown-toggle:active { outline: 0 !important; }
    .nav>li>a:hover { text-decoration: none !important; background-color: #eee !important; }
    .nav-list>.active>a:hover { color: #fff !important; text-shadow: 0 -1px 0 rgba(0,0,0,0.2) !important; background-color: #0063ca !important; }
    .nav>.disabled>a:hover { text-decoration: none !important; background-color: transparent !important; cursor: default !important; }
    .navbar-inner:before { display: table !important; content: "" !important; line-height: 0 !important; }
    .navbar-inner:after { display: table !important; content: "" !important; line-height: 0 !important; }
    .navbar-inner:after { clear: both !important; }
    .navbar .brand:hover { text-decoration: none !important; }
    .navbar-link:hover { color: #333 !important; }
    .navbar-form:before { display: table !important; content: "" !important; line-height: 0 !important; }
    .navbar-form:after { display: table !important; content: "" !important; line-height: 0 !important; }
    .navbar-form:after { clear: both !important; }
    .navbar .nav>li>a:focus { background-color: transparent !important; color: #333 !important; text-decoration: none !important; }
    .navbar .nav>li>a:hover { background-color: transparent !important; color: #333 !important; text-decoration: none !important; }
    .navbar .nav>.active>a:hover { color: #555 !important; text-decoration: none !important; background-color: #e5e5e5 !important; -webkit-box-shadow: inset 0 3px 8px rgba(0,0,0,0.125) !important; -moz-box-shadow: inset 0 3px 8px rgba(0,0,0,0.125) !important; box-shadow: inset 0 3px 8px rgba(0,0,0,0.125) !important; }
    .navbar .nav>.active>a:focus { color: #555 !important; text-decoration: none !important; background-color: #e5e5e5 !important; -webkit-box-shadow: inset 0 3px 8px rgba(0,0,0,0.125) !important; -moz-box-shadow: inset 0 3px 8px rgba(0,0,0,0.125) !important; box-shadow: inset 0 3px 8px rgba(0,0,0,0.125) !important; }
    .navbar .btn-navbar:hover { color: #fff !important; background-color: #e5e5e5 !important; *background-color: #d9d9d9 !important; }
    .navbar .btn-navbar:active { color: #fff !important; background-color: #e5e5e5 !important; *background-color: #d9d9d9 !important; }
    .navbar .btn-navbar:active { background-color: #ccc \9 !important; }
    .navbar .nav>li>.dropdown-menu:before { content: '' !important; display: inline-block !important; border-left: 7px solid transparent !important; border-right: 7px solid transparent !important; border-bottom: 7px solid #ccc !important; border-bottom-color: rgba(0,0,0,0.2) !important; position: absolute !important; top: -7px !important; left: 9px !important; }
    .navbar .nav>li>.dropdown-menu:after { content: '' !important; display: inline-block !important; border-left: 6px solid transparent !important; border-right: 6px solid transparent !important; border-bottom: 6px solid #fff !important; position: absolute !important; top: -6px !important; left: 10px !important; }
    .navbar-fixed-bottom .nav>li>.dropdown-menu:before { border-top: 7px solid #ccc !important; border-top-color: rgba(0,0,0,0.2) !important; border-bottom: 0 !important; bottom: -7px !important; top: auto !important; }
    .navbar-fixed-bottom .nav>li>.dropdown-menu:after { border-top: 6px solid #fff !important; border-bottom: 0 !important; bottom: -6px !important; top: auto !important; }
    .navbar .pull-right>li>.dropdown-menu:before { left: auto !important; right: 12px !important; }
    .navbar .nav>li>.dropdown-menu.pull-right:before { left: auto !important; right: 12px !important; }
    .navbar .pull-right>li>.dropdown-menu:after { left: auto !important; right: 13px !important; }
    .navbar .nav>li>.dropdown-menu.pull-right:after { left: auto !important; right: 13px !important; }
    .navbar-inverse .brand:hover { color: #fff !important; }
    .navbar-inverse .nav>li>a:hover { color: #fff !important; }
    .navbar-inverse .nav>li>a:focus { background-color: transparent !important; color: #fff !important; }
    .navbar-inverse .nav>li>a:hover { background-color: transparent !important; color: #fff !important; }
    .navbar-inverse .nav .active>a:hover { color: #fff !important; background-color: #003874 !important; }
    .navbar-inverse .nav .active>a:focus { color: #fff !important; background-color: #003874 !important; }
    .navbar-inverse .navbar-link:hover { color: #fff !important; }
    .navbar-inverse .navbar-search .search-query:focus { padding: 5px 15px !important; color: #333 !important; text-shadow: 0 1px 0 #fff !important; background-color: #fff !important; border: 0 !important; -webkit-box-shadow: 0 0 3px rgba(0,0,0,0.15) !important; -moz-box-shadow: 0 0 3px rgba(0,0,0,0.15) !important; box-shadow: 0 0 3px rgba(0,0,0,0.15) !important; outline: 0 !important; }
    .navbar-inverse .btn-navbar:hover { color: #fff !important; background-color: #002c5a !important; *background-color: #001f41 !important; }
    .navbar-inverse .btn-navbar:active { color: #fff !important; background-color: #002c5a !important; *background-color: #001f41 !important; }
    .navbar-inverse .btn-navbar:active { background-color: #001327 \9 !important; }
    .thumbnails:before { display: table !important; content: "" !important; line-height: 0 !important; }
    .thumbnails:after { display: table !important; content: "" !important; line-height: 0 !important; }
    .thumbnails:after { clear: both !important; }
    a.thumbnail:hover { border-color: #0063ca !important; -webkit-box-shadow: 0 1px 4px rgba(0,105,214,0.25) !important; -moz-box-shadow: 0 1px 4px rgba(0,105,214,0.25) !important; box-shadow: 0 1px 4px rgba(0,105,214,0.25) !important; }
    a.label:hover { color: #fff !important; text-decoration: none !important; cursor: pointer !important; }
    a.badge:hover { color: #fff !important; text-decoration: none !important; cursor: pointer !important; }
    ></style>
<table cellspacing="0" cellpadding="0" border="0" width="100%" style="max-width: 100%; background-color: transparent; border-collapse: collapse; border-spacing: 0;" bgcolor="transparent">
    <tr>
        <td align="center" style="overflow: visible; margin-bottom: 20px; color: #fff; *position: relative; *z-index: 2;">

            <table width="650px" cellspacing="0" cellpadding="3" style="width: auto; margin-right: auto; margin-left: auto; *zoom: 1; max-width: 100%; border-collapse: collapse; border-spacing: 0; background-color: transparent;" bgcolor="transparent">
                <tr style="overflow: visible; margin-bottom: 20p; *position: relative; *z-index: 2;">
                    <td colspan="4">@yield('preview')</td>
                    <td><ul style="position: relative; left: 0; display: block; float: right; list-style-type: none; margin: 0; padding: 0;"><li style="line-height: 20px; float: left;"><a href="{!! \Config::get('app.url') !!}" style="color: #fff; text-decoration: none; display: block; float: none; text-shadow: 0 -1px 0 rgba(0,0,0,0.25); padding: 10px 15px;">Visit Us</a></li></ul></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td align="center">
            <img src="{!! \URL::asset('images/logo.png') !!}">
        </td>
    </tr>
    <tr>
        <td bgcolor="#FFFFFF" align="center">
            <table width="650px" cellspacing="0" cellpadding="3" style="width: 940px; margin-right: auto; margin-left: auto; *zoom: 1; max-width: 100%; border-collapse: collapse; border-spacing: 0; background-color: transparent;" bgcolor="transparent">
                <tr>
                    <td><p>@lang('texts.email_greeting')</p>
                        <p>@yield('content')</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        @if ($hasAction)
                            <p></p>
                            <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; box-sizing: border-box;">
                                <tbody>
                                <tr>
                                    <td align="left" style="font-family: sans-serif; font-size: 16px !important; vertical-align: top; padding-bottom: 15px;" valign="top">
                                        <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100% !important;">
                                            <tbody>
                                            <tr>
                                                <td style="font-family: sans-serif; font-size: 16px !important; vertical-align: top; border-radius: 5px; text-align: center; background-color: #3498db;" align="center" bgcolor="#3498db" valign="top"> <a href="http://htmlemail.io" target="_blank" style="color: #ffffff; text-decoration: none; border-radius: 5px; box-sizing: border-box; cursor: pointer; display: inline-block; font-size: 16px !important; font-weight: bold; text-transform: capitalize; width: 100% !important; background-color: #3498db; margin: 0; padding: 12px 25px; border: 1px solid #3498db;">Call To Action</a> </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <p></p>
                            <p style="font-family: sans-serif; font-size: 16px !important; font-weight: normal; margin: 0 0 15px;">@yield('footer')</p>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>@yield('goodbye')</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td bgcolor="#FFFFFF" align="center">
            <table width="650px" cellspacing="0" cellpadding="3" style="width: 940px; margin-right: auto; margin-left: auto; *zoom: 1; max-width: 100%; border-collapse: collapse; border-spacing: 0; background-color: transparent;" bgcolor="transparent">
                <tr>
                    <td>
                        <hr style="border-top-color: #eee; border-top-style: solid; border-bottom-style: solid; border-bottom-color: #fff; margin: 20px 0; border-width: 1px 0;">
                        <p style="margin: 0 0 10px;">{{ \Setting::get('physical-address') }}
                            <br><br> Don't like these emails? <a href="{!! $unsubscribeUrl !!}" style="color: #999999; font-size: 16px !important; text-align: center; text-decoration: underline;">Unsubscribe</a>.</p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
