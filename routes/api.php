<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\BookmarkController; 
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

// --- SEMUA ENDPOINT YANG BUTUH LOGIN (TOKEN) DIJADIKAN SATU GRUP ---
Route::middleware('auth:sanctum')->group(function () {
    
    // endpoint untuk logout
    Route::post('/logout', [AuthController::class, 'logout']);
    
    // endpoint untuk get data user login
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // endpoint untuk fitur Library / Bookmark (Penyimpanan Buku)
    Route::post('/bookmarks', [BookmarkController::class, 'store']); // Simpan cerita
    Route::get('/bookmarks', [BookmarkController::class, 'index']);  // Ambil daftar cerita di library
});