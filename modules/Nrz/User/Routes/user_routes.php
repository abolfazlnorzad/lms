<?php
Route::group(
    ['namespace' => 'Nrz\User\Http\Controllers', 'middleware' => ['web','auth']]
    , function ($router) {
    $router->post('users/{user}/addPermission', 'UserController@addPermission')->name('addPermission');
    $router->delete('users/{user}/{permission}/removePermission', 'UserController@removePermission')->name('removePermission');
    $router->patch('users/{user}/users.manualVerify', 'UserController@usersManualVerify')->name('users.manualVerify');
    $router->post('users/photo', 'UserController@usersPhoto')->name('users.photo');
    $router->get('user/profile', 'UserController@profile')->name('users.profile');
    $router->patch('user/profile', 'UserController@UpdateProfile')->name('users.profile');
    $router->get('tutors/{username}', 'UserController@viewProfile')->name('viewProfile');

    $router->resource('users', 'UserController');

    });

Route::group(
    ['namespace' => 'Nrz\User\Http\Controllers', 'middleware' => 'web']
    , function ($router) {



    Route::post('email/verify', 'Auth\VerificationController@verify')->name('verification.verify');
    Route::post('/email/resend', 'Auth\VerificationController@resend')->name('verification.resend');
    Route::get('/email/verify', 'Auth\VerificationController@show')->name('verification.notice');

    // login
    Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('/login', 'Auth\LoginController@login')->name('login');

    // logout
    Route::any('/logout', 'Auth\LoginController@logout')->name('logout');
    // register
    Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('/register', 'Auth\RegisterController@register')->name('register');

    //reset password
    Route::get('/password/reset', 'Auth\ForgotPasswordController@showVerifyCodeRequestForm')
        ->name('password.request');

    Route::get('/password/reset/send', 'Auth\ForgotPasswordController@sendVerifyCodeEmail')
        ->name('password.sendVerifyCodeEmail');

    Route::post('/password/reset/check-verify-code', 'Auth\ForgotPasswordController@checkVerifyCode')
        ->name('password.checkVerifyCode')
        ->middleware('throttle:5,1');

    Route::get('/password/change', 'Auth\ResetPasswordController@showResetForm')
        ->name('password.showResetForm')->middleware('auth');

    Route::post('/password/change', 'Auth\ResetPasswordController@reset')->name('password.update');

});
