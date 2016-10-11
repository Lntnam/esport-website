<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller as BaseController;
use App\Http\Requests;
use lntn\Epay\EpayClient;
use Setting;

class PageController extends BaseController
{
    public function communityClub()
    {
        return view('front.community_club')->with('has_header', false);
    }

    public function donation()
    {
        $source = 'donate_DotA2';

        $target = Setting::getMasterListValue('donation-targets', 'wesg-apac-2016');
        $sources = Setting::getMasterListValue('donation-sources', 'wesg-apac-2016');
        $sum = 0;
        foreach ($sources as $k => $v) {
            $sum += $v;
        }

        return view('front.donation', [
            'source'     => $source,
            'providers'  => EpayClient::getProviders(),
            'has_header' => false,
            'target'     => $target,
            'sum'        => $sum,
        ]);
    }
}
