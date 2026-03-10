<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'desc', 'preview_image'];
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}