<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// ======================
// Auth Routes
// ======================
use App\Http\Controllers\Auth\AuthController;
Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/find-account', [AuthController::class, 'findAccount']);
    Route::post('/verify-otp', [AuthController::class, 'verifyOtp']);
    Route::post('/reset-password', [AuthController::class, 'resetPassword']);
});


// ======================
// Profile Routes
// ======================
use App\Http\Controllers\Auth\ProfileController;
Route::middleware(['auth:sanctum'])->group(function () {
    Route::prefix('profile')->group(function () {
        Route::put('/', [ProfileController::class, 'update']);
        Route::put('/password', [ProfileController::class, 'changePassword']);
    });
});

// ======================
// Product Routes
// ======================
use App\Http\Controllers\Product\ProductController;
Route::middleware(['auth:sanctum'])->group(function () {
    Route::prefix('products')->group(function () {
        // Additional routes for categories, subcategories, and brands
        Route::get('/get-categories', [ProductController::class, 'getCategory']);
        Route::get('/get-subcategories', [ProductController::class, 'getSubCategory']);
        Route::get('/get-brands', [ProductController::class, 'getBrand']);
    });
});
