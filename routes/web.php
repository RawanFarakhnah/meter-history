<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MeterHistoryController;

Route::get('/', function () {
    return redirect()->route('meter_histories.index');
});


// Route::get('/meter_histories', [MeterHistoryController::class, 'index'])->name('meter_histories.index');
// Route::get('/meter_histories/create', [MeterHistoryController::class, 'create'])->name('meter_histories.create');
// Route::post('/meter_histories', [MeterHistoryController::class, 'store'])->name('meter_histories.store');
// Route::get('/meter_histories/{meterHistory}', [MeterHistoryController::class, 'show'])->name('meter_histories.show');
// Route::get('/meter_histories/{meterHistory}/edit', [MeterHistoryController::class, 'edit'])->name('meter_histories.edit');
// Route::put('/meter_histories/{meterHistory}', [MeterHistoryController::class, 'update'])->name('meter_histories.update');
// Route::delete('/meter_histories/{meterHistory}', [MeterHistoryController::class, 'destroy'])->name('meter_histories.destroy');

Route::resource('meter_histories', MeterHistoryController::class);

// Import routes
Route::post('/meter_histories/import', [MeterHistoryController::class, 'importStore'])
     ->name('meter_histories.import.store');
     
Route::get('/meter_histories/export/template', [MeterHistoryController::class, 'exportTemplate'])
     ->name('meter_histories.export.template');
