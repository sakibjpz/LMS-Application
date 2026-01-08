<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CallbackRequest;
use App\Models\Course;

class CallbackController extends Controller
{
    // Show the callback form with courses
    public function index()
    {
        $courses = Course::where('status', 1)->get();
        return view('frontend.section.callback', compact('courses'));
    }

    // Handle callback form submission
    public function store(Request $request)
{
    // Validate input
    $request->validate([
        'name'      => 'required|string|max:255',
        'phone'     => 'required|string|max:20',
        'course_id' => 'required|integer|exists:courses,id',
        'date'      => 'required|string|max:255',
        'time'      => 'required|string|max:255',
        'message'   => 'nullable|string|max:1000',
    ]);

    // Save to database
    CallbackRequest::create($request->only('name', 'phone', 'course_id', 'date', 'time', 'message'));

    // Redirect back with success message
    return back()->with('success', 'Your callback request has been submitted!');
}
}
