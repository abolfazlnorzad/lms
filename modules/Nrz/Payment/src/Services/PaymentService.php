<?php

namespace Nrz\Payment\Services;

use Nrz\Payment\Models\Payment;
use Nrz\Payment\Repositories\PaymentRepo;
use Nrz\User\Model\User;

class PaymentService
{
    public static function generate($amount, $paymntable, User $user)
    {
        if ($amount <= 0 || is_null($user->id) || is_null($paymntable->id)) return false;
        $gateway = resolve(\Nrz\Payment\Gateways\Gateway::class);
        $invoiceId = $gateway->request($amount,$paymntable->title);
        if (is_null($paymntable->percent)) {
            $seller_p = 0;
            $seller_share = 0;
            $site_share = $amount;
        } else {
            $seller_p = $paymntable->percent;
            $seller_share = ($amount / 100) * $seller_p;
            $site_share = $amount - $seller_share;
        }

        return resolve(PaymentRepo::class)->store([
            'buyer_id' => $user->id,
            'paymentable_id' => $paymntable->id,
            'paymentable_type' => get_class($paymntable),
            'amount' => $amount,
            'invoice_id' => $invoiceId,
            'gateway' => $gateway->getName(),
            'status' => Payment::STATUS_PENDING,
            'seller_p' => $seller_p,
            'seller_share' => $seller_share,
            'site_share' => $site_share,
        ]);

    }
}
