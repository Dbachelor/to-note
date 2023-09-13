<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/product', [ProductController::class, 'index']);
    Route::post('/cart', [CartController::class, 'store']);
    Route::post('/order', [OrderController::class, 'checkOutAction']);
    Route::get('/cart1',[CartController::class, 'consume']);
    Route::post('/checkout', [OrderController::class, 'store']);
});



