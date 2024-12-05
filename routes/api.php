<?php

use App\Http\Controllers\BancosController;
use Illuminate\Support\Facades\Route;

Route::get('/bancos', [BancosController::class, 'index'])->name('bancos.index');
Route::get('/banco/{codigo}', [BancosController::class, 'show'])->name('bancos.show');
