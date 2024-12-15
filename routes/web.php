<?php

use App\Http\Controllers\IncomesController;
use App\Http\Controllers\StocksController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\SalesController;
use Illuminate\Support\Facades\Route;

Route::get('/incomes', [IncomesController::class, 'index'])->name('incomes');
Route::get('/stocks', [StocksController::class, 'index'])->name('stocks');
Route::get('/orders', [OrdersController::class, 'index'])->name('orders');
Route::get('/sales', [SalesController::class, 'index'])->name('sales');
