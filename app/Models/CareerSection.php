<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CareerSection extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'first_btn_text',
        'second_btn_text',
        'is_active'
    ];
}