<?php

namespace Nrz\Payment\Http\Controllers;

use App\Http\Controllers\Controller;
use Hamcrest\Core\Set;
use Illuminate\Http\Request;
use Nrz\Payment\Http\Requests\SettlementRequest;
use Nrz\Payment\Models\Settlement;
use Nrz\Payment\Repositories\SettlementRepo;
use Nrz\Payment\Services\SettlementService;

class SettlementController extends Controller
{

    public function __construct()
    {
        $this->middleware("can:teach")->only(["index","create","store"]);
    }

    public function index(SettlementRepo $repo)
    {
        $settlements = $repo->paginate();
        return view("Payment::settlements.index", compact('settlements'));
    }

    public function create(SettlementRepo $repo)
    {
        if ($repo->checkTeacherHasPendingSettlement(auth()->id())) {
            newFeedback("ناموفق", "شما یک درخواست در حال انتظار دارید", "error");
            return redirect(route("settlements.index"));
        }
        return view("Payment::settlements.create");
    }

    public function store(SettlementRequest $request, SettlementRepo $repo)
    {
        if ($repo->checkTeacherHasPendingSettlement(auth()->id())) {
            newFeedback("ناموفق", "شما یک درخواست در حال انتظار دارید", "error");
            return redirect(route("settlements.index"));
        }
        $repo->store([
            "cart" => $request->cart,
            "name" => $request->name,
            "amount" => $request->amount,
        ]);
        auth()->user()->balance -= $request->amount;
        auth()->user()->save();
        newFeedback("موفقیت آمیز", "عملیات با موفقیت انجام شد", "success");
        return redirect(route("settlements.index"));
    }

    public function edit(Settlement $settlement, SettlementRepo $repo)
    {
         $this->authorize(auth()->user()->isAdmin());
        $lastSattlement = $repo->lastSattlement($settlement->user_id);
        if ($settlement->id != $lastSattlement->id) {
            newFeedback("ناموفق", "فقط آخرین درخواست تسویه حساب هر مدرس قابل ویرایش است", "error");
            return redirect(route("settlements.index"));
        }
        return view("Payment::settlements.edit", compact('settlement'));
    }

    public function update(SettlementRequest $request, Settlement $settlement)
    {
        $this->authorize(auth()->user()->isAdmin());
        SettlementService::update($settlement, $request->all());
        return redirect(route("settlements.index"));
    }

}
