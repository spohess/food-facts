<?php

use App\Http\Controllers\API\TokenCreateController;
use Illuminate\Support\Facades\Route;

Route::post('/tokens/create', TokenCreateController::class);


