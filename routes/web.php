<?php

use App\Http\Controllers\EspecieController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get("/", [HomeController::class, 'index'])->name('home');

Route::resource('especies', EspecieController::class);
