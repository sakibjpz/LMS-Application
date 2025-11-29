<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PaymentAttempt;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'total_amount',
        'currency',
        'status',
        'metadata'
    ];

    protected $casts = [
        'metadata' => 'array'
    ];

    public function attempts()
    {
        return $this->hasMany(PaymentAttempt::class);
    }
}
