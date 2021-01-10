<?php
namespace Nrz\Media\Providers;


use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class MediaServiceProvider extends ServiceProvider
{
    protected $namespace = 'Nrz\Media\Http\Controllers';

    public function register()
    {
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
        $this->mergeConfigFrom(__DIR__.'/../Config/mediaFile.php',"mediaFile");

    }

    public function boot()
    {

        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(__DIR__.'/../Routes/media_routes.php');
    }
}
