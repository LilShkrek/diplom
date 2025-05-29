<?php

use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

$commonMiddleware = [];

Route::middleware($commonMiddleware)->group(function () {
    Route::resource('employee', EmployeeController::class);
});
