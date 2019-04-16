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
    Route::get('/', 'ApiController@index')->name('index');
    Route::get('/count', 'ApiController@count')->name('count');
    Route::get('/average', 'ApiController@average')->name('average');
    Route::get('/paginate', 'ApiController@paginate')->name('paginate');

});

Route::prefix('peoplecounter')->middleware('whitelist')->group(function () {
    Route::get('/', 'ApiController@peopleCounterStore')->name('liveImageStore');
});

Route::prefix('tenants')->middleware('whitelist')->group(function () {
    Route::post('/request', 'ApiController@tenantSeatRequest')->name('tenantSeatRequest');
});