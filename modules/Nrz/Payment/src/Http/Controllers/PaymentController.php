<?php

namespace Nrz\Payment\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Nrz\Payment\Events\PaymentWasSuccessful;
use Nrz\Payment\Gateways\Gateway;
use Nrz\Payment\Models\Payment;
use Nrz\Payment\Repositories\PaymentRepo;

class PaymentController extends Controller
{

    public function callback(Request $request)
    {

        $gateway = resolve(Gateway::class);
        $paymentRepo = new PaymentRepo();
        $payment = $paymentRepo->findByInvoiceId($gateway->getInvoiceId($request));
        if (is_null($payment)) {
            newFeedback("عملیات ناموفق", "تراکنش مورد نظر یافت نشد !", "error");
            return redirect("/");
        }
        $result = $gateway->verify($payment);


        if (is_array($result)) {
            newFeedback("عملیات ناموفق", $result['message'], "error");
            $paymentRepo->changeStatus($payment, Payment::STATUS_FAIL);
        } else {
            event(new PaymentWasSuccessful($payment));
            newFeedback("عملیات موفق", "پرداخت موفقیت آمیز بود", "success");
            $paymentRepo->changeStatus($payment, Payment::STATUS_SUCCESS);
        }
        return redirect()->to($payment->paymentable->path());
    }

}
