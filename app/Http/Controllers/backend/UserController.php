<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Dashboard
    public function dashboard()
    {
        $user = Auth::user();               // get logged-in user
      $purchasedCourses = $user->purchasedCourses()->get();


        return view('backend.user.index', compact('user', 'purchasedCourses'));
    }

    // Logout
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
    public function myCourses()
{
    $user = Auth::user();

    // All purchased courses
 $courses = $user->purchasedCourses()
                ->with(['course_goal', 'course_sections.course_lectures'])
                ->get();



    return view('backend.user.my-courses', compact('courses'));
}

public function learn($id)
{
    $user = Auth::user();

    // If user is not logged in, redirect to login page
    if (! $user) {
        return redirect()->route('login');
    }

    // Fetch the course only if the user purchased it
    $course = $user->purchasedCourses()
                   ->with(['course_goal', 'course_sections.course_lectures'])
                   ->findOrFail($id);

    return view('backend.user.learn', compact('course'));
}





}
