<?php

use Illuminate\Http\Request;
use Modules\Order\Http\Controllers\ApiGoods\GoodsController;
use Modules\Order\Http\Controllers\ApiOrders\OrderController;

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

});

Route::post('order/add', [OrderController::class, 'store']);

Route::get('order', [GoodsController::class, 'index']);
Route::get('order/show/{id}', [GoodsController::class, 'show']);

//Route::post('good/add', [GoodsController::class, 'store']);
