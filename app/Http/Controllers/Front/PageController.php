<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller as BaseController;
use App\Http\Requests;

class PageController extends BaseController
{
    public function communityClub()
    {
        return view('front.community_club')->with('has_header', false);
    }
}
