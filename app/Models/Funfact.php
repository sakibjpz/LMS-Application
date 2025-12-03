<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Funfact extends Model
{
    // The table associated with the model (optional if table name is 'funfacts')
    protected $table = 'funfacts';

    // Fields that can be mass-assigned
    protected $fillable = [
        'title',
        'value',
        'svg_icon',
        'color_class',
        'sort_order',
        'is_active',
    ];
}
