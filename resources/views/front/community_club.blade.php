@extends('layouts.front')

@section('title', trans('texts.community_club_title'))

@section('content')
    <div class="intro-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-intro">
                        <h1>Next Gen <sup>®</sup> DotA 2 Community Club</h1>
                        <hr class="intro-divider">
                        <ul class="list-inline intro-social-buttons">
                            <li>
                                <a href="#bank_transfer" type="onpage"
                                   class="btn btn-default btn-lg"><i class="fa fa-user-plus fa-fw"></i>
                                    <span
                                            class="network-name">@lang('contents.btn_register')</span></a>
                            </li>
                            <li>
                                <a href="javascript:void(0)"
                                   class="btn btn-default btn-lg"><i class="fa fa-sign-in fa-fw"></i> <span
                                            class="network-name">@lang('contents.btn_sign_in')</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="content-section-a">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h3 class="section-heading"
                        id="heading_cost_details"
                        data-editable="true">{!! ContentBlock::output($view_name, 'heading_cost_details') !!}</h3>
                    <div class="lead" id="cost_details"
                         data-editable="true">{!! ContentBlock::output($view_name, 'cost_details') !!}</div>
                </div>
                <div class="col-lg-6">
                    <h3 class="section-heading"
                        id="heading_why_private"
                        data-editable="true">{!! ContentBlock::output($view_name, 'heading_why_private') !!}</h3>
                    <div class="lead" id="why_private"
                         data-editable="true">{!! ContentBlock::output($view_name, 'why_private') !!}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="content-section-b">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2" style="text-align: center">
                    <h3 class="section-heading"
                        id="heading_fee"
                        data-editable="true">{!! ContentBlock::output($view_name, 'heading_fee') !!}</h3>
                    <div class="lead" id="fee_details"
                         data-editable="true">{!! ContentBlock::output($view_name, 'fee_details') !!}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="content-section-a">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-sm-push-5 col-sm-6">
                    <h3 class="section-heading"
                        id="heading_rewards"
                        data-editable="true">{!! ContentBlock::output($view_name, 'heading_rewards') !!}</h3>
                    <div class="lead" id="reward_details" data-editable="true">
                        {!! ContentBlock::output($view_name, 'reward_details') !!}</div>
                </div>
                <div class="col-lg-5 col-sm-pull-7 col-sm-6">
                    <img class="img-responsive" src="{!! URL::asset('images/maximus8ranger.png') !!}" alt="">
                </div>
            </div>
        </div>
    </div>

    <a name="club_info"></a>
    <div class="content-section-b">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-sm-6">
                    <h3 class="section-heading"
                        id="heading_club_info"
                        data-editable="true">{!! ContentBlock::output($view_name, 'heading_club_info') !!}</h3>
                    <div class="lead" id="club_info"
                         data-editable="true">{!! ContentBlock::output($view_name, 'club_info') !!}</div>
                </div>
                <div class="col-lg-5 col-lg-offset-1 col-sm-6">
                    <img class="img-responsive" src="{!! URL::asset('images/community_club_logo.png') !!}" alt="">
                </div>
            </div>
        </div>
    </div>

    <div class="content-section-a">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1" style="text-align: center">
                    <h3 class="section-heading"
                        id="heading_non_monetary"
                        data-editable="true">{!! ContentBlock::output($view_name, 'heading_non_monetary') !!}</h3>
                    <div class="lead" id="non_monetary"
                         data-editable="true">{!! ContentBlock::output($view_name, 'non_monetary') !!}</div>
                    <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                        <input type="hidden" name="cmd" value="_s-xclick">
                        <input type="hidden" name="hosted_button_id" value="NMBV5T8JJ4VD6">
                        <input type="image"
                               src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif"
                               border="0"
                               name="submit"
                               alt="PayPal - The safer, easier way to pay online!">
                        <img alt=""
                             border="0"
                             src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif"
                             width="1"
                             height="1">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <a name="bank_transfer"></a>
    <div class="content-section-b">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h3 class="section-heading"
                        id="heading_steps_to_register"
                        data-editable="true">{!! ContentBlock::output($view_name, 'heading_steps_to_register') !!}</h3>
                    <div class="lead" id="steps_to_register"
                         data-editable="true">{!! ContentBlock::output($view_name, 'steps_to_register') !!}</div>
                </div>
                <div class="col-lg-6">
                    <h3 class="section-heading"
                        id="heading_payment"
                        data-editable="true">{!! ContentBlock::output($view_name, 'heading_payment') !!}</h3>
                    <div class="lead" id="payment_details"
                         data-editable="true">{!! ContentBlock::output($view_name, 'payment_details') !!}</div>
                    {{--<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">--}}
                        {{--<input type="hidden" name="cmd" value="_s-xclick">--}}
                        {{--<input type="hidden" name="hosted_button_id" value="CTYJ7QU7VLWHU">--}}
                        {{--<table>--}}
                            {{--<tr>--}}
                                {{--<td><input type="hidden" name="on0" value="Phone number">Phone number</td>--}}
                            {{--</tr>--}}
                            {{--<tr>--}}
                                {{--<td><input type="text" name="os0" maxlength="200"></td>--}}
                            {{--</tr>--}}
                        {{--</table>--}}
                        {{--<input type="image"--}}
                               {{--src="https://www.paypalobjects.com/en_US/i/btn/btn_subscribeCC_LG.gif"--}}
                               {{--border="0"--}}
                               {{--name="submit"--}}
                               {{--alt="PayPal - The safer, easier way to pay online!">--}}
                        {{--<img alt=""--}}
                             {{--border="0"--}}
                             {{--src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif"--}}
                             {{--width="1"--}}
                             {{--height="1">--}}
                    {{--</form>--}}

                </div>
                <div class="col-lg-10 col-lg-offset-1" style="text-align: center">

                </div>
            </div>
        </div>
    </div>
@stop

@section('foot')
    <script type="text/javascript">
        $('a[type="onpage"]').click(function(){
            $('html, body').animate({
                scrollTop: $('[name="' + $.attr(this, 'href').substr(1) + '"]').offset().top
            }, 500);
            return false;
        });
    </script>
@stop