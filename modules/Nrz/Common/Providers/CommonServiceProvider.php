<?php


namespace Nrz\Common\Providers;


use Illuminate\Support\ServiceProvider;

class CommonServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadViewsFrom(__DIR__.'/../Resources/views',"Common");
    }


    public function boot()
    {
        require __DIR__ . "/../helpers.php";
    }

}
