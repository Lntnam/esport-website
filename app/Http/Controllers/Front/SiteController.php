<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\Request;

class SiteController extends BaseController
{
    public function index() {
        return view('front.home');
    }

    public function lang($locale) {
        \App::setLocale($locale);
        $cookie = cookie('locale', $locale, 30*24*60);
        // set to cookie
        return redirect()->back()->withCookie($cookie);
    }
}
