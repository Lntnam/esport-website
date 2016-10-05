<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller as BaseController;
use App\Http\Requests;
use lntn\Epay\EpayClient;

class PageController extends BaseController
{
    public function communityClub()
    {
        return view('front.community_club')->with('has_header', false);
    }

    public function donation()
    {
        $source = 'donate_DotA2';

        return view('front.donation', [
            'source'     => $source,
            'providers'  => EpayClient::getProviders(),
            'has_header' => false,
        ]);
    }
}
