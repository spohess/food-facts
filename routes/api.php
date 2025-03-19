<?php

use App\Http\Controllers\API\ProductSelectController;
use App\Http\Controllers\API\ProductUpdateController;
use App\Http\Controllers\API\StatusServerController;
use App\Http\Controllers\API\TokenCreateController;
use Illuminate\Support\Facades\Route;

Route::get('/', StatusServerController::class);

Route::post('/tokens/create', TokenCreateController::class);

Route::middleware('auth:sanctum')
    ->prefix('/products')
    ->group(function () {
        Route::get('/{code}', ProductSelectController::class)->name('product.select');
        Route::put('/{code}', ProductUpdateController::class)->name('product.update');
    });
