<?php

namespace Nrz\Acl\Providers;

use Nrz\Acl\Model\Role;

class AclServiceProvider extends \Illuminate\Support\ServiceProvider
{

    public function register()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadRoutesFrom(__DIR__ . '/../Routes/Acl_Routes.php');
        $this->loadViewsFrom(__DIR__ . '/../Resource/views', 'Acl');

    }


    public function boot()
    {
        config()->set('sidebar.items.permission', [
            'icon' => "i-role-permissions",
            'title' => 'سطوح دسترسی',
            'url' => route('permissions.index'),
//            'role' => Role::query()->where("name", "manage-acl")->first()
        ]);


        config()->set('sidebar.items.role', [
            'icon' => "i-role-permissions",
            'title' => 'نقش های کاربری',
            'url' => route('roles.index')
        ]);
    }

}


