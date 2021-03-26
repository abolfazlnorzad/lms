<?php

namespace Nrz\Payment\Http\Controllers;

use App\Http\Controllers\Controller;

use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;
use Nrz\Payment\Events\PaymentWasSuccessful;
use Nrz\Payment\Gateways\Gateway;
use Nrz\Payment\Models\Payment;
use Nrz\Payment\Repositories\PaymentRepo;

class PaymentController extends Controller
{

    public function index(PaymentRepo $paymentRepo, Request $request)
    {
        $this->authorize(auth()->user()->isAdmin());
        $payments = $paymentRepo
            ->searchEmail($request->email)
            ->searchAmount($request->amount)
            ->searchInvoiceId($request->invoice_id)
            ->searchAfterDate(createDateFromJalali($request->start_date))
            ->searchBeforeDate(createDateFromJalali($request->end_date))
            ->paginate();
        $totalSellIn30Days = $paymentRepo->totalSellInNDays(-30);
        $totalSellSiteIn30Days = $paymentRepo->totalSellSiteNDays(-30);
        $totalSell = $paymentRepo->totalSellInNDays();
        $totalSiteSell = $paymentRepo->totalSellSiteNDays();
        $past30Days = CarbonPeriod::create(now()->addDays(-30), now());
        return view('Payment::index', compact('payments',
            'totalSellIn30Days',
            'totalSellSiteIn30Days',
            'totalSell',
            'totalSiteSell',
            "past30Days",
            "paymentRepo",

        ));
    }

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

    public function purchases()
    {
        $payments = auth()->user()->payments()->with("paymentable")->paginate();
        return view("Payment::purchases", compact("payments"));

    }

}
