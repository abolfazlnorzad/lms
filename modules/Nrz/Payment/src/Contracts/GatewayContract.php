<?php

namespace Nrz\Payment\Contracts;

use Nrz\Payment\Models\Payment;

interface GatewayContract
{

    public function request($amount,$title);

    public function verify(Payment $payment);

    public function redirect();

    public function getName();

}
