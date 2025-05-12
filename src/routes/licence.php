<?php

use App\Http\Controllers\LicenceController;
use Illuminate\Support\Facades\Route;

$commonMiddleware = [];

//Route::prefix('/licence')
//    ->middleware($commonMiddleware)
//    ->group(function () {
////        Route::get('', LicenceIndexController::class)->name('licence.public');
////        Route::post('', [LicenceController::class, 'store'])->name('licence.store');
//        Route::get('', [LicenceController::class, 'show']);
////        Route::patch('{id}', [LicenceController::class, 'update'])->name('licence.update');
////        Route::delete('{id}', [LicenceController::class, 'destroy'])->name('licence.destroy');
//    });

Route::middleware($commonMiddleware)->group(function () {
    Route::resource('licence', LicenceController::class)->except(['show']); // Если show не нужен
});
