<?php

namespace Nrz\Dashboard\Providers;

use Illuminate\Support\ServiceProvider;

class DashboardServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views', 'Dashboard');
    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../Routes/Dashboard_routes.php');
    }

}
