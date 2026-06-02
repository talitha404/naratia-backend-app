<?php

namespace App\Http\Controllers\Api; // Pastikan namespacenya ada \Api-nya

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bookmark;

class BookmarkController extends Controller
{
    // Fungsi untuk simpan/bookmark cerita
    public function store(Request $request)
    {
        // 1. Validasi data yang dikirim Flutter
        $request->validate([
            'story_id' => 'required|exists:stories,id',
        ]);

        $userId = $request->user()->id;
        $storyId = $request->story_id;

        // 2. Cek apakah sudah pernah disimpan (biar tidak duplikat)
        $exists = Bookmark::where('user_id', $userId)
                          ->where('story_id', $storyId)
                          ->first();

        if ($exists) {
            return response()->json([
                'message' => 'Cerita ini sudah ada di perpustakaanmu!'
            ], 400); 
        }

        // 3. Simpan ke database
        $bookmark = Bookmark::create([
            'user_id' => $userId,
            'story_id' => $storyId,
        ]);

        return response()->json([
            'message' => 'Cerita berhasil disimpan ke perpustakaan!',
            'data' => $bookmark
        ], 201); 
    }

    // Fungsi untuk menampilkan daftar buku di library
    public function index(Request $request)
    {
        $bookmarks = Bookmark::where('user_id', $request->user()->id)
            ->with('story') // Bawa data ceritanya sekalian
            ->get();

        return response()->json([
            'message' => 'Berhasil mengambil data perpustakaan',
            'data' => $bookmarks
        ], 200);
    }
}