<?php

namespace Nrz\Discount\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class DiscountServiceProvider extends ServiceProvider
{
    public $namespace = "Nrz\Discount\Http\Controllers";

    public function register()
    {
        $this->app->register(EventServiceProvider::class);
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(__DIR__ . "/../Routes/discount_routes.php");
        $this->loadViewsFrom(__DIR__ . "/../Resources/Views/", "Discount");
        $this->loadMigrationsFrom(__DIR__ . "/../Database/Migrations");
        $this->loadJsonTranslationsFrom(__DIR__ . "/../Resources/Lang/");
    }

    public function boot()
    {
        config()->set("sidebar.items.discount", [
            'icon' => 'i-discounts',
            "title" => "تخفیف ها",
            "url" => route("discounts.index"),
            'permission' => 'isAdmin'
        ]);
    }

}
