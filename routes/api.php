<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;

// test endpoint (biarkan dulu)
Route::get('/test', function () {
    return response()->json(['message' => 'API OK']);
});

// endpoint utama API kamu
Route::apiResource('users', UserController::class);

// endpoint untuk register
Route::post('/register', [AuthController::class, 'register']);

// endpoint untuk login
Route::post('/login', [AuthController::class, 'login']);

// endpoint untuk logout (hanya untuk user yang sudah login)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});