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

/**
 * Webhooks
 */
Route::post('hook/mailchimp', function() {
    return App\WebHook::receiveMailChimp();
});

/*
 * Backend Group
 * Prefix: /back/
 * Name: back.
 */
require(base_path() . '/routes/web_frontend.php');

/*
 * Front-end Group
 * Prefix: /
 * Name: front.
 */
require(base_path() . '/routes/web_backend.php');

/*
 * Redirecting old URL
 */
Route::get('fixtures', function() {
    return redirect()->route('dota2.fixture.index');
});
