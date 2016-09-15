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
     *  Fixtures
     */
    $module = 'front.fixture.';

    Route::get('fixtures', 'FixtureController@index')
         ->name($module . 'index');
    Route::get('fixtures/data/{kind}', 'FixtureController@data')
         ->name($module . 'data');
    Route::get('fixtures/rss/{locale}', 'FixtureController@rss')
         ->name($module . 'rss');
    Route::get('fixtures/results', 'FixtureController@results')
         ->name($module . 'results');

    /**
     *  Subscription
     */
    $module = 'front.subscription.';

    Route::post('subscribe', 'SubscriptionController@create')
         ->name($module . 'create');
    Route::get('subscription/confirmation', function () {
        return view('subscription.confirmation');
    })
         ->name($module . 'confirmation');
    Route::get('unsubscribe/{key}', 'SubscriptionController@unsubscribe')
         ->name($module . 'unsubscribe');
});
