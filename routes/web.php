<?php

use App\Http\Controllers\ToolController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', HomeController::class)->name('home');
Route::get('device', [ToolController::class, 'device'])->name('device');
Route::get('browser', [ToolController::class, 'browser'])->name('browser');
Route::get('location', [ToolController::class, 'location'])->name('location');
