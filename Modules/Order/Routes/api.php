<?php

use Illuminate\Http\Request;
use Modules\Order\Http\Controllers\Api\V1\GoodsController;
use Modules\Order\Http\Controllers\Api\V1\OrderController;


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

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('v1/order/add', [OrderController::class, 'store']);
    Route::post('v1/good/add', [GoodsController::class, 'store']);

    Route::get('v1/order', [GoodsController::class, 'index']);
    Route::get('v1/order/show/{id}', [GoodsController::class, 'show']);
});

