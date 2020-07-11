<?php

namespace App\Providers;

use App\Support\RoutesTools;
use Illuminate\Support\ServiceProvider;

class FacedesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('RoutesTools',function() {
            return new RoutesTools;
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
