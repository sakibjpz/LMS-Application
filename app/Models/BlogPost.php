<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BlogPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'author',
        'category',
        'tags',
        'views',
        'read_time',
        'is_published',
        'is_featured',
        'published_at',
        'meta_title',
        'meta_description',
        'meta_keywords'
    ];

    protected $casts = [
        'tags' => 'array',
        'is_published' => 'boolean',
        'is_featured' => 'boolean',
        'published_at' => 'datetime'
    ];

    // Relationship with blog images
    public function images()
    {
        return $this->hasMany(BlogImage::class)->orderBy('display_order');
    }

    // Scope for published posts
    public function scopePublished($query)
    {
        return $query->where('is_published', true)
                     ->whereNotNull('published_at')
                     ->where('published_at', '<=', now());
    }

    // Scope for featured posts
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    // Scope for recent posts
    public function scopeRecent($query, $limit = 5)
    {
        return $query->orderBy('published_at', 'desc')->limit($limit);
    }

    // Get related posts by category
    public function relatedPosts($limit = 3)
    {
        return self::where('category', $this->category)
                   ->where('id', '!=', $this->id)
                   ->published()
                   ->limit($limit)
                   ->get();
    }

    // Generate read time
    public function calculateReadTime()
    {
        $wordCount = str_word_count(strip_tags($this->content));
        $this->read_time = ceil($wordCount / 200); // 200 words per minute
        $this->save();
    }
}