<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MeterHistoryController;

// Home
Route::get('/', function () {
    return view('welcome');
});

// MeterHistories CRUD
Route::get('/meter-histories', [MeterHistoryController::class, 'index'])->name('meter_histories.index');
Route::get('/meter-histories/{meter_history}/edit', [MeterHistoryController::class, 'edit'])->name('meter_histories.edit');
Route::put('/meter-histories/{meter_history}', [MeterHistoryController::class, 'update'])->name('meter_histories.update');
Route::delete('/meter-histories/{meter_history}', [MeterHistoryController::class, 'destroy'])->name('meter_histories.destroy');

// Import routes
Route::get('/meter-histories/import', [MeterHistoryController::class, 'create'])->name('meter_histories.import'); // Show import form
Route::post('/meter-histories/import', [MeterHistoryController::class, 'store'])->name('meter_histories.import.store'); // Handle file upload

// Download error file
Route::get('/meter-histories/errors/{file}', [MeterHistoryController::class, 'downloadErrorFile'])->name('meter_histories.downloadErrors');
