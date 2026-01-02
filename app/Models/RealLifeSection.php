<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RealLifeSection extends Model
{
    protected $table = 'real_life_sections';
    
    protected $fillable = [
        'title',
        'description',
        'image',
        'button_text',
        'button_link',
        'is_active',
        'display_order'
    ];
    
    protected $casts = [
        'is_active' => 'boolean'
    ];
    
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
    
    public function scopeOrdered($query)
    {
        return $query->orderBy('display_order')->orderBy('created_at');
    }
    
    // Check if button should be shown
    public function hasButton()
    {
        return !empty($this->button_text) && !empty($this->button_link);
    }
}