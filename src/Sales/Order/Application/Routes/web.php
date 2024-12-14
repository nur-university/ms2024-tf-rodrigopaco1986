<?php

use Illuminate\Support\Facades\Route;
use Src\Sales\Order\Presentation\Controllers\CreateOrderController;
use Src\Sales\Order\Presentation\Controllers\ViewOrderController;

Route::post('/create', CreateOrderController::class);
Route::get('/view/{id}', ViewOrderController::class);
