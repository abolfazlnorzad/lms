<?php

namespace Nrz\Payment\Repositories;


use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Nrz\Payment\Models\Payment;
use Nrz\User\Model\User;

class PaymentRepo
{

    public function store($data)
    {
       return Payment::create([
            'buyer_id' => $data['buyer_id'],
            'paymentable_id' => $data['paymentable_id'],
            'paymentable_type' => $data['paymentable_type'],
            'amount' => $data['amount'],
            'invoice_id' =>$data['invoice_id'],
            'gateway' => $data['gateway'],
            'status' =>$data['status'],
            'seller_p' => $data['seller_p'],
            'seller_share' =>$data['seller_share'],
            'site_share' => $data['site_share'],
        ]);

    }

    public function findByInvoiceId($Authority)
    {
        return Payment::where('invoice_id',$Authority)->first();
    }

    public function changeStatus($payment, $status)
    {
        return $payment->update([
            'status'=>$status
        ]);
    }


}
