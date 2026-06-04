<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\FeedbackController;
use Illuminate\Http\Request;

// test endpoint
Route::get('/test', function () {
    return response()->json(['message' => 'API OK']);
});

// users
Route::apiResource('users', UserController::class);

// auth
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// protected routes
Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::put('/profile', [ProfileController::class, 'update']);

    Route::post('/feedback', [
        FeedbackController::class,
        'store'
    ]);
});