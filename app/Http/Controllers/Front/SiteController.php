<?php

namespace App\Http\Controllers\Front;

use App;
use App\Http\Controllers\Controller as BaseController;

class SiteController extends BaseController
{
    public function index()
    {
        return view('front.index');
    }

    public function lang($locale)
    {
        App::setLocale($locale);
        $cookie = cookie('locale', $locale, 30 * 24 * 60);

        // set to cookie
        return redirect()
            ->back()
            ->withCookie($cookie);
    }
}
