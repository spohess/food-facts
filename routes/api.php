<?php

use App\Enum\ImportControlStatusEnum;
use App\Http\Controllers\API\ProductDeleteController;
use App\Http\Controllers\API\ProductSelectAllController;
use App\Http\Controllers\API\ProductSelectController;
use App\Http\Controllers\API\ProductUpdateController;
use App\Http\Controllers\API\StatusServerController;
use App\Http\Controllers\API\TokenCreateController;
use App\Models\ImportControl;
use Illuminate\Support\Facades\Route;

Route::get('/', StatusServerController::class);

// Rota para facilidar o teste de notificação caso de falha
Route::put('/import/fail', function () {
    $ic = ImportControl::find(1);
    if ($ic) {
        $ic->status = ImportControlStatusEnum::FAILURE->value;
        $ic->save();

        $ic->status = ImportControlStatusEnum::SUCCESS->value;
        $ic->save();
    }
});

Route::post('/tokens/create', TokenCreateController::class);

Route::middleware('auth:sanctum')
    ->prefix('/products')
    ->group(function () {
        Route::get('/', ProductSelectAllController::class)->name('product.select');
        Route::get('/{code}', ProductSelectController::class)->name('product.select');
        Route::put('/{code}', ProductUpdateController::class)->name('product.update');
        Route::delete('/{code}', ProductDeleteController::class)->name('product.update');
    });
