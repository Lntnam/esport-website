<?php
Route::get('/back/login', function () {
    return view('auth.login');
})
     ->name('back.login');

/*
 * Backend Group
 * Prefix: /back/
 * Name: back.
 */

Route::group(['middleware' => 'back', 'prefix' => 'back', 'namespace' => 'Back'], function () {
    $module = 'back.';

    Route::get('', 'DashboardController@getDashboard')
         ->name($module . 'dashboard');

    Route::get('profile', function () {
    })
         ->name($module . 'profile');
    Route::get('user_settings', function () {
    })
         ->name($module . 'user_settings');
    Route::get('logout', 'AuthController@getLogout')
         ->name($module . 'logout');

    Route::get('fixture/index', function () {
    })
         ->name($module . 'fixture.index');

    /*
     * Manage fixtures
     */

    Route::group(['prefix' => 'match'], function () {
        $module = 'back.match.';

        Route::get('', 'MatchController@index');
        Route::get('index', 'MatchController@index')
             ->name($module . 'index');
        Route::get('grid_data', "MatchController@data")
             ->name($module . 'gridData');

        Route::get('create', 'MatchController@create')
             ->name($module . 'create');
        Route::post('create', 'MatchController@create');

        Route::get('delete/{id}', 'MatchController@delete')
             ->name($module . 'delete');
        Route::post('delete', 'MatchController@delete')
             ->name($module . 'doDelete');

        Route::get('update/{id}', 'MatchController@update')
             ->name($module . 'update');
        Route::post('update', 'MatchController@update')
             ->name($module . 'doUpdate');
    });

    /*
     * Tournament
     */

    Route::group(['prefix' => 'tournament'], function () {
        $module = 'back.tournament.';

        Route::get('', 'TournamentController@index');
        Route::get('index', 'TournamentController@index')
             ->name($module . 'index');
        Route::get('grid_data', "TournamentController@data")
             ->name($module . 'gridData');

        Route::get('ajaxCreate', 'TournamentController@ajaxCreate')
             ->name($module . 'ajaxCreate');
        Route::post('ajaxCreate', 'TournamentController@ajaxCreate');

        Route::get('delete/{id}', 'TournamentController@delete')
             ->name($module . 'delete');
        Route::post('delete', 'TournamentController@delete')
             ->name($module . 'doDelete');

        Route::get('update/{id}', 'TournamentController@update')
             ->name($module . 'update');
        Route::post('update', 'TournamentController@update')
             ->name($module . 'doUpdate');
    });

    /*
     * Opponent
     */

    Route::group(['prefix' => 'opponent'], function () {
        $module = 'back.opponent.';

        Route::get('', 'OpponentController@index');
        Route::get('index', 'OpponentController@index')
             ->name($module . 'index');
        Route::get('grid_data', "OpponentController@data")
             ->name($module . 'gridData');

        Route::get('ajaxCreate', 'OpponentController@ajaxCreate')
             ->name($module . 'ajaxCreate');
        Route::post('ajaxCreate', 'OpponentController@ajaxCreate');

        Route::get('delete/{id}', 'OpponentController@delete')
             ->name($module . 'delete');
        Route::post('delete', 'OpponentController@delete')
             ->name($module . 'doDelete');

        Route::get('update/{id}', 'OpponentController@update')
             ->name($module . 'update');
        Route::post('update', 'OpponentController@update')
             ->name($module . 'doUpdate');
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
            Route::get('index', 'StaffController@index')
                 ->name($module . 'index');
            Route::get('grid_data', "StaffController@data")
                 ->name($module . 'gridData');

            Route::get('create', 'StaffController@create')
                 ->name($module . 'create');
            Route::post('create', 'StaffController@create');

            Route::get('delete/{id}', 'StaffController@delete')
                 ->name($module . 'delete');
            Route::post('delete', 'StaffController@delete')
                 ->name($module . 'doDelete');
            Route::get('restore/{id}', 'StaffController@restore')
                 ->name($module . 'restore');

            Route::get('update/{id}', 'StaffController@update')
                 ->name($module . 'update');
            Route::post('update', 'StaffController@update')
                 ->name($module . 'doUpdate');
        });

        /*
         * Manage content blocks
         */

        Route::group(['prefix' => 'content_block'], function () {
            $module = 'back.content_block.';

            Route::get('', 'ContentBlockController@index');
            Route::get('index', 'ContentBlockController@index')
                 ->name($module . 'index');
            Route::get('grid_data', "ContentBlockController@data")
                 ->name($module . 'gridData');

            Route::get('create', 'ContentBlockController@create')
                 ->name($module . 'create');
            Route::post('create', 'ContentBlockController@create');

            Route::get('delete/{id}', 'ContentBlockController@delete')
                 ->name($module . 'delete');
            Route::post('delete', 'ContentBlockController@delete')
                 ->name($module . 'doDelete');

            Route::get('update/{id}', 'ContentBlockController@update')
                 ->name($module . 'update');
            Route::post('update', 'ContentBlockController@update')
                 ->name($module . 'doUpdate');
        });

        /*
         * Others
         */

        Route::get('site_settings', 'SettingController@getSiteSettings')
             ->name('back.siteSettings');
        Route::post('site_settings', 'SettingController@postSiteSettings');
    });
});

/*
 * Social login callbacks
 */

$module = 'social.';
Route::get('/social/redirect/{provider}', 'Back\AuthController@getSocialRedirect')
     ->name($module . 'redirect');
Route::get('/social/handle/{provider}', 'Back\AuthController@getSocialHandle')
     ->name($module . 'handle');
