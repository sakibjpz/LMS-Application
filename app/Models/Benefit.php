<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Benefit extends Model
{
    // allow mass assignment for these fields
    protected $fillable = [
        'icon',
        'title',
        'description',
        'icon_class',
        'sort_order',
        'is_active',
    ];

    // if you want to cast is_active to boolean
    protected $casts = [
        'is_active' => 'boolean',
    ];
}
