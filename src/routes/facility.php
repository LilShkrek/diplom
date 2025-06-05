<?php

use App\Http\Controllers\FacilityController;
use Illuminate\Support\Facades\Route;

$commonMiddleware = [];

Route::middleware($commonMiddleware)->group(function () {
    Route::get('/facility/export', [\App\Http\Controllers\FacilityController::class, 'export'])->name('facility.export');
    Route::resource('facility', FacilityController::class);
});
