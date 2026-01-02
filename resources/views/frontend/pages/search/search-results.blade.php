@extends('frontend.master')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-12">
            <!-- Search Header -->
            <div class="search-header mb-4">
                <h1 class="h3 mb-3">Search Results</h1>
                <p class="text-muted">
                    @if($courses->count() > 0)
                        Found {{ $courses->count() }} course(s) for "<strong>{{ $query }}</strong>"
                    @else
                        No courses found for "<strong>{{ $query }}</strong>"
                    @endif
                </p>
            </div>

            <!-- Search Results -->
            @if($courses->count() > 0)
                <div class="row">
                    @foreach($courses as $course)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card course-card shadow-sm h-100">
                            <!-- Course Image -->
                            @if($course->course_image)
                                <img src="{{ asset('storage/' . $course->course_image) }}" 
                                     class="card-img-top" 
                                     alt="{{ $course->course_title }}"
                                     style="height: 200px; object-fit: cover;">
                            @else
                                <div class="card-img-top bg-light d-flex align-items-center justify-content-center" 
                                     style="height: 200px;">
                                    <i class="la la-book la-3x text-muted"></i>
                                </div>
                            @endif

                            <div class="card-body">
                                <!-- Course Title -->
                                <h5 class="card-title">
                                    <a href="{{ route('course-details', $course->id) }}" 
                                       class="text-dark">
                                        {{ $course->course_title }}
                                    </a>
                                </h5>

                                <!-- Instructor -->
                                @if($course->user)
                                <p class="text-muted mb-2">
                                    <small>
                                        <i class="la la-user"></i> 
                                        {{ $course->user->name }}
                                    </small>
                                </p>
                                @endif

                                <!-- Price -->
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    @if($course->discount_price)
                                        <span class="h5 text-primary mb-0">
                                            ${{ $course->discount_price }}
                                        </span>
                                        <span class="text-muted text-decoration-line-through">
                                            ${{ $course->selling_price }}
                                        </span>
                                    @else
                                        <span class="h5 text-primary mb-0">
                                            ${{ $course->selling_price ?? 'Free' }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="card-footer bg-white border-top-0">
                                <a href="{{ route('course-details', $course->id) }}" 
                                   class="btn btn-primary btn-sm btn-block">
                                    View Course
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <!-- No Results -->
                <div class="text-center py-5">
                    <div class="mb-4">
                        <i class="la la-search la-4x text-muted"></i>
                    </div>
                    <h4 class="text-muted">No courses found</h4>
                    <p class="text-muted">Try different keywords or browse our courses</p>
                    <a href="{{ route('courses.all') }}" class="btn btn-primary">
                        Browse All Courses
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection