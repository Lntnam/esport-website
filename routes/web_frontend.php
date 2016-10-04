<?php
/*
 * Front-end Group
 * Prefix: /
 * Name: front.
 */

Route::group(['middleware' => 'front', 'namespace' => 'Front'], function () {
    $module = 'front.';

    Route::get('', 'SiteController@index')
         ->name($module . 'home');
    Route::get('lang/{locale}', 'SiteController@lang')
         ->name($module . 'lang');
    Route::get('error', function () {
        return view('front.error');
    })
         ->name($module . 'error');

    /**
     *  DOTA 2
     */
    Route::group(['prefix' => 'dota2'], function () {
        /** Fixtures */
        $module = 'dota2.fixture.';
        Route::get('fixtures', 'FixtureController@index')
             ->name($module . 'index');
        Route::get('fixtures/data/{kind}', 'FixtureController@data')
             ->name($module . 'data');
        Route::get('fixtures/rss/{locale}', 'FixtureController@rss')
             ->name($module . 'rss');
        Route::get('fixtures/results', 'FixtureController@results')
             ->name($module . 'results');
        Route::get('fixtures/more_results/{offset}', 'FixtureController@moreResults')
             ->name($module . 'more_results');

        /** others */
        $module = 'dota2.';
        Route::get('donation', 'PageController@donation')
             ->name($module . 'donation');

        Route::any('card_donation', 'CardTransactionController@donateDotA2')
             ->name($module . 'card_donation');
    });

    /** Subscription */
    $module = 'subscription.';

    Route::any('subscribe', 'SubscriptionController@create')
         ->name($module . 'create');
    Route::get('subscription/confirmation', function () {
        return view('subscription.confirmation');
    })
         ->name($module . 'confirmation');

    /** Page management */
    $module = 'pages.';
    Route::get('community_club', 'PageController@communityClub')
         ->name($module . 'community_club');
});
