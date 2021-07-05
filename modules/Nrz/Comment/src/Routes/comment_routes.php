<?php

Route::group([],function ($router){
    $router->post('comments',"CommentController@store")->name('comments.store');
});


Route::group([],function ($router){
    $router->get('comments',"CommentController@index")->name('comments.index');
});
