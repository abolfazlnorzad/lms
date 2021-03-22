<?php

namespace Nrz\Payment\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Str;

class AddBalanceToTeacher
{

    public function __construct()
    {
        //
    }


    public function handle($event)
    {
        $event->payment->seller->balance += (int)$event->payment->seller_share;
        $event->payment->seller->save();
    }
}
