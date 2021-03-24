<?php


namespace Nrz\Payment\Services;


use Nrz\Payment\Models\Settlement;
use Nrz\Payment\Repositories\SettlementRepo;

class SettlementService
{

    public static function update($settlement, $data)
    {
        $repo = new SettlementRepo();
        if (!in_array($settlement->status, [Settlement::STATUS_REJECTED, Settlement::STATUS_CANCELED]
            ) && in_array($data['status'], [Settlement::STATUS_REJECTED, Settlement::STATUS_CANCELED])) {
            $settlement->user->balance += $data['amount'];
            $settlement->user->save();
        }
        if ($settlement->user->balance < $data['amount']) {
            newFeedback("ناموفق", "عملیات ناموفق بود", "error");
            return;
        }
        if (in_array($settlement->status, [Settlement::STATUS_REJECTED, Settlement::STATUS_CANCELED]
            ) && in_array($data['status'], [Settlement::STATUS_SETTLED, Settlement::STATUS_PENDING])) {
            $settlement->user->balance -= $data['amount'];
            $settlement->user->save();
        }

        newFeedback("موفقیت آمیز", "با موفقیت ویرایش گردید", "success");
        return $repo->update($settlement, $data);
    }

}
