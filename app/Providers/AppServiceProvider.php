<?php

namespace App\Providers;

use App\Services\StatisticsService;
use Illuminate\Support\ServiceProvider;
use App\Services\ParserService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('ParserService', function($app)
        {
            return new ParserService($app['ParseData']);
        });
    }
}
