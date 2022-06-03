<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $primaryKey = 'post_id';
    protected $fillable = [
        'title',
        'body',
        'category_id',
        'user_id',
        'image_path'
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class, "post_id");
    }
}
