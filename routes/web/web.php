<?php

use App\Http\Controllers\Web\V1\Users\UserManagementController;
use Illuminate\Support\Facades\Route;


// ! Dashboard Route
Route::get('/dashboard', function () {
    return view('backend.dashboard.index');
})->name('dashboard');

// ! User Management Routes
Route::resource('users', UserManagementController::class);
Route::post('user/status/{id}', [UserManagementController::class, 'status']);
