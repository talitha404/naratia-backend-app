<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Like; // 👈 Pastikan model Like sudah dibuat kelompokmu

class LikeController extends Controller
{
    // ❤️ Fungsi pencet Like / Batal Like (Toggle)
    public function toggleLike(Request $request)
    {
        $request->validate([
            'story_id' => 'required|exists:stories,id',
        ]);

        $userId = Auth::id();
        $storyId = $request->story_id;

        // Cek apakah user ini sudah pernah like cerita ini sebelumnya
        $like = Like::where('user_id', $userId)
                    ->where('story_id', $storyId)
                    ->first();

        if ($like) {
            // Kalau sudah ada, berarti user klik untuk BATAL LIKE (Unlike)
            $like->delete();
            return response()->json([
                'liked' => false,
                'message' => 'Batal menyukai cerita ini'
            ]);
        } else {
            // Kalau belum ada, berarti user klik untuk MENYUKAI (Like)
            Like::create([
                'user_id' => $userId,
                'story_id' => $storyId,
            ]);
            return response()->json([
                'liked' => true,
                'message' => 'Berhasil menyukai cerita ini'
            ]);
        }
    }
}