<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItDepartment extends Model
{
    protected $table = 'it_department';
    
    protected $fillable = [
        'name',
        'position',
        'bio',
        'photo',
        'email',
        'phone',
        'expertise',
        'experience_years',
        'social_links',
        'display_order',
        'is_active'
    ];
    
    protected $casts = [
        'social_links' => 'array',
        'is_active' => 'boolean'
    ];
    
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
    
    public function scopeOrdered($query)
    {
        return $query->orderBy('display_order')->orderBy('name');
    }
}