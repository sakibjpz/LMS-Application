<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseRequest;
use App\Models\Course;
use App\Models\CourseGoal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\CourseService;

class CourseController extends Controller
{
    protected $courseService;

    public function __construct(CourseService $courseService)
    {
        $this->courseService = $courseService;
    }

    public function index()
    {
        $instructor_id = Auth::user()->id;
        $all_courses = Course::where('instructor_id', $instructor_id)->latest()->get();
        return view('backend.instructor.course.index', compact('all_courses'));
    }

    public function create()
    {
        return view('backend.instructor.course.create');
    }

    public function store(CourseRequest $request)
    {
        $validatedData = $request->validated();
        $course = $this->courseService->createCourse($validatedData, $request->file('image'));

        // Manage Course Goal
        if (!empty($validatedData['course_goals'])) {
            $this->courseService->createCourseGoals($course->id, $validatedData['course_goals']);
        }

        return back()->with('success', 'Course created successfully!');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $course = Course::find($id);
        $course_goals = CourseGoal::where('course_id', $id)->get();
        return view('backend.instructor.course.edit', compact('course', 'course_goals'));
    }

    public function update(CourseRequest $request, string $id)
    {
        $validatedData = $request->validated();
        $course = $this->courseService->updateCourse($validatedData, $request->file('image'), $id);

        // Manage Course Goal
        if (!empty($validatedData['course_goals'])) {
            $this->courseService->updateCourseGoals($course->id, $validatedData['course_goals']);
        }

        return back()->with('success', 'Course updated successfully!');
    }

    public function destroy(string $id)
    {
        $course = Course::findOrFail($id);

        // Delete associated image if exists
        if ($course->image) {
            $imagePath = public_path(parse_url($course->course_image, PHP_URL_PATH));
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $course->delete();
        return redirect()->route('instructor.course.index')->with('success', 'Course deleted successfully.');
    }

    public function allCourses()
    {
        $courses = Course::latest()->paginate(6);
        return view('frontend.courses.all', compact('courses'));
    }

    public function learn($id)
    {
        $course = Course::with(['course_goal', 'course_sections', 'course_lectures'])
                        ->findOrFail($id);
        return view('backend.user.learn', compact('course'));
    }
}