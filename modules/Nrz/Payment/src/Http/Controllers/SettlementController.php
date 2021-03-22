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

    public function index(SettlementRepo $repo)
    {
        $settlements = $repo->paginate();
        return view("Payment::settlements.index", compact('settlements'));
    }


    public function create()
    {
        return view("Payment::settlements.create");
    }


    public function store(SettlementRequest $request, SettlementRepo $repo)
    {
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

    public function edit(Settlement $settlement)
    {
        return view("Payment::settlements.edit", compact('settlement'));
    }

    public function update(SettlementRequest $request, Settlement $settlement)
    {
        SettlementService::update($settlement,$request->all());
        return redirect(route("settlements.index"));
    }

}
