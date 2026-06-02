<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Story extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'cover_url',
        'genre_id',
        'user_id',
        'status',
    ];

    protected $casts = [
        'status' => 'string',
    ];

    /**
     * Relasi ke User (penulis)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke Genre
     */
    public function genre()
    {
        return $this->belongsTo(Genre::class, 'genre_id', 'genre_id');
    }

    /**
     * Relasi ke Content
     */
    public function contents()
    {
        return $this->hasMany(StoryContent::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }

    /**
     * Helper: cek apakah published
     */
    public function isPublished()
    {
        return $this->status === 'published';
    }
}