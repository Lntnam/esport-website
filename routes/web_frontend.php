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
