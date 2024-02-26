<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::get('me', [AuthController::class, 'me']);
});

Route::group(['middleware' => 'auth'], function ($routes) {
    // customer
    Route::group(['prefix' => 'v1/customers'], function ($routes) {
        Route::get('/list', [CustomerController::class, 'index']);
        Route::post('/', [CustomerController::class, 'store']);
        Route::post('/getList', [CustomerController::class, 'getList']);
        Route::get('/{id}', [CustomerController::class, 'show']);
        Route::put('/{id}', [CustomerController::class, 'update']);
        Route::delete('/{id}', [CustomerController::class, 'destroy']);
        Route::post('/getList', [CustomerController::class, 'getList']);
    });
    // product
    Route::group(['prefix' => 'v1/customers'], function ($routes) {
        Route::get('/list', [ProductController::class, 'index']);
        Route::post('/', [ProductController::class, 'store']);
        Route::post('/initform', [ProductController::class, 'initform']);
        Route::get('/{id}', [ProductController::class, 'show']);
        Route::put('/{id}', [ProductController::class, 'update']);
        Route::delete('/{id}', [ProductController::class, 'destroy']);
        Route::post('/getList', [CustomerController::class, 'getList']);
    });
    // order management
    Route::group(['prefix' => 'v1/orders'], function ($routes) {
        Route::get('/list', [OrderController::class, 'index']);
        Route::post('/', [OrderController::class, 'store']);
        Route::get('/{id}', [OrderController::class, 'show']);
    });
});
