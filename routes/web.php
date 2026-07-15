<?php

use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return view('backend.dashboard.index');
})->middleware(['auth', 'verified'])->name('dashboard');
require __DIR__ . '/auth.php';
