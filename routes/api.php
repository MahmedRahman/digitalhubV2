<?php

use Illuminate\Support\Facades\Route;

// API Routes for Homepage Content
Route::prefix('homepage-content')->group(function () {
    Route::get('/', [App\Http\Controllers\HomepageContentController::class, 'getContent']);
    Route::post('/update', [App\Http\Controllers\HomepageContentController::class, 'update']);
    Route::post('/upload-image', [App\Http\Controllers\HomepageContentController::class, 'uploadImage']);
});

// API Routes for About Page Content
Route::prefix('about-content')->group(function () {
    Route::get('/', [App\Http\Controllers\AboutContentController::class, 'getContent']);
    Route::post('/update', [App\Http\Controllers\AboutContentController::class, 'update']);
});

// API Routes for Contact Page Content
Route::prefix('contact-content')->group(function () {
    Route::get('/', [App\Http\Controllers\ContactContentController::class, 'getContent']);
    Route::post('/update', [App\Http\Controllers\ContactContentController::class, 'update']);
});

