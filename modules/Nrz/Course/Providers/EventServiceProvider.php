<?php


namespace Nrz\Course\Providers;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Nrz\Course\Listeners\RegisterUserInCourse;
use Nrz\Payment\Events\PaymentWasSuccessful;


class EventServiceProvider extends ServiceProvider
{
    protected $listen = [

        PaymentWasSuccessful::class=>[
            RegisterUserInCourse::class,
        ],
    ];

    public function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
    }
}
