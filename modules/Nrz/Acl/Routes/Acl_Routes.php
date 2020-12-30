<?php
Route::group(['namespace' => 'Nrz\Acl\Http\Controllers', 'middleware' => ['web', 'auth', 'verified']], function ($router) {
    $router->resource('permissions', 'PermissionController');
    $router->resource('roles', 'RoleController');

});



