<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware([])->group(function () {
    require __DIR__ . '/licence.php';
    require __DIR__ . '/facility.php';
    require __DIR__ . '/employee.php';
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
