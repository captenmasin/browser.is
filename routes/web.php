<?php

use App\Http\Controllers\ToolController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('device/{uuid?}', [ToolController::class, 'device'])->name('device');
Route::get('browser/{uuid?}', [ToolController::class, 'browser'])->name('browser');
Route::get('location/{uuid?}', [ToolController::class, 'location'])->name('location');

Route::get('mail/{uuid}', function ($uuid){
    return new App\Mail\Results(\App\Models\Result::where('uuid', $uuid)->first());
});

Route::get('/{uuid?}', HomeController::class)->name('home');
