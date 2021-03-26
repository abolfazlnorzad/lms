<?php

namespace Nrz\Dashboard\Providers;

use Illuminate\Support\ServiceProvider;

class DashboardServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views', 'Dashboard');
        $this->mergeConfigFrom(__DIR__ . '/../Config/Sidebar.php', 'sidebar');
        $this->loadRoutesFrom(__DIR__ . '/../Routes/Dashboard_routes.php');

    }

    public function boot()
    {
        $this->app->booted(function () {
            config()->set('sidebar.items.dashboard',[
                "icon"=>"i-dashboard",
                "title"=>"پیشخوان",
                "url"=>route('home'),
                "permission"=>null
            ]);
        });
    }

}
