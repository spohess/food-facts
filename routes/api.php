<?php

use App\Http\Controllers\API\StatusServerController;
use App\Http\Controllers\API\TokenCreateController;
use Illuminate\Support\Facades\Route;

Route::get('/', StatusServerController::class);

Route::post('/tokens/create', TokenCreateController::class);

Route::middleware('auth:sanctum')
    ->prefix('/products')
    ->group(function () {
        Route::post('/tokens/create', TokenCreateController::class);
    });
