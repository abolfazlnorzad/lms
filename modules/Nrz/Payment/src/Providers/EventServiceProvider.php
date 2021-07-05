<?php


namespace Nrz\Payment\Providers;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Nrz\Payment\Events\PaymentWasSuccessful;
use Nrz\Payment\Listeners\AddBalanceToTeacher;


class EventServiceProvider extends ServiceProvider
{
    protected $listen = [

        PaymentWasSuccessful::class=>[
            AddBalanceToTeacher::class
        ],
    ];

    public function boot()
    {
        parent::boot();
    }
}
