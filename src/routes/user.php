<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

$commonMiddleware = [];

Route::resource('user', UserController::class);
