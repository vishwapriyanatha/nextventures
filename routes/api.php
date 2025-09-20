<?php

use Illuminate\Support\Facades\Route;

Route::post('/orders/import', [\App\Http\Controllers\API\OrderImportController::class, 'upload'])
    ->name('file.upload');

Route::get('daily_kpi', [\App\Http\Controllers\API\KpiController::class, 'getDailyKPI'])
    ->name('daily.kpi');


