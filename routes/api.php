<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\User\HomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;

Route::middleware(['auth:api'])->group(function () {
    Route::get('user', [AuthController::class, 'getUser']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('category/get', [App\Http\Controllers\Admin\CategoryController::class, 'getCategory']);
    Route::get('tag/get', [App\Http\Controllers\Admin\TagController::class, 'getTag']);
    Route::apiResource('category', Admin\CategoryController::class);
    Route::apiResource('tag', Admin\TagController::class);
    Route::apiResource('product', Admin\ProductController::class);
    Route::get('order', [CartController::class, 'getOrder']);
    Route::get('order/{order}', [CartController::class, 'getOrderDetails']);
});


Route::get('/user/product/get', [App\Http\Controllers\Admin\ProductController::class, 'getProduct']);
Route::get('/{slug}/product/get', [App\Http\Controllers\Admin\ProductController::class, 'getProductBySlug']);
Route::post('/checkout', [CartController::class, 'checkout']);



Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
