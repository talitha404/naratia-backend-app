<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;

    protected $primaryKey = 'genre_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = ['name'];

    public function stories()
    {
        return $this->hasMany(Story::class);
    }
}
