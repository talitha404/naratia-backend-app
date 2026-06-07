<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\FeedbackController;
use App\Http\Controllers\StoryController; 
use App\Http\Controllers\ContentController; 
use App\Http\Controllers\CommentController; 
use App\Http\Controllers\LikeController;    
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// ==========================================
// 🔓 ROUTE PUBLIK (Bisa diakses tanpa harus Login)
// ==========================================

Route::get('/test', function () {
    return response()->json(['message' => 'API OK']);
});

Route::apiResource('users', UserController::class);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login'])->name('login');

// Fitur Baca & Beranda (Public)
Route::get('/stories', [StoryController::class, 'published']); 
Route::get('/stories/{id}', [StoryController::class, 'show']); 
Route::get('/genres', function () { return DB::table('genres')->get(); }); 

// Fitur Baca Bab & Komentar (Public)
Route::get('/stories/{storyId}/chapters', [ContentController::class, 'getByStory']);
Route::get('/chapters/{id}', [ContentController::class, 'show']);
Route::get('/stories/{storyId}/comments', [CommentController::class, 'getByStory']);

// ==========================================
// 🔐 ROUTE PROTECTED (WAJIB Login / Bawa Token)
// ==========================================
Route::middleware('auth:sanctum')->group(function () {

    // 🚪 AUTH & USER
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {return $request->user();});
    Route::put('/profile', [ProfileController::class, 'update']);
    Route::post('/feedback', [FeedbackController::class, 'store']);

    // 📝 FITUR TULIS CERITA (Penulis)
    Route::patch('/stories/{id}/status', [StoryController::class, 'updateStatus']);
    Route::post('/stories', [StoryController::class, 'store']);
    Route::post('/stories/{id}/cover', [StoryController::class, 'uploadCover']);
    Route::post('/stories/{id}/publish', [StoryController::class, 'publish']);
    Route::get('/my-stories', [StoryController::class, 'myStories']);
    Route::get('/my-drafts', [StoryController::class, 'drafts']);
    Route::get('/my-published', [StoryController::class, 'published']);
    
    // 📝 FITUR TULIS BAB
    Route::post('/chapters', [ContentController::class, 'store']);
    Route::put('/chapters/{id}', [ContentController::class, 'update']);
    Route::delete('/chapters/{id}', [ContentController::class, 'destroy']);

    // 💬 FITUR INTERAKSI
    Route::post('/comments', [CommentController::class, 'store']);
    Route::post('/likes/toggle', [LikeController::class, 'toggleLike']);

    // 📚 FITUR BOOKMARK
    Route::get('/bookmarks', [\App\Http\Controllers\Api\BookmarkController::class, 'index']); 
    Route::post('/bookmarks', [\App\Http\Controllers\Api\BookmarkController::class, 'store']);
});