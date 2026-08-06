<?php

use App\Http\Controllers\Api\V1\Auth\AuthController;
use App\Http\Controllers\Api\V1\Auth\AuthenticatedAuthController;
use Illuminate\Support\Facades\Route;

// ! auth routes here
Route::prefix('v1/auth')->group(function () {

    // ! Public Routes (Guest)
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);

    // ! Password Recovery Routes
    Route::post('otp-send', [AuthController::class, 'sendOtp']);
    Route::post('otp-match', [AuthController::class, 'verifyOtp']);
    Route::post('reset-password', [AuthController::class, 'resetPassword']);

    // ! Protected Routes (Requires Bearer JWT Token)
    Route::middleware('auth:api')->group(function () {
        Route::post('logout', [AuthenticatedAuthController::class, 'logout']);
        Route::post('refresh', [AuthenticatedAuthController::class, 'refresh']);
        Route::post('change-password', [AuthenticatedAuthController::class, 'changePassword']);
        Route::delete('delete-account', [AuthenticatedAuthController::class, 'deleteAccount']);
    });
});
