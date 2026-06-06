<?php

namespace App\Http\Controllers;

use App\Models\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoryController extends Controller
{
    /**
     * 📌 Create Story (Draft)
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'genre_id' => 'nullable|exists:genres,genre_id',
            'description' => 'nullable|string',
        ]);

        $story = Story::create([
            'title' => $request->title,
            'description' => $request->description ?? null,
            'genre_id' => $request->genre_id ?? null,
            'user_id' => Auth::id(),
            'status' => 'draft',
        ]);

        return response()->json([
            'message' => 'Story created',
            'data' => $story
        ], 201);
    }

    /**
     * 📌 Upload Cover (endpoint terpisah)
     */
    public function uploadCover(Request $request, int $id)
    {
        $request->validate([
            'cover' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $story = Story::findOrFail($id);

        // optional: pastikan user hanya bisa edit miliknya
        if ($story->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $path = $request->file('cover')->store('covers', 'public');

        $story->cover_url = $path;
        $story->save();

        return response()->json([
            'message' => 'Cover uploaded',
            'data' => $story
        ]);
    }

    /**
     * 📌 Publish Story
     */
    public function publish(int $id)
    {
        $story = Story::findOrFail($id);

        if ($story->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $story->status = 'published';
        $story->save();

        return response()->json([
            'message' => 'Story published',
            'data' => $story
        ]);
    }

    /**
     * 📌 Ambil semua story milik user (draft + published)
     */
    public function myStories()
    {
        $stories = Story::where('user_id', Auth::id())
                        ->latest()
                        ->get();

        return response()->json($stories);
    }

    /**
     * 📌 Ambil draft saja
     */
    public function drafts()
    {
        $stories = Story::where('user_id', Auth::id())
                        ->where('status', 'draft')
                        ->latest()
                        ->get();

        return response()->json($stories);
    }

    /**
     * 📌 Ambil published saja
     */
    public function published()
{
    // Ini akan mengambil SEMUA data, tidak peduli statusnya apa
    $stories = Story::latest()->get(); 

    return response()->json($stories);
}

    /**
     * 📌 Detail Story
     */
    public function show(int $id)
    {
        $story = Story::with(['contents', 'genre', 'user'])
                      ->findOrFail($id);

        return response()->json($story);
    }
    
    public function updateStatus(Request $request, int $id)
{
    $request->validate([
        'status' => 'required|in:draft,published',
    ]);

    $story = Story::findOrFail($id);
    $story->status = $request->status;
    $story->save();

    return response()->json([
        'message' => 'Status updated',
        'data' => $story
    ]);
}

}