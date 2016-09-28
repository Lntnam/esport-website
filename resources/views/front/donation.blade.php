@extends('layouts.front')

@section('title', trans('texts.donation_title'))

@section('content')
    <div class="intro-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-intro">
                        <h1>Donate for Next Gen DotA 2</h1>
                        <hr class="intro-divider">
                        <ul class="list-inline intro-social-buttons">
                            <li>
                                <a href="#donation_methods" type="onpage"
                                   class="btn btn-default btn-lg"><i class="fa fa-paypal fa-fw"></i>
                                    PayPal</a>
                            </li>
                            <li>
                                <a href="#donation_methods"
                                   class="btn btn-default btn-lg"><i class="fa fa-university fa-fw"></i> <span
                                            class="network-name">@lang('contents.bank_transfer')</span></a>
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
                        id="heading_team_targets"
                        data-editable="true">{!! ContentBlock::output($view_name, 'heading_team_targets') !!}</h3>
                    <div class="lead" id="team_targets"
                         data-editable="true">{!! ContentBlock::output($view_name, 'team_targets') !!}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="content-section-b">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2" style="text-align: center">
                    <h3 class="section-heading"
                        id="heading_whats_next"
                        data-editable="true">{!! ContentBlock::output($view_name, 'heading_whats_next') !!}</h3>
                    <div class="lead" id="whats_next"
                         data-editable="true">{!! ContentBlock::output($view_name, 'whats_next') !!}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="content-section-a">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-sm-push-5 col-sm-6">
                    <h3 class="section-heading"
                        id="heading_wesg"
                        data-editable="true">{!! ContentBlock::output($view_name, 'heading_wesg') !!}</h3>
                    <div class="lead" id="wesg_details" data-editable="true">
                        {!! ContentBlock::output($view_name, 'wesg_details') !!}</div>
                </div>
                <div class="col-lg-5 col-sm-pull-7 col-sm-6">
                    <img class="img-responsive" src="{!! URL::asset('images/wesg.jpg') !!}" alt="">
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
                        id="heading_rog"
                        data-editable="true">{!! ContentBlock::output($view_name, 'heading_rog') !!}</h3>
                    <div class="lead" id="rog_details"
                         data-editable="true">{!! ContentBlock::output($view_name, 'rog_details') !!}</div>
                </div>
                <div class="col-lg-5 col-lg-offset-1 col-sm-6">
                    <img class="img-responsive" src="{!! URL::asset('images/rog.jpg') !!}" alt="">
                </div>
            </div>
        </div>
    </div>

    <a name="donation_methods"></a>
    <div class="content-section-b">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h3 class="section-heading"
                        id="heading_paypal"
                        data-editable="true">{!! ContentBlock::output($view_name, 'heading_paypal') !!}</h3>
                    <div class="lead" id="paypal_details"
                         data-editable="true">{!! ContentBlock::output($view_name, 'paypal_details') !!}</div>
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
                <div class="col-lg-6">
                    <h3 class="section-heading"
                        id="heading_bank_transfer"
                        data-editable="true">{!! ContentBlock::output($view_name, 'heading_bank_transfer') !!}</h3>
                    <div class="lead" id="bank_transfer_details"
                         data-editable="true">{!! ContentBlock::output($view_name, 'bank_transfer_details') !!}</div>
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