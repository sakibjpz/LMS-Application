<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CallbackRequest;
use App\Models\Course;

class CallbackController extends Controller
{
    // Show all callback requests
    public function index()
    {
       // Fetch all requests with related course
    $callbacks = CallbackRequest::with('course')->orderBy('created_at', 'desc')->get();

    return view('backend.admin.callback.index', compact('callbacks'));
    }
}
