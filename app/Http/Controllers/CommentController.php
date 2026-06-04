<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment; // 👈 Pastikan model Comment sudah dibuat kelompokmu

class CommentController extends Controller
{
    // 💬 Fungsi untuk mengirim komentar baru
    public function store(Request $request)
    {
        $request->validate([
            'story_id' => 'required|exists:stories,id',
            'content' => 'required|string',
        ]);

        $comment = Comment::create([
            'story_id' => $request->story_id,
            'user_id' => Auth::id(), // Mengambil ID user yang sedang login
            'content' => $request->content,
        ]);

        // Muat data user-nya sekalian biar di Flutter bisa langsung muncul nama komentatornya
        $comment->load('user');

        return response()->json([
            'message' => 'Komentar berhasil ditambahkan',
            'data' => $comment
        ]);
    }

    // 📖 Fungsi untuk mengambil semua komentar di satu novel/cerita
    public function getByStory(int $storyId)
    {
        $comments = Comment::with('user')
            ->where('story_id', $storyId)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($comments);
    }
}