<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Auth::routes();
Route::group(['prefix' => 'v1', 'namespace' => 'API\V1', 'middleware' => 'checkHeader'], function () {
    Route::group(['middleware' => ['guest:api']], function () {
        Route::post('login', [App\Http\Controllers\API\V1\AuthController::class, 'login']);
        Route::post('signup', [App\Http\Controllers\API\V1\AuthController::class, 'signup']);
    });
});

Route::group(['middleware' => ['checkHeader', 'auth:api']], function () {
    Route::group(['prefix' => 'v1', 'namespace' => 'API\V1'], function () {
        Route::post('logout', [App\Http\Controllers\API\V1\AuthController::class, 'logout']);
        Route::post('get-profile-data', [App\Http\Controllers\API\V1\AuthController::class, 'getProfileData']);
    });
});
