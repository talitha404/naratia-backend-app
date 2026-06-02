<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\ContentController;

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

    // Auth
    Route::post('/logout', [AuthController::class, 'logout']);

    // Stories
    Route::post('/stories', [StoryController::class, 'store']);
    Route::get('/stories/{story}', [StoryController::class, 'show']);

    Route::post('/stories/{story}/cover', [StoryController::class, 'uploadCover']);
    Route::post('/stories/{story}/publish', [StoryController::class, 'publish']);

    Route::get('/my-stories', [StoryController::class, 'myStories']);
    Route::get('/my-stories/drafts', [StoryController::class, 'drafts']);
    Route::get('/my-stories/published', [StoryController::class, 'published']);

    // Chapters (Content)
    Route::get('/stories/{story}/chapters', [ContentController::class, 'index']); // rename dari getByStory

    Route::post('/chapters', [ContentController::class, 'store']); // auto-save
    Route::get('/chapters/{id}', [ContentController::class, 'show']);
    Route::put('/chapters/{id}', [ContentController::class, 'update']); // optional
    Route::delete('/chapters/{id}', [ContentController::class, 'destroy']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});