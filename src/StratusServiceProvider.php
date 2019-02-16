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
    }

    public function register()
    {

    }
}
