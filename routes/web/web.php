<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

//! Dashboard Route
Route::get('/dashboard', function () {
    return view('backend.dashboard.index');
})->middleware(['auth', 'verified'])->name('dashboard');

//! Auth Routes
require 'v1/auth/auth.php';
