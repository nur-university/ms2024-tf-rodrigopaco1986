<?php

use Illuminate\Support\Facades\Route;
use Src\Sales\Invoice\Presentation\Controllers\CreateInvoiceController;
use Src\Sales\Invoice\Presentation\Controllers\ViewInvoiceController;

Route::post('/create', CreateInvoiceController::class);
Route::get('/view/{id}', ViewInvoiceController::class);
