<?php

use App\Http\Controllers\Web\V1\Auth\ProfileController;
use App\Http\Controllers\Web\V1\Settings\Content\PrivacyPolicyController;
use App\Http\Controllers\Web\V1\Settings\Content\TermsAndConditionsController;
use App\Http\Controllers\Web\V1\Settings\DatabaseBackup\DatabaseBackupController;
use App\Http\Controllers\Web\V1\Settings\Integration\IntegrationController;
use App\Http\Controllers\Web\V1\Settings\Mail\MailController;
use App\Http\Controllers\Web\V1\Settings\SocialMedia\SocialMediaController;
use Illuminate\Support\Facades\Route;

// ! Settings Routes
Route::middleware(['auth', 'verified'])->group(function () {
    // ! Profile Routes
    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('profile/password', [ProfileController::class, 'password'])->name('profile.password');
    Route::delete('profile/sessions', [ProfileController::class, 'logoutSessions'])->name('profile.sessions.logout');

    // ! Mail SMTP Settings
    Route::resource('mail-setting', MailController::class)->only(['index', 'store']);
    Route::post('mail-setting/test', [MailController::class, 'test'])->name('mail-setting.test');

    // ! Database Backup
    Route::get('database/export', [DatabaseBackupController::class, 'index'])->name('database.export');
    Route::match(['GET', 'POST'], 'database/export/download', [DatabaseBackupController::class, 'export'])->name('database.export.download');

    // ! Social Media Links
    Route::apiResource('social-links', SocialMediaController::class)->only(['index', 'store', 'destroy']);

    // ! Integration Settings
    Route::controller(IntegrationController::class)->group(function () {
        Route::get('/integration-setting', 'index')->name('integration.setting');
        Route::patch('/google-setting', 'updateGoogleCredentials')->name('google.update');
        Route::patch('/facebook-setting', 'updateFacebookCredentials')->name('facebook.update');
        Route::patch('/apple-setting', 'updateAppleCredentials')->name('apple.update');
        Route::patch('/twilio-setting', 'updateTwilioCredentials')->name('twilio.update');
        Route::patch('/stripe-setting', 'updateStripeCredentials')->name('stripe.update');
    });

    // ! Content Management
    Route::resource('terms-and-conditions', TermsAndConditionsController::class)->only(['index', 'store']);
    Route::resource('privacy-policy', PrivacyPolicyController::class)->only(['index', 'store']);
});
