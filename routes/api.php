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

// test endpoint
Route::get('/test', function () {
    return response()->json(['message' => 'API OK']);
});

// users
Route::apiResource('users', UserController::class);

// auth
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login'])->name('login');;

// Fitur Baca Cerita & Beranda (Bebas Akses)
Route::get('/stories', [StoryController::class, 'published']);               // Ambil semua cerita untuk Beranda
Route::get('/stories/{id}', [StoryController::class, 'show']);                 // Ambil detail cerita & sinopsis
Route::get('/genres', function () { return DB::table('genres')->get(); });     // Ambil daftar genre

// Fitur Baca Bab (Bebas Akses)
Route::get('/stories/{storyId}/chapters', [ContentController::class, 'getByStory']); // Ambil semua bab
Route::get('/chapters/{id}', [ContentController::class, 'show']);                    // Lihat detail 1 bab

// Fitur Lihat Komentar (Bebas Akses)
Route::get('/stories/{storyId}/comments', [CommentController::class, 'getByStory']); // Ambil list komen di bawah novel


// ==========================================
// 🔐 ROUTE PROTECTED (WAJIB Login / Bawa Token)
// ==========================================
Route::middleware('auth:sanctum')->group(function () {

    // 🚪 AUTH & USER
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {return $request->user();});
    Route::put('/profile', [ProfileController::class, 'update']);
    Route::post('/feedback', [FeedbackController::class, 'store']);

    // --- 📖 FITUR CERITA / NOVEL NARATIA (Pembaca & Penulis)
    Route::get('/stories', [StoryController::class, 'published']);    // Ambil semua cerita untuk Beranda (Pembaca)
    Route::get('/stories/{id}', [StoryController::class, 'show']);    // Ambil detail cerita & sinopsis (Pembaca)
    Route::get('/genres', function () {return DB::table('genres')->get();});
    Route::patch('/stories/{id}/status', [StoryController::class, 'updateStatus']);

    // --- 📝 FITUR TULIS CERITA (Khusus Penulis yang Login)
    Route::post('/stories', [StoryController::class, 'store']);                  // Bikin draft cerita baru
    Route::post('/stories/{id}/cover', [StoryController::class, 'uploadCover']); // Upload cover buku
    Route::post('/stories/{id}/publish', [StoryController::class, 'publish']);   // Publish cerita
    Route::get('/my-stories', [StoryController::class, 'myStories']);            // Ambil cerita milik user
    Route::get('/my-drafts', [StoryController::class, 'drafts']);
    Route::get('/my-published', [StoryController::class, 'published']);
    
    //📝 FITUR TULIS CERITA (Khusus Penulis yang Login) PUNYA SIAPA INI? KURAPIKAN DI ATASNYA YA
    // Route::post('/stories', [StoryController::class, 'store']);                  // Bikin draft cerita baru
    // Route::post('/stories/{id}/cover', [StoryController::class, 'uploadCover']); // Upload cover buku
    // Route::post('/stories/{id}/publish', [StoryController::class, 'publish']);   // Publish cerita
    // Route::get('/my-stories', [StoryController::class, 'myStories']);            // Ambil cerita milik user
    // Route::get('/my-drafts', [StoryController::class, 'drafts']);                // Ambil draft milik user

    // 📝 FITUR TULIS BAB (Khusus Penulis yang Login)
    Route::post('/chapters', [ContentController::class, 'store']);               // Tambah Bab baru
    Route::put('/chapters/{id}', [ContentController::class, 'update']);          // Edit teks bab
    Route::delete('/chapters/{id}', [ContentController::class, 'destroy']);      // Hapus bab cerita

    // 💬 FITUR INTERAKSI (Wajib Login)
    Route::post('/comments', [CommentController::class, 'store']);               // Kirim komen baru
    Route::post('/likes/toggle', [LikeController::class, 'toggleLike']);         // Tombol Like

    // 📚 FITUR PERPUSTAKAAN / BOOKMARK (Wajib Login biar tahu siapa yang simpan)
    Route::get('/bookmarks', [\App\Http\Controllers\Api\BookmarkController::class, 'index']); 
    Route::post('/bookmarks', [\App\Http\Controllers\Api\BookmarkController::class, 'store']);
});