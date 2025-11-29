@extends('frontend.master')

@section('content')

<div class="container my-5">

    <h2 class="mb-4">All Courses</h2>

    <div class="row">

        @foreach ($courses as $course)
        
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden">

                {{-- Course Image --}}
                <div style="height: 180px; overflow: hidden;">
                    <img src="{{ asset($course->course_image) }}" 
                         class="w-100" 
                         style="object-fit: cover; height: 100%;"
                         alt="{{ $course->title }}">
                </div>

                <div class="card-body">

                    {{-- Course Title --}}
                    <h5 class="card-title fw-bold">{{ Str::limit($course->title, 50) }}</h5>

                    {{-- Category + Subcategory --}}
                    <p class="text-muted mb-2">
                        {{ $course->category->name ?? 'No Category' }}
                        @if($course->subCategory)
                            • {{ $course->subCategory->name }}
                        @endif
                    </p>

                    {{-- Instructor (optional) --}}
                    @if(isset($course->instructor))
                    <p class="small mb-2">
                        <i class="bi bi-person"></i>
                        Instructor: {{ $course->instructor->name }}
                    </p>
                    @endif

                    {{-- Button --}}
            <a href="{{ route('course-details', $course->id) }}" 
   class="btn btn-primary w-100 mt-2">
    View Details
</a>


                </div>
            </div>
        </div>

        

        @endforeach

    <div class="d-flex justify-content-center mt-3">
    <nav>
        {{ $courses->links('pagination::bootstrap-5') }}
    </nav>
</div>

        

    </div>

</div>

@endsection
