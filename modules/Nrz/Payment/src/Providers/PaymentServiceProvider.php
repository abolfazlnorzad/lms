<?php

namespace Nrz\Payment\Providers;


use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Nrz\Payment\Gateways\Gateway;
use Nrz\Payment\Gateways\Zarinpal\ZarinpalAdaptor;

class PaymentServiceProvider extends ServiceProvider
{
    public $namespace = "Nrz\Payment\Http\Controllers";

    public function register()
    {
        $this->app->register(EventServiceProvider::class);
        $this->loadMigrationsFrom(__DIR__ . " /../Database/Migrations");
        Route::middleware("web")->namespace($this->namespace)->group(__DIR__ . "/../Routes/payment_routes.php");
        Route::middleware("web")->namespace($this->namespace)->group(__DIR__ . "/../Routes/settlement_routes.php");
        $this->loadViewsFrom(__DIR__ . "/../Resources/Views", "Payment");
        $this->loadJsonTranslationsFrom(__DIR__ . "/../Resources/Lang");

    }

    public function boot()
    {

        $this->app->singleton(Gateway::class, function ($app) {
            return new ZarinpalAdaptor();
        });

        config()->set('sidebar.items.payments', [
            "icon" => "i-transactions",
            "title" => "تراکنش ها",
            "url" => route('payments.index'),
        ]);

        config()->set('sidebar.items.my-purchases', [
            "icon" => "i-my__purchases",
            "title" => "خریدهای من",
            "url" => route('purchases.index'),
        ]);

        $this->app->booted(function (){
            config()->set('sidebar.items.settlements', [
                "icon" => "i-checkouts",
                "title" => " تسویه حساب ها",
                "url" => route('settlements.index'),
            ]);
            config()->set('sidebar.items.settlementsRequest', [
                "icon" => "i-checkout__request",
                "title" => "درخواست تسویه",
                "url" => route('settlements.create'),
            ]);

        });
    }
}
