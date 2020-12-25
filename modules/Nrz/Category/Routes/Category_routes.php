<?php

Route::group(['namespace' => 'Nrz\Category\Http\Controllers', 'middleware' => ['web', 'auth', 'verified']], function ($router) {
    $router->resource('categories', 'CategoryController');
});



