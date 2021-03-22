<?php

use Nrz\Payment\Http\Controllers\SettlementController;

Route::group(['middleware' => 'web'], function ($router) {
    $router->get("settlements", [
        "as"=>"settlements.index",
        "uses" => "SettlementController@index"
    ]);
    $router->get("settlements/create", [
        "as"=>"settlements.create",
        "uses" => "SettlementController@create"
    ]);
    Route::get("settlements/{settlement}",[SettlementController::class,'edit'])->name("settlements.edit");
    $router->post("settlements/store", [SettlementController::class, 'store'])->name("settlements.store");
    $router->patch("settlements/{settlement}", [SettlementController::class, 'update'])->name("settlements.update");
});
