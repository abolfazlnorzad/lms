<?php

use Illuminate\Support\Facades\Route;

Route::group([], function () {
    Route::get('/media/{media}/download','MediaController@download')->name('media.download');
});
