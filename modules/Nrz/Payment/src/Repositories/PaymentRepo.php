<?php

namespace Nrz\Payment\Repositories;


use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Nrz\Payment\Models\Payment;
use Nrz\User\Model\User;

class PaymentRepo
{

    private $query;

    public function __construct()
    {
        $this->query = Payment::query();
    }

    public function searchEmail($email)
    {
        if (!is_null($email)) {
            $this->query->whereHas("buyer", function ($query) use ($email) {
                return $query->where("email", "LIKE", "%" . $email . "%");
            });
        }
        return $this;
    }

    public function searchAmount($amount)
    {
        if (!is_null($amount)) {
            $this->query->where("amount", $amount);
        }
        return $this;
    }

    public function searchInvoiceId($invoiceId)
    {
        if (!is_null($invoiceId)) {
            $this->query->where("invoice_id", "LIKE", "%" . $invoiceId . "%");
        }
        return $this;
    }
    public function searchAfterDate($date)
    {
        if (!is_null($date)) {
           $this->query->whereDate("created_at",">=",$date);
        }
        return $this;
    }

    public function searchBeforeDate($date)
    {
        if (!is_null($date)) {
            $this->query->whereDate("created_at","<=",$date);
        }
        return $this;
    }
    public function paginate()
    {
        return $this->query->paginate();
    }

    public function store($data)
    {

        return Payment::create([
            'buyer_id' => $data['buyer_id'],
            'paymentable_id' => $data['paymentable_id'],
            'paymentable_type' => $data['paymentable_type'],
            'amount' => $data['amount'],
            'invoice_id' => $data['invoice_id'],
            'gateway' => $data['gateway'],
            'status' => $data['status'],
            'seller_p' => $data['seller_p'],
            'seller_share' => $data['seller_share'],
            'site_share' => $data['site_share'],
        ]);

    }

    public function findByInvoiceId($Authority)
    {
        return Payment::where('invoice_id', $Authority)->first();
    }

    public function changeStatus($payment, $status)
    {
        return $payment->update([
            'status' => $status
        ]);
    }

    public function queryForCalcSell(int $days = null)
    {
        $query = Payment::query();

        if (!is_null($days)) {
            $query = $query->where('created_at', ">", now()->addDays($days));
        }
        $query = $query->where('status', Payment::STATUS_SUCCESS);

        return $query;

    }

    public function totalSellInNDays(int $days = null)
    {
        return $this->queryForCalcSell($days)->sum("amount");
    }

    public function totalSellSiteNDays(int $days = null)
    {
        return $this->queryForCalcSell($days)->sum("site_share");
    }

    public function queryForCalcSellDay($day)
    {
        return Payment::query()->whereDate('created_at', $day)
            ->where('status', Payment::STATUS_SUCCESS);
    }

    public function SellSuccessInDay($day)
    {
        return $this->queryForCalcSellDay($day)->sum("amount");
    }

    public function sellerShareInDay($day)
    {
        return $this->queryForCalcSellDay($day)->sum("seller_share");
    }

    public function siteShareInDay($day)
    {
        return $this->queryForCalcSellDay($day)->sum("site_share");
    }




}
