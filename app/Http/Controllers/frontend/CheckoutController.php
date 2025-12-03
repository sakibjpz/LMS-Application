<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{


    public function index(Request $request)
    {
        $guestToken = $request->cookie('guest_token') ?? Str::uuid();
        $cart = Cart::with('course')->where('guest_token', $guestToken)->get();
        // Calculate the total
        $total = $cart->sum(function ($item) {
            return $item->course->discount_price ?? $item->course->selling_price;
        });
        $user = Auth::user();
        return view('frontend.pages.checkout.index', compact('cart', 'total', 'user'));
    }


    public function demoPayment(Request $request)
{

      // Guard: require authenticated user for demo payment
        $user = Auth::user();
        if (! $user) {
            return redirect()->route('login')->with('error', 'Please log in to complete payment (demo).');
        }
    $user = Auth::user();
    $guestToken = $request->cookie('guest_token') ?? \Str::uuid();
    $cartItems = Cart::with('course')->where('guest_token', $guestToken)->get();

    if ($cartItems->isEmpty()) {
        return redirect()->back()->with('error', 'Your cart is empty.');
    }

    $total = $cartItems->sum(fn($item) => $item->course->discount_price ?? $item->course->selling_price);

    // 1️⃣ Create order
    $order = \App\Models\Order::create([
        'user_id' => $user->id,
        'total_amount' => $total,
        'status' => 'paid', // demo
    ]);

    // 2️⃣ Create order items
    foreach ($cartItems as $item) {
        \App\Models\OrderItem::create([
            'order_id' => $order->id,
            'course_id' => $item->course->id,
            'price' => $item->course->discount_price ?? $item->course->selling_price,
        ]);
    }

    // 3️⃣ Clear cart
    Cart::where('guest_token', $guestToken)->delete();

    return redirect()->route('user.dashboard')->with('success', 'Order completed successfully (Demo).');
}



}
