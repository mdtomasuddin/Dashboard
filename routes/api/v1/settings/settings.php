<?php

use App\Http\Controllers\Api\V1\Settings\FAQController;
use App\Http\Controllers\Api\V1\Settings\SocialMediaController;
use App\Http\Controllers\Api\V1\Settings\SystemSettingController;
use Illuminate\Support\Facades\Route;

// ! V1 Routes
Route::prefix('v1')->group(function () {
    // ! Social Media Links
    Route::apiResource('social-media', SocialMediaController::class);

    // ! System Settings
    Route::get('system-setting', [SystemSettingController::class, 'index']);

    // ! FAQs
    Route::apiResource('faqs', FAQController::class);
});
