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

    Route::get('fixtures', 'FixtureController@index')
         ->name($module . 'fixture.index');
    Route::get('fixtures/data/{kind}', 'FixtureController@data')
         ->name($module . 'fixture.data');
    Route::get('fixtures/rss/{locale}', 'FixtureController@rss')
         ->name($module . 'fixture.rss');
    Route::get('fixtures/results', 'FixtureController@results')
         ->name($module . 'fixture.results');
});
