<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\FeedbackController;
use App\Http\Controllers\StoryController; 
use App\Http\Controllers\ContentController; 
use App\Http\Controllers\CommentController; // 👈 Sudah diimport
use App\Http\Controllers\LikeController;    // 👈 Sudah diimport
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// test endpoint
Route::get('/test', function () {
    return response()->json(['message' => 'API OK']);
});

// users
Route::apiResource('users', UserController::class);

// auth
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// protected routes (Semua fitur di bawah ini WAJIB login / bawa token dari Flutter)
Route::middleware('auth:sanctum')->group(function () {

    // 🚪 AUTH & USER
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::put('/profile', [ProfileController::class, 'update']);
    Route::post('/feedback', [FeedbackController::class, 'store']);

    // 🔐 FITUR CERITA / NOVEL NARATIA (Bisa Baca & Bisa Tulis)
    Route::get('/stories', [StoryController::class, 'published']);               // Ambil semua cerita untuk Beranda (Pembaca)
    Route::get('/stories/{id}', [StoryController::class, 'show']);                 // Ambil detail cerita & sinopsis (Pembaca)
    Route::post('/stories', [StoryController::class, 'store']);                   // Bikin draft cerita baru (Penulis)
    Route::post('/stories/{id}/cover', [StoryController::class, 'uploadCover']);     // Upload cover buku cerita (Penulis)
    Route::post('/stories/{id}/publish', [StoryController::class, 'publish']);       // Mengubah status draft jadi published (Penulis)
    Route::get('/my-stories', [StoryController::class, 'myStories']);             // Ambil semua cerita milik user login (Penulis)
    Route::get('/my-drafts', [StoryController::class, 'drafts']);                 // Ambil khusus draft milik user login (Penulis)
    Route::get('/genres', function () {return DB::table('genres')->get();});
    Route::patch('/stories/{id}/status', [StoryController::class, 'updateStatus']);

    // 📝 FITUR ISI BAB / KONTEN NOVEL
    Route::post('/chapters', [ContentController::class, 'store']);                      // Tambah / Update Bab baru (Penulis)
    Route::get('/stories/{storyId}/chapters', [ContentController::class, 'getByStory']); // Ambil semua bab untuk halaman Baca (Pembaca)
    Route::get('/chapters/{id}', [ContentController::class, 'show']);                    // Lihat detail 1 bab untuk Edit (Penulis)
    Route::put('/chapters/{id}', [ContentController::class, 'update']);                  // Mengubah isi teks bab (Penulis)
    Route::delete('/chapters/{id}', [ContentController::class, 'destroy']);              // Menghapus bab cerita (Penulis)

    // 💬 FITUR KOMENTAR
    Route::post('/comments', [CommentController::class, 'store']);                       // Kirim komen baru dari Flutter
    Route::get('/stories/{storyId}/comments', [CommentController::class, 'getByStory']);  // Ambil list komen di bawah novel

    // ❤️ FITUR LIKE
    Route::post('/likes/toggle', [LikeController::class, 'toggleLike']);                 // Tombol Like & Batal Like (Toggle)
});