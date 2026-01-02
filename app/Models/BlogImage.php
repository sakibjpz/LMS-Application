<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BlogImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'blog_post_id',
        'image_path',
        'caption',
        'display_order'
    ];

    // Relationship with blog post
    public function post()
    {
        return $this->belongsTo(BlogPost::class, 'blog_post_id');
    }
}