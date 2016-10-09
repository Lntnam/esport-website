<?php


namespace App\Traits;

use Setting;

trait GameController
{
    public function validateGame($game)
    {
        $games = Setting::getMasterList('back_games');
        if (!property_exists($games, $game)) {
            abort(404);
        }
    }
}