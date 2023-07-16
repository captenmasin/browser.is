<?php

use App\Actions\GetBrowserData;
use App\Actions\GetDeviceData;
use App\Actions\GetLocationData;
use App\Actions\GetShareUrl;
use App\Actions\SaveResults;
use App\Actions\SendResultsToEmail;
use App\Enums\Tool;
use App\Http\Middleware\CheckToken;
use App\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;

Route::name('api.')->middleware([VerifyCsrfToken::class, 'web', CheckToken::class])->group(function () {
    Route::prefix('data')->group(function () {
        Route::get(Tool::Device . '/{uuid?}', GetDeviceData::class)->name(Tool::Device);
        Route::get(Tool::Browser . '/{uuid?}', GetBrowserData::class)->name(Tool::Browser);
        Route::get(Tool::Location . '/{uuid?}', GetLocationData::class)->name(Tool::Location);

        Route::get('url', GetShareUrl::class)->name('url');

        Route::post('store', SaveResults::class)->name('store');

        Route::post('notify', SendResultsToEmail::class)->name('notify');
    });
});


