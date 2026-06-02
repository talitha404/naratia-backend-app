<?php

namespace App\Http\Controllers;

use App\Models\Story;
use App\Models\StoryContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContentController extends Controller
{
    
    // Create / Update Chapter
    public function store(Request $request)
    {
        $request->validate([
            'story_id' => 'required|exists:stories,id',
            'chapter_number' => 'required|integer|min:1',
            'title' => 'nullable|string|max:255',
            'content' => 'nullable|string',
        ]);

        $story = Story::findOrFail($request->story_id);

        // cek ownership
        if ($story->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        // update atau create berdasarkan chapter_number
        $chapter = StoryContent::updateOrCreate(
            [
                'story_id' => $story->id,
                'chapter_number' => $request->input('chapter_number'),
            ],
            [
                'title' => $request->input('title'),
                'content' => $request->input('content'), 
            ]
        );

        return response()->json([
            'message' => 'Chapter disimpan',
            'data' => $chapter
        ]);
    }
    
    // Ambil semua chapter dari story
    public function getByStory(int $storyId)
    {
        $chapters = StoryContent::where('story_id', $storyId)
                                ->orderBy('chapter_number')
                                ->get();

        return response()->json($chapters);
    }

     // Ambil 1 chapter
    public function show(int $id)
    {
        $chapter = StoryContent::findOrFail($id);

        if ($chapter->story->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return response()->json($chapter);
    }

    // List semua chapter dalam 1 story
    public function index(Story $story)
    {
        // optional: cek ownership
        if ($story->user_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $chapters = $story->contents()
            ->orderBy('chapter_number')
            ->get();

        return response()->json($chapters);
    }

    // Update chapter (opsional, karena store sudah handle)
    public function update(Request $request, int $id)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'content' => 'nullable|string',
        ]);

        $chapter = StoryContent::findOrFail($id);

        if ($chapter->story->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $chapter->update($request->only(['title', 'content']));

        return response()->json([
            'message' => 'Chapter diupdate',
            'data' => $chapter
        ]);
    }

    // Hapus chapter
    public function destroy(int $id)
    {
        $chapter = StoryContent::findOrFail($id);

        if ($chapter->story->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $chapter->delete();

        return response()->json([
            'message' => 'Chapter dihapus'
        ]);
    }
}