<?php

use App\Actions\GetBrowserData;
use App\Actions\GetDeviceData;
use App\Actions\GetLocationData;
use Illuminate\Support\Facades\Route;

Route::name('api.')->group(function () {
    Route::prefix('data')->group(function () {
        Route::get('device/{ip?}', GetDeviceData::class)->name('device');
        Route::get('browser', GetBrowserData::class)->name('browser');
        Route::get('location/{ip?}', GetLocationData::class)->name('location');
    });
});


