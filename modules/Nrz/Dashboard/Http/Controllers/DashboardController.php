<?php

namespace Nrz\Dashboard\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Nrz\Payment\Repositories\PaymentRepo;

class DashboardController extends Controller
{

    public function home(PaymentRepo $paymentRepo)
    {
        $accountBalance = $paymentRepo->accountBalance(auth()->id());
        $totalCourseSales = $paymentRepo->totalCourseSales(auth()->id());
        $totalSiteWage = $paymentRepo->totalSiteWage(auth()->id());
        $todayBenefit = $paymentRepo->todayBenefit(auth()->id(), now());
        $last30DaysBenefit = $paymentRepo->last30DaysBenefit(auth()->id(), now(), now()->addDays(-30));
        $todaySuccessPaymentsCount = $paymentRepo->todaySuccessPaymentsCount(auth()->id(), now());
        $todaySuccessPaymentsTotal = $paymentRepo->todaySuccessPaymentsTotal(auth()->id(), now());
        $payments = $paymentRepo->paymentBySellerId(auth()->id());

        $totalSellIn30Days = $paymentRepo->totalSellInNDays(-30);
        $totalSellSiteIn30Days = $paymentRepo->totalSellSiteNDays(-30);
        $totalSell = $paymentRepo->totalSellInNDays();
        $totalSiteSell = $paymentRepo->totalSellSiteNDays();
        $past30Days = CarbonPeriod::create(now()->addDays(-30), now());

        return view('Dashboard::index',
            compact('accountBalance', 'totalCourseSales', 'totalSiteWage', 'todayBenefit'
                , 'last30DaysBenefit', 'last30DaysBenefit', 'todaySuccessPaymentsTotal', 'todaySuccessPaymentsCount'
                , 'payments','past30Days','paymentRepo'
            )

        );
    }

}
