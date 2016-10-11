<?php
Route::get('/back/login', function () {
    return view('auth.login');
})->name('back.login');

Route::group(['middleware' => 'back', 'prefix' => 'back', 'namespace' => 'Back'], function () {
    $module = 'back.';

    Route::get('', 'DashboardController@index')->name($module . 'dashboard');
    Route::get('logout', 'AuthController@getLogout')->name($module . 'logout');

    Route::group(['prefix' => 'fixtures'], function () {
        $module = 'back.fixtures.';

        Route::get('index/{game}', 'MatchController@index')->name($module . 'index');
        Route::get('grid_data/{game}', "MatchController@data")->name($module . 'gridData');
        Route::get('delete/{id}', 'MatchController@delete')->name($module . 'delete');
        Route::get('update/{id}', 'MatchController@update')->name($module . 'update');

        Route::match(['get', 'post'], 'create/{game}', 'MatchController@create')->name($module . 'create');

        Route::post('delete', 'MatchController@delete')->name($module . 'doDelete');
        Route::post('update', 'MatchController@update')->name($module . 'doUpdate');
    });

    Route::group(['prefix' => 'tournaments'], function () {
        $module = 'back.tournaments.';

        Route::get('index/{game}', 'TournamentController@index')->name($module . 'index');
        Route::get('grid_data/{game}', "TournamentController@data")->name($module . 'gridData');
        Route::get('delete/{id}', 'TournamentController@delete')->name($module . 'delete');
        Route::get('update/{id}', 'TournamentController@update')->name($module . 'update');

        Route::match(['get', 'post'], 'ajaxCreate/{game}', 'TournamentController@ajaxCreate')->name($module . 'ajaxCreate');

        Route::post('delete', 'TournamentController@delete')->name($module . 'doDelete');
        Route::post('update', 'TournamentController@update')->name($module . 'doUpdate');
    });

    Route::group(['prefix' => 'opponents'], function () {
        $module = 'back.opponents.';

        Route::get('index/{game}', 'OpponentController@index')->name($module . 'index');
        Route::get('grid_data/{game}', "OpponentController@data")->name($module . 'gridData');
        Route::get('update/{id}', 'OpponentController@update')->name($module . 'update');
        Route::get('delete/{id}', 'OpponentController@delete')->name($module . 'delete');

        Route::match(['get', 'post'], 'ajaxCreate/{game}', 'OpponentController@ajaxCreate')->name($module . 'ajaxCreate');

        Route::post('delete', 'OpponentController@delete')->name($module . 'doDelete');
        Route::post('update', 'OpponentController@update')->name($module . 'doUpdate');
    });

    Route::group(['prefix' => 'donation'], function () {
        $module = 'back.donation.';

        Route::match(['get', 'post'], 'index', 'DonationController@index')->name($module . 'index');
        Route::post('addTarget', 'DonationController@addTarget')->name($module . 'addTarget');
        Route::post('removeTarget', 'DonationController@removeTarget')->name($module . 'removeTarget');
        Route::post('addSource', 'DonationController@addSource')->name($module . 'addSource');
        Route::post('removeSource', 'DonationController@removeSource')->name($module . 'removeSource');
        Route::post('updateSource', 'DonationController@updateSource')->name($module . 'updateSource');
    });


    /*
     * Restrict Area - Root only
     */

    Route::group(['middleware' => 'root'], function () {
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

        /*
         * Manage content blocks
         */

        Route::group(['prefix' => 'content_block'], function () {
            $module = 'back.content_block.';

            Route::get('', 'ContentBlockController@index');
            Route::get('index', 'ContentBlockController@index')->name($module . 'index');
            Route::get('grid_data', "ContentBlockController@data")->name($module . 'gridData');

            Route::get('create', 'ContentBlockController@create')->name($module . 'create');
            Route::post('create', 'ContentBlockController@create');

            Route::get('delete/{id}', 'ContentBlockController@delete')->name($module . 'delete');
            Route::post('delete', 'ContentBlockController@delete')->name($module . 'doDelete');

            Route::get('update/{id}', 'ContentBlockController@update')->name($module . 'update');
            Route::get('live_edit_start', 'ContentBlockController@startEdit')->name($module . 'live_edit_start');
            Route::get('live_edit_end', 'ContentBlockController@stopEdit')->name($module . 'live_edit_end');
            Route::post('save/{view}', 'ContentBlockController@save')->name($module . 'save');
        });

        /*
         * Others
         */

        Route::get('site_settings', 'SettingController@getSiteSettings')->name('back.siteSettings');
        Route::post('site_settings', 'SettingController@postSiteSettings');
    });
});

/*
 * Social login callbacks
 */

$module = 'social.';
Route::get('/social/redirect/{provider}', 'Back\AuthController@getSocialRedirect')->name($module . 'redirect');
Route::get('/social/handle/{provider}', 'Back\AuthController@getSocialHandle')->name($module . 'handle');
