<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::prefix('liveimage')->middleware('whitelist')->group(function () {
    Route::post('/store', 'ApiController@liveImageStore')->name('liveImageStore');
    Route::get('/', 'ApiController@liveImageList')->name('liveImageList');
});

Route::prefix('peoplecounter')->middleware('whitelist')->group(function () {
    Route::get('/', 'ApiController@peopleCounterStore')->name('liveImageStore');
});