<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/back/login', function () {
    return view('auth.login');
})->name('back.login');

/*
 * Backend Group
 * Prefix: /back/
 * Name: back.
 */

Route::group(['middleware' => 'back', 'prefix' => 'back', 'namespace' => 'Back'], function () {
    $module = 'back.';

    Route::get('', 'DashboardController@getDashboard')->name($module . 'home');

    Route::get('profile', function () {
    })->name($module . 'profile');
    Route::get('user_settings', function () {
    })->name($module . 'user_settings');
    Route::get('logout', 'AuthController@getLogout')->name($module . 'logout');

    Route::get('fixture/index', function () {
    })->name($module . 'fixture.index');

    /*
     * Manage fixtures
     */

    Route::group(['prefix' => 'match'], function () {
        $module = 'back.match.';

        Route::get('', 'MatchController@index');
        Route::get('index', 'MatchController@index')->name($module . 'index');
        Route::get('grid_data', "MatchController@data")->name($module . 'gridData');

        Route::get('create', 'MatchController@create')->name($module . 'create');
        Route::post('create', 'MatchController@create');

        Route::get('delete/{id}', 'MatchController@delete')->name($module . 'delete');
        Route::post('delete', 'MatchController@delete')->name($module . 'doDelete');

        Route::get('update/{id}', 'MatchController@update')->name($module . 'update');
        Route::post('update', 'MatchController@update')->name($module . 'doUpdate');
    });

    /*
     * Tournament
     */

    Route::group(['prefix' => 'tournament'], function () {
        $module = 'back.tournament.';

        Route::get('ajaxCreate', 'TournamentController@ajaxCreate')->name($module . 'ajaxCreate');
        Route::post('ajaxCreate', 'TournamentController@ajaxCreate');
    });

    /*
     * Opponent
     */

    Route::group(['prefix' => 'opponent'], function () {
        $module = 'back.opponent.';

        Route::get('ajaxCreate', 'OpponentController@ajaxCreate')->name($module . 'ajaxCreate');
        Route::post('ajaxCreate', 'OpponentController@ajaxCreate');
    });

    /*
     * Restrict Area - Root only
     */

    Route::group(['middleware' => 'root'], function () {

        /*
         * Manage Staffs
         */

        Route::group(['prefix' => 'staff'], function () {
            $module = 'back.staff.';

            Route::get('', 'StaffController@index');
            Route::get('index', 'StaffController@index')->name($module . 'index');
            Route::get('grid_data', "StaffController@data")->name($module . 'gridData');

            Route::get('create', 'StaffController@create')->name($module . 'create');
            Route::post('create', 'StaffController@create');

            Route::get('delete/{id}', 'StaffController@delete')->name($module . 'delete');
            Route::post('delete', 'StaffController@delete')->name($module . 'doDelete');
            Route::get('restore/{id}', 'StaffController@restore')->name($module . 'restore');

            Route::get('update/{id}', 'StaffController@update')->name($module . 'update');
            Route::post('update', 'StaffController@update')->name($module . 'doUpdate');
        });

        Route::get('site_settings', 'SettingController@getSiteSettings')->name('back.siteSettings');
        Route::post('site_settings', 'SettingController@postSiteSettings');
    });
});

/*
 * Front-end Group
 * Prefix: /
 * Name: front.
 */

Route::group(['middleware' => 'front', 'namespace' => 'Front'], function() {
    $module = 'front.';

    Route::get('', 'SiteController@index')->name($module . 'home');
    Route::get('lang/{locale}', 'SiteController@lang')->name($module . 'lang');

    Route::get('fixtures', 'FixtureController@index')->name($module . 'fixture.index');
    Route::get('fixtures/data/{kind}', 'FixtureController@data')->name($module . 'fixture.data');
});

/*
 * Social login callbacks
 */

$module = 'social.';
Route::get('/social/redirect/{provider}', 'Back\AuthController@getSocialRedirect')->name($module . 'redirect');
Route::get('/social/handle/{provider}', 'Back\AuthController@getSocialHandle')->name($module . 'handle');