<?php

namespace App\Providers;

use App\Setting;
use Illuminate\Support\ServiceProvider;

class SettingServiceProvider extends ServiceProvider
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
        $this->app->singleton('App\Setting', function () {
            return new Setting();
        });
    }
}
