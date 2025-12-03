<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DemoPaymentController extends Controller
{
    public function pay(Request $request)
    {
        $user = Auth::user();
        if (!$user) return redirect()->route('login');

        $courseIds = $request->course_ids; // array []

        if (empty($courseIds)) {
            return back()->with('error','No courses selected.');
        }

        // 1. Create order
        $order = Order::create([
            'user_id' => $user->id,
            'total_amount' => 0,
            'currency' => 'BDT',
            'status' => 'paid',   // demo success
            'metadata' => null,
        ]);

        $total = 0;

        // 2. Add order items
        foreach ($courseIds as $cid) {
            $course = Course::find($cid);

            if (!$course) continue;

            OrderItem::create([
                'order_id' => $order->id,
                'course_id' => $cid,
                'price' => $course->price,
            ]);

            $total += $course->price;
        }

        // Update total
        $order->update(['total_amount' => $total]);

        return redirect()->route('user.dashboard')
               ->with('success','Demo payment successful!');
    }
}
