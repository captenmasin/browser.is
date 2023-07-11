<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', HomeController::class)->name('home');
Route::get('device', HomeController::class)->name('device');
Route::get('browser', HomeController::class)->name('browser');
Route::get('location', HomeController::class)->name('location');
