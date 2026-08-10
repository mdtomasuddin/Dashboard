<?php

use App\Http\Controllers\Api\V1\Settings\SocialMediaController;
use Illuminate\Support\Facades\Route;

// ! V1 Routes
Route::prefix('v1')->group(function () {
    // ! Social Media Links Routes
    Route::apiResource('social-media', SocialMediaController::class);
});
