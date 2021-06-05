<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        \App::bind('Illuminate\Routing\ResourceRegistrar', function ()
        {
            return \App::make('app\Providers\ResourceNoPrefixRegistrar');
        });
    }
}
