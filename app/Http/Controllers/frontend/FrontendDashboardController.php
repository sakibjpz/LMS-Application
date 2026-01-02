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
use App\Models\Benefit;
use App\Models\CallbackOption;
use App\Models\Testimonial;



class FrontendDashboardController extends Controller
{
   public function home()
{
    $all_sliders = Slider::all();
    $all_info = InfoBox::all();

    // $all_categories = Category::inRandomOrder()->limit(6)->get();
    // $categories = Category::all();
    // $course_category = Category::with('course', 'course.user', 'course.course_goal')->get();

    // 🔥 Load all benefits from DB
    $benefits = Benefit::all();

    $courses = Course::all();

    // ✅ Fetch all testimonials from DB
    $testimonials = Testimonial::all();
    
    // ✅ Fetch active Real Life Section
    $realLifeSection = \App\Models\RealLifeSection::active()->first();

    return view(
        'frontend.index',
        compact('all_sliders', 'all_info',  'benefits', 'courses', 'testimonials', 'realLifeSection')
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

public function search(Request $request)
{
    $query = $request->input('query');
    
    $courses = Course::where('course_title', 'LIKE', "%{$query}%")
                     ->orWhere('course_name', 'LIKE', "%{$query}%")
                     ->orWhere('description', 'LIKE', "%{$query}%")
                     ->get();
    
    return view('frontend.pages.search.search-results', compact('courses', 'query'));
}

public function autocomplete(Request $request)
{
    $query = $request->input('query');
    
    if (strlen($query) < 2) {
        return response()->json([]);
    }
    
    $courses = Course::where('course_title', 'LIKE', "%{$query}%")
                     ->orWhere('course_name', 'LIKE', "%{$query}%")
                     ->limit(10)
                     ->get(['id', 'course_title', 'course_image']);
    
    return response()->json($courses);
}


public function trainers()
{
    // Get all users with role 'instructor'
    $trainers = \App\Models\User::where('role', 'instructor')->get();
    
    // Debug: Check what we're getting
    \Log::info('Trainers found: ' . $trainers->count());
    \Log::info('Trainers: ' . $trainers->pluck('name'));
    
    return view('frontend.pages.trainers.index', compact('trainers'));
}

public function trainerDetails($id)
{
    $trainer = \App\Models\User::where('role', 'instructor')
                               ->where('id', $id)
                               ->firstOrFail();
    
    $courses = $trainer->courses()->where('status', 1)->get();
    
    return view('frontend.pages.trainers.details', compact('trainer', 'courses'));
}

public function itDepartment()
{
    $members = \App\Models\ItDepartment::active()->ordered()->get();
    return view('frontend.pages.it-department.index', compact('members'));
}

public function administration()
{
    $members = \App\Models\Administration::active()->ordered()->get();
    return view('frontend.pages.administration.index', compact('members'));
}



public function blog()
{
    $posts = \App\Models\BlogPost::published()
                                 ->orderBy('published_at', 'desc')
                                 ->paginate(6);
    
    $featuredPosts = \App\Models\BlogPost::published()
                                        ->featured()
                                        ->recent(3)
                                        ->get();
    
    $categories = \App\Models\BlogPost::published()
                                     ->select('category')
                                     ->distinct()
                                     ->pluck('category');
    
    return view('frontend.pages.blog.index', compact('posts', 'featuredPosts', 'categories'));
}

public function blogDetails($slug)
{
    $post = \App\Models\BlogPost::where('slug', $slug)
                                ->published()
                                ->firstOrFail();
    
    // Increment views
    $post->increment('views');
    
    $relatedPosts = $post->relatedPosts(3);
    $recentPosts = \App\Models\BlogPost::published()
                                      ->where('id', '!=', $post->id)
                                      ->recent(5)
                                      ->get();
    
    return view('frontend.pages.blog.details', compact('post', 'relatedPosts', 'recentPosts'));
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
                                        ->with('course_lectures')
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
