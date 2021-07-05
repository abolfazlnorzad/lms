<?php

namespace Nrz\Payment\Listeners;

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
