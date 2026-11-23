<?php

use App\Enums\Tool;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ToolController;
use App\Http\Controllers\RobotsController;
use App\Http\Controllers\SitemapController;

Route::get('robots.txt', RobotsController::class)->name('robots');
Route::get('sitemap.xml', SitemapController::class)->name('sitemap');

Route::get(Tool::Device.'/{uuid?}', [ToolController::class, Tool::Device])->name(Tool::Device);
Route::get(Tool::Browser.'/{uuid?}', [ToolController::class, Tool::Browser])->name(Tool::Browser);
Route::get(Tool::Location.'/{uuid?}', [ToolController::class, Tool::Location])->name(Tool::Location);

Route::get('{uuid?}', HomeController::class)->name('home');
