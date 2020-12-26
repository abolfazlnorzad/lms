<?php

namespace Nrz\RolePermissions\Providers;


use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class RolePermissionsServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
        $this->loadRoutesFrom(__DIR__.'/../Routes/role_permissions_routes.php');
        $this->loadViewsFrom(__DIR__.'/../Resources/Views',"RolePermissions");
        $this->loadJsonTranslationsFrom(__DIR__.'/../Resources/Lang');
    }

    public function boot()
    {

        config()->set('sidebar.items.role-permissions',[
            "icon"=>"i-role-permissions",
            "title"=>"نقش های کاربری",
            "url"=>route('role-permissions.index'),
        ]);

    }
}
