<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller as BaseController;
use App\Repositories\MatchRepository;
use Illuminate\Http\Request;

class FixtureController extends BaseController
{
    public function index()
    {
        return view('front.fixtures');
    }

    public function data($kind) {
        $matches = [];
        switch ($kind) {
            case 'live':
                $matches = MatchRepository::getLiveMatches();
                break;
            case 'upcoming':
                $matches = MatchRepository::getUpcomingMatches();
                break;
            case 'recent':
                $matches = MatchRepository::getRecentMatches();
                break;
        }

        return view('front/_fixtures')->with('matches', $matches);
    }
}
