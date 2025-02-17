<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        config(["app.locale" => "id"]);
        Carbon::setLocale("id");
        Paginator::useBootstrap();
        if (env("APP_ENV") == "production") {
            \URL::forceScheme("https");
        }
    }
}
