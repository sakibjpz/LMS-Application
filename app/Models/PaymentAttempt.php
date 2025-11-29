<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentAttempt extends Model
{
    protected $fillable = [
        'order_id',
        'gateway',
        'gateway_transaction_id',
        'secure_token',
        'amount',
        'status',
        'raw_response'
    ];

    protected $casts = [
        'raw_response' => 'array'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
