<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\CourseLecture;
use App\Models\CourseSection;
use App\Models\InfoBox;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendDashboardController extends Controller
{
    // Home page
    public function home()
    {
        $all_sliders = Slider::all();
        $all_info = InfoBox::all();

        $all_categories = Category::inRandomOrder()->limit(6)->get();
        $categories = Category::all();
        $course_category = Category::with('course', 'course.user', 'course.course_goal')->get();

        return view(
            'frontend.index',
            compact('all_sliders', 'all_info', 'all_categories', 'categories', 'course_category')
        );
    }


    public function wishlist()
{
    $userId = auth()->id(); // logged-in user

    // Fetch wishlist items for this user
    $wishlistItems = Wishlist::where('user_id', $userId)
        ->with('course.user') // load related course + instructor
        ->get();

    return view('frontend.wishlist.index', compact('wishlistItems'));
}


    // Course details page
    public function view($id)
    {
        // Find course by ID safely
        $course = Course::with('category', 'subcategory', 'user')->findOrFail($id);

        // Total lectures
        $total_lecture = CourseLecture::where('course_id', $course->id)->count();

        // Course content sections
        $course_content = CourseSection::where('course_id', $course->id)
                                        ->with('lecture')
                                        ->get();

        // Get authenticated user ID (if any)
        $userId = Auth::id();

        // Similar courses in same category, excluding current course
        $similarCourses = Course::where('category_id', $course->category_id)
                                ->where('id', '!=', $course->id)
                                ->get();

        // All categories
        $all_category = Category::orderBy('name', 'asc')->get();

        // More courses by same instructor, excluding current course
        $more_course_instructor = Course::where('instructor_id', $course->instructor_id)
                                        ->where('id', '!=', $course->id)
                                        ->with('user')
                                        ->get();

        // Total lecture duration in minutes
        $total_minutes = CourseLecture::where('course_id', $course->id)->sum('video_duration');

        // Convert total minutes to H:M:S
        $hours = floor($total_minutes / 60);
        $minutes = floor($total_minutes % 60);
        $seconds = round(($total_minutes - floor($total_minutes)) * 60);

        $total_lecture_duration = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);

        return view(
            'frontend.pages.course-details.index',
            compact(
                'course',
                'total_lecture',
                'course_content',
                'similarCourses',
                'all_category',
                'more_course_instructor',
                'total_minutes',
                'total_lecture_duration'
            )
        );
    }
}
