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
Route::prefix('api')->group(['namespace' => 'App\Common\Controllers'], function () {
    Route::post('login', 'AuthController@login')->middleware("auth");
    Route::post('logout', 'AuthController@logout')->middleware("auth");

    Route::post('call-service', 'ServiceController@call')->middleware("verifyReq");
});