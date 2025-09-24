<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MeterHistoryController;

Route::get('/', function () {
    return redirect()->route('meter_histories.index');
});

// Import route
Route::post('/meter_histories/import', [MeterHistoryController::class, 'import'])->name('meter_histories.import');

// Sample template download route
Route::get('/meter_histories/download-sample', [MeterHistoryController::class, 'downloadSample'])->name('meter_histories.download_sample');

// Resource route
Route::resource('meter_histories', MeterHistoryController::class);
