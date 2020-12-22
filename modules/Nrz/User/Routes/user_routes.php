<?php


Route::group(
    ['namespace' => 'Nrz\User\Http\Controllers','middleware' => 'web']
    ,function ($router){
    Auth::routes(['verify'=>true]);

    Route::post('email/verify','Auth\VerificationController@verify')->name('verification.verify');


});
