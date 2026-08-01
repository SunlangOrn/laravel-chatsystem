<?php

use App\Http\Controllers\API\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\GoogleOAuthController;

Route::post('/signup', [AuthController::class, 'signup']);
Route::post('/signin', [AuthController::class, 'signin']);
Route::get('/verify/email/{id}/{hash}', [AuthController::class, 'verifyEmail'])
    ->middleware('signed')
    ->name('verify.email');
Route::post('/send/verification-email', [AuthController::class, 'sendVerificationEmail']);
Route::post('/send/reset-password-email', [AuthController::class, 'sendResetPasswordEmail']);
Route::post('/set/new-password', [AuthController::class, 'setNewPassword']);

Route::prefix('google')->group(function () {
    Route::get('/oauth/redirect', [GoogleOAuthController::class, 'googleOAuthRedirect']);
    Route::get('/oauth/callback', [GoogleOAuthController::class, 'googleOAuthCallback']);
    Route::post('/oauth/exchange/token', [GoogleOAuthController::class, 'googleOAuthExchangeToken'])->middleware('auth:sanctum');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/signout', [AuthController::class, 'signout']);
    Route::get('/verify', [AuthController::class, 'verify']);
});