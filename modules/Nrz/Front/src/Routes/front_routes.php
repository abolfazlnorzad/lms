<?php
Route::group(['middleware' => ['web'], 'namespace' => 'Nrz\Front\Http\Controllers'],
    function ($router) {
        $router->get('/', 'FrontController@index');
        $router->get('/c-{slug}', 'FrontController@singleCourse')->name('singleCourse');
        $router->get('/tutor/{username}', 'FrontController@singleTutor')->name('singleTutor');
    });
