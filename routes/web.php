<?php

use App\Http\Controllers\BancosController;
use Illuminate\Support\Facades\Route;

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/', [BancosController::class, 'home'])->name('home');
