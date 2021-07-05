<?php

namespace Nrz\Payment\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PaymentWasSuccessful
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $payment;

    public function __construct($payment)
    {
        $this->payment = $payment;
    }


    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
