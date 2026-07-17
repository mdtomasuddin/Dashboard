<?php

use App\Http\Controllers\Web\V1\Auth\ProfileController;
use Illuminate\Support\Facades\Route;

// ! Settings Routes
Route::middleware(['auth', 'verified'])->group(function () {
    // ! Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'password'])->name('profile.password');
    Route::delete('/profile/sessions', [ProfileController::class, 'logoutSessions'])->name('profile.sessions.logout');
});
