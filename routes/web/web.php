<?php

use App\Http\Controllers\Web\V1\Users\UserManagementController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

// ! Dashboard Route
Route::get('/dashboard', function () {
    return view('backend.dashboard.index');
})->middleware(['auth', 'verified'])->name('dashboard');

// ! Auth Routes
require 'v1/auth/auth.php';

// ! User Management Routes
Route::resource('users', UserManagementController::class)->except(['show'])->middleware(['auth', 'verified']);
Route::post('user/status/{id}', [UserManagementController::class, 'status'])->middleware(['auth', 'verified']);
