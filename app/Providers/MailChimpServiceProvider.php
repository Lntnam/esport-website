<?php
/**
 * Created by PhpStorm.
 * User: Nam
 * Date: 08/09/2016
 * Time: 23:24
 */
namespace App\Providers;

use DrewM\MailChimp\MailChimp;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class MailChimpServiceProvider extends ServiceProvider
{
    protected $defer = false;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('DrewM\MailChimp\MailChimp', function() {
            return new MailChimp(Config::get('settings.mailchimp')['api_key']);
        });
    }
}
