<?php

namespace App\Providers;

use App\CountryList;
use Illuminate\Support\ServiceProvider;

class CountryListServiceProvider extends ServiceProvider
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
        $this->app->singleton('countrylist', function() {
            return new CountryList();
        });
    }
}
