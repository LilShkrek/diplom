<?php

use App\Http\Controllers\FacilityController;
use Illuminate\Support\Facades\Route;

$commonMiddleware = [];

Route::middleware($commonMiddleware)->group(function () {
    Route::resource('facility', FacilityController::class)->except(['show']); // Если show не нужен
});
