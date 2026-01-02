<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Administration extends Model
{
    protected $table = 'administration';
    
    protected $fillable = [
        'name',
        'position',
        'department',
        'bio',
        'photo',
        'email',
        'phone',
        'office_location',
        'office_hours',
        'years_of_service',
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
    
    public function scopeByDepartment($query, $department)
    {
        return $query->where('department', $department);
    }
}