<?php

use App\Actions\GetBrowserData;
use App\Actions\GetDeviceData;
use App\Actions\GetLocationData;
use App\Actions\GetShareUrl;
use App\Actions\SaveResults;
use App\Actions\SendResultsToEmail;
use Illuminate\Support\Facades\Route;

Route::name('api.')->group(function () {
        Route::prefix('data')->group(function () {
        Route::get('device/{uuid?}', GetDeviceData::class)->name('device');
        Route::get('browser/{uuid?}', GetBrowserData::class)->name('browser');
        Route::get('location/{uuid?}', GetLocationData::class)->name('location');

        Route::get('url', GetShareUrl::class)->name('url');

        Route::post('store', SaveResults::class)->name('store');

        Route::post('notify', SendResultsToEmail::class)->name('notify');
    });
});


