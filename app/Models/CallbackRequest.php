<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CallbackRequest extends Model
{
    use HasFactory;

    // Allow mass assignment for these fields
    protected $fillable = [
        'name',
        'phone',
        'course_id',
        'date',
        'time',
    ];

   
    public function course()
{
    return $this->belongsTo(Course::class, 'course_id');
}
}
