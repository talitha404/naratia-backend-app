<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StoryContent extends Model
{
    use HasFactory;

    protected $table = 'story_contents';

    protected $fillable = [
        'story_id',
        'chapter_number',
        'title',
        'content',
    ];

    /**
     * Relasi ke Story
     */
    public function story()
    {
        return $this->belongsTo(Story::class);
    }
}