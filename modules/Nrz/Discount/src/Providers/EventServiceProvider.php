<?php


namespace Nrz\Discount\Providers;


use Nrz\Discount\Listeners\UpdateUsedDiscount;
use Nrz\Payment\Events\PaymentWasSuccessful;

class EventServiceProvider extends \Illuminate\Foundation\Support\Providers\EventServiceProvider
{

    protected $listen = [
        PaymentWasSuccessful::class => [
            UpdateUsedDiscount::class
        ]
    ];

}
