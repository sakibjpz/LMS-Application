<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function proceed()
    {
        // Return the new proceed page view
        return view('frontend.proceed');
    }
}
