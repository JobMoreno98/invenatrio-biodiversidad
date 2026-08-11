<?php

use App\Http\Controllers\AdopcionController;
use App\Http\Controllers\EspecieController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get("/", [HomeController::class, 'index'])->name('home');

Route::resource('especies', EspecieController::class);

Route::prefix('adopciones')->name('adopciones.')->group(function () {
    Route::get('/', [AdopcionController::class, 'index'])->name('index');
    Route::get('/{folio}', [AdopcionController::class, 'show'])->name('show');
});