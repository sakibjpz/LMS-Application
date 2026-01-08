<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // =======================================
    // 🔥 RELATIONSHIPS
    // =======================================

    // 1. All orders by user
    public function orders()
    {
        return $this->hasMany(\App\Models\Order::class, 'user_id', 'id');
    }

    // 2. User Cart
    public function cart()
    {
        return $this->hasMany(\App\Models\Cart::class, 'user_id', 'id');
    }

    // 3. User Wishlist
    // public function wishlist()
    // {
    //     return $this->hasMany(\App\Models\Wishlist::class, 'user_id', 'id');
    // }

    // 4. Courses taught by instructor
public function courses()
{
    return $this->hasMany(\App\Models\Course::class, 'instructor_id');
}

    // 5. Purchased Courses (clean version)
public function purchasedCourses()
{
    return Course::whereHas('orders', function ($query) {
        $query->where('user_id', $this->id)
              ->where('status', 'paid');
    });
}



    // =======================================
    // ROLE HELPERS
    // =======================================

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isInstructor()
    {
        return $this->role === 'instructor';
    }

    public function isUser()
    {
        return $this->role === 'user';
    }

    // =======================================
    // ATTRIBUTE CASTING
    // =======================================

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function hasPurchased($courseId)
{
    return $this->purchasedCourses()
                ->where('courses.id', $courseId)
                ->exists();
}
}
