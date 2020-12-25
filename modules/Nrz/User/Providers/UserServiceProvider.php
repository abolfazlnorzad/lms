<?php


namespace Nrz\User\Providers;


use Illuminate\Support\ServiceProvider;
use Nrz\User\Model\User;

class UserServiceProvider extends ServiceProvider
{

    public function register()
    {
        config()->set('auth.providers.users.model',User::class);
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
        $this->loadFactoriesFrom(__DIR__.'/../Database/factories');
        $this->loadViewsFrom(__DIR__.'/../Resources/Views','User');
    }

    public function boot()
    {

        $this->loadRoutesFrom(__DIR__.'/../Routes/user_routes.php');

    }
}
