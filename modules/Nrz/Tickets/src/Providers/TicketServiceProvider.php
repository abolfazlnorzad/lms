<?php

namespace Nrz\Tickets\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class TicketServiceProvider extends ServiceProvider
{
    public $namespace = "Nrz\Tickets\Http\Controllers";

    public function register()
    {
        $this->loadViewsFrom(__DIR__ . "/../Resources/Views/", "Tickets");
        Route::middleware("web")
            ->namespace($this->namespace)
            ->group(__DIR__ . "/../Routes/ticket_routes.php");
        $this->loadMigrationsFrom(__DIR__ . "/../database/migration");
        $this->loadJsonTranslationsFrom(__DIR__."/../Resources/Lang");



    }

    public function boot()
    {
        config()->set("sidebar.items.tickets",[
            'icon'=>"i-tickets",
            "title"=>"تیکت پشتیبانی",
            "url"=>\route('tickets.index'),
            'permission' => "teach"
        ]);
    }

}
