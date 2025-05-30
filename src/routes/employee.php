<?php

use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

$commonMiddleware = [];

Route::middleware($commonMiddleware)->group(function () {
    Route::get('/employee/export', [EmployeeController::class, 'export'])->name('employee.export');
    Route::resource('employee', EmployeeController::class);
});
