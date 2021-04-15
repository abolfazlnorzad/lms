<?php

namespace Nrz\Tickets\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class TicketServiceProvider extends ServiceProvider
{
    public $namespace = "Nrz\Tickets\Http\Controllers";

    public function register()
    {
        Route::middleware("web")
            ->namespace($this->namespace)
            ->group(__DIR__ . "/../Routes/ticket_routes.php");
        $this->loadMigrationsFrom(__DIR__ . "/../database/migration");

    }

    public function boot()
    {

    }

}
