<?php

use App\Enums\Tool;
use App\Http\Controllers\ToolController;
use App\Models\Result;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get(Tool::Device . '/{uuid?}', [ToolController::class, Tool::Device])->name(Tool::Device);
Route::get(Tool::Browser . '/{uuid?}', [ToolController::class, Tool::Browser])->name(Tool::Browser);
Route::get(Tool::Location . '/{uuid?}', [ToolController::class, Tool::Location])->name(Tool::Location);

Route::get('/{uuid?}', HomeController::class)->name('home');
