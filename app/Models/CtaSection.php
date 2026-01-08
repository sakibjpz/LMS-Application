<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CtaSection extends Model
{
    protected $fillable = [
        'ribbon_text',
        'main_text',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}