<?php

namespace App\Repositories;

use App\Models\Cart;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class CartRepository
{
    public function createCart($course_id, $request)
    {
        try {
            // Retrieve or generate guest_token
            $guestToken = $request->cookie('guest_token') ?? Str::uuid();

            // Set the guest_token cookie if not already set
            if (!$request->cookie('guest_token')) {
                Cookie::queue('guest_token', $guestToken, 60 * 24 * 30); // 30 days
            }

            // Check if the course is already in the cart for this guest_token
            $existingCart = Cart::where('guest_token', $guestToken)
                ->where('course_id', $course_id)
                ->first();

            if ($existingCart) {
                // Redirect back with error message instead of JSON
                return redirect()->back()->with('error', 'This course is already in your cart.');
            }

            // Add course to the cart
            Cart::create([
                'guest_token' => $guestToken,
                'course_id' => $course_id,
            ]);

            // Redirect back with success message instead of JSON
            return redirect()->back()->with('success', 'Course added to cart successfully!');

        } catch (\Exception $error) {
            // Redirect back with exception message instead of JSON
            return redirect()->back()->with('error', 'Something went wrong! ' . $error->getMessage());
        }
    }

    public function viewCart($request)
    {
        try {
            // Retrieve or generate guest_token
            $guestToken = $request->cookie('guest_token') ?? Str::uuid();
            $cart = Cart::where('guest_token', $guestToken)
                        ->with('course', 'course.user')
                        ->get();

            return $cart;

        } catch (\Exception $error) {
            // Optional: you can redirect or return empty collection if needed
            return collect(); // return empty collection on error
        }
    }
}
