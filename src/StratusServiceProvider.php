<?php

namespace Xyrotech\Stratus;

use Illuminate\Support\ServiceProvider;

class StratusServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__. '/routes/web.php');
        $this->loadViewsFrom(__DIR__. '/views', 'stratus');
        $this->loadMigrationsFrom(__DIR__. '/database/migrations');
        $this->mergeConfigFrom(__DIR__.'/config/stratus.php', 'stratus');

        $this->publishes([
            __DIR__ . '/config/stratus.php' => config_path('stratus.php'),
            __DIR__ . '/views' => resource_path('views/vendor/xyrotech'),
            __DIR__ . '/public' => public_path('vendor/xyrotech')
        ]);
    }

    public function register()
    {

    }
}
