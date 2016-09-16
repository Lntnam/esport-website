<html>
<head>
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>{{ Setting::get('title') }}</title>
    <style media="all" type="text/css">@media all {
            .btn-primary table td:hover {
                background-color: #34495e
            }

            .btn-primary a:hover {
                background-color: #34495e;
                border-color: #34495e
            }
        }

        @media all {
            .btn-secondary a:hover {
                border-color: #34495e;
                color: #34495e
            }
        }

        @media only screen and (max-width: 620px) {
            table[class=body] h1 {
                font-size: 28px;
                margin-bottom: 10px
            }

            table[class=body] h2 {
                font-size: 22px;
                margin-bottom: 10px
            }

            table[class=body] h3 {
                font-size: 16px;
                margin-bottom: 10px
            }

            table[class=body] p, table[class=body] ul, table[class=body] ol, table[class=body] td, table[class=body] span, table[class=body] a {
                font-size: 16px
            }

            table[class=body] .wrapper, table[class=body] .article {
                padding: 10px
            }

            table[class=body] .content {
                padding: 0
            }

            table[class=body] .container {
                padding: 0;
                width: 100%
            }

            table[class=body] .header {
                margin-bottom: 10px
            }

            table[class=body] .main {
                border-left-width: 0;
                border-radius: 0;
                border-right-width: 0
            }

            table[class=body] .btn table {
                width: 100%
            }

            table[class=body] .btn a {
                width: 100%
            }

            table[class=body] .img-responsive {
                height: auto;
                max-width: 100%;
                width: auto
            }

            table[class=body] .alert td {
                border-radius: 0;
                padding: 10px
            }

            table[class=body] .span-2, table[class=body] .span-3 {
                max-width: none;
                width: 100%
            }

            table[class=body] .receipt {
                width: 100%
            }
        }

        @media all {
            .ExternalClass {
                width: 100%
            }

            .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {
                line-height: 100%
            }

            .apple-link a {
                color: inherit;
                font-family: inherit;
                font-size: inherit;
                font-weight: inherit;
                line-height: inherit;
                text-decoration: none
            }
        }</style>
</head>
<body style="font-family: sans-serif; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.4; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; background-color: #f6f6f6; margin: 0; padding: 0;">
<table border="0" cellpadding="0" cellspacing="0"
       style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; background-color: #f6f6f6;"
       width="100%" bgcolor="#f6f6f6">
    <tr>
        <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;" valign="top"></td>
        <td style="font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; Margin: 0 auto; max-width: 580px; padding: 10px; width: 580px;"
            width="580" valign="top">
            <div style="box-sizing: border-box; display: block; Margin: 0 auto; max-width: 580px; padding: 10px;">

                <!-- START HEADER -->
                <div style="clear: both; padding-top: 10px; text-align: center; width: 100%;">
                    <table border="0" cellpadding="0" cellspacing="0"
                           style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;"
                           width="100%">
                        <tr>
                            <td style="font-family: sans-serif; vertical-align: top; padding-top: 10px; padding-bottom: 10px; font-size: 12px; color: #999999; text-align: center;"
                                valign="top" align="center">
                                <a href="{!! Config::get('app.url') !!}"
                                   style="color: #999999; font-size: 12px; text-align: center; text-decoration: none;">
                                    <img style="margin: 0 auto"
                                         src="{{ $message->embed(resource_path('assets/images/logo.png')) }}"></a>.
                            </td>
                        </tr>
                    </table>
                </div>
                <!-- END HEADER -->

                <!-- START CENTERED WHITE CONTAINER -->
                <table style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; background: #fff; border-radius: 3px;"
                       width="100%">

                    <!-- START MAIN CONTENT AREA -->
                    <tr>
                        <td style="font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;"
                            valign="top">
                            <table border="0" cellpadding="0" cellspacing="0"
                                   style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;"
                                   width="100%">
                                <tr>
                                    <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;"
                                        valign="top">
                                        <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">
                                            @lang('texts.email_greeting')</p>
                                        <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">
                                            @yield('content')</p>
                                        @if ($hasAction)
                                            <table border="0" cellpadding="0" cellspacing="0"
                                                   style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; box-sizing: border-box;"
                                                   width="100%">
                                                <tbody>
                                                <tr>
                                                    <td align="left"
                                                        style="font-family: sans-serif; font-size: 14px; vertical-align: top; padding-bottom: 15px;"
                                                        valign="top">
                                                        <table border="0" cellpadding="0" cellspacing="0"
                                                               style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: auto;">
                                                            <tbody>
                                                            <tr>
                                                                <td style="font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #3498db; border-radius: 5px; text-align: center;"
                                                                    valign="top" bgcolor="#3498db" align="center"><a
                                                                            href="{!! $actionUrl !!}" target="_blank"
                                                                            style="display: inline-block; color: #ffffff; background-color: #3498db; border: solid 1px #3498db; border-radius: 5px; box-sizing: border-box; cursor: pointer; text-decoration: none; font-size: 14px; font-weight: bold; margin: 0; padding: 12px 25px; text-transform: capitalize; border-color: #3498db;">
                                                                        {{ $actionText }}</a></td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        @endif
                                        <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">
                                            @yield('footer')</p>
                                        <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">
                                            @yield('goodbye')</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- END MAIN CONTENT AREA -->
                </table>

                <!-- START FOOTER -->
                <div style="clear: both; padding-top: 10px; text-align: center; width: 100%;">
                    <table border="0" cellpadding="0" cellspacing="0"
                           style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;"
                           width="100%">
                        <tr>
                            <td style="font-family: sans-serif; vertical-align: top; padding-top: 10px; padding-bottom: 10px; font-size: 12px; color: #999999; text-align: center;"
                                valign="top" align="center">
                                <span style="color: #999999; font-size: 12px; text-align: center;">
                                    <em>Copyright © {{ \Carbon\Carbon::now(Config::get('app.timezone'))->year }} {{ Setting::get('title') }}
                                        , All rights reserved.</em></span>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-family: sans-serif; vertical-align: top; padding-top: 10px; padding-bottom: 10px; font-size: 12px; color: #999999; text-align: center;"
                                valign="top" align="center">
                                <span style="color: #999999; font-size: 12px; text-align: center;">{{ Setting::get('physical-address') }}</span>
                            </td>
                        </tr>
                    </table>
                </div>
                <!-- END FOOTER -->

                <!-- END CENTERED WHITE CONTAINER -->
            </div>
        </td>
        <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;" valign="top"></td>
    </tr>
</table>
</body>
</html>