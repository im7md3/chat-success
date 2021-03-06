<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        
        Inertia::share('locale', function () {
            return app()->getLocale();
        });
        Inertia::share('language', function () {
            return translations(
                resource_path('/lang/' . app()->getLocale() . '.json')
            );
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
