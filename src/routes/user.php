<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

$commonMiddleware = [];

Route::get('/user/export', [UserController::class, 'export'])->name('user.export');
Route::resource('user', UserController::class);
