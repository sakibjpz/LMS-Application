<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PaymentAttempt;
use App\Models\OrderItem;
use App\Models\Course;
use App\Models\User;

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

    // Payment attempts (you already had this)
    public function attempts()
    {
        return $this->hasMany(PaymentAttempt::class);
    }

    // New: each order has many items (courses)
   public function orderItems()
{
    return $this->hasMany(OrderItem::class);
}


    // New: directly access purchased courses
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'order_items');
    }

    // Order belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
