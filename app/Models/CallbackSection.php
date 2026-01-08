<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CallbackSection extends Model
{
    protected $fillable = [
        'content_title',
        'content_description',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Scope to get only active sections
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}