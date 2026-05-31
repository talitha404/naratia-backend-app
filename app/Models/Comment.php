<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function story()
    {
        return $this->belongsTo(Story::class);
    }

    // komentar parent (nested)
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    // komentar balasan
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }
}
