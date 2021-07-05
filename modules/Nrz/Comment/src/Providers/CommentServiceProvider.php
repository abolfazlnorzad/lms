<?php

namespace Nrz\Comment\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class CommentServiceProvider extends ServiceProvider
{
    protected $namespace = "Nrz\Comment\Http\Controllers";

    public function register()
    {
        Route::namespace($this->namespace)
            ->middleware(['web','auth'])
            ->group(__DIR__."/../Routes/comment_routes.php");
        $this->loadViewsFrom(__DIR__ . "/../Resource/View", "Comment");
        $this->loadMigrationsFrom(__DIR__."/../database/migrations");

        $this->loadJsonTranslationsFrom(__DIR__ . "/../Resource/Lang");
    }

    public function boot()
    {

    }

}
