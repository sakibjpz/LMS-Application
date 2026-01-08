@extends('backend.user.master')

@section('content')

<div class="row mb-4">
    <!-- Enrolled Courses -->
    <div class="col-lg-4 responsive-column-half">
        <a href="{{ route('user.user.myCourses') }}" class="text-decoration-none text-dark">
            <div class="card card-item dashboard-info-card shadow-sm">
                <div class="card-body d-flex align-items-center">
                    <div class="icon-element flex-shrink-0 bg-1 text-white rounded-circle p-3">
                        <i class="la la-book fs-30"></i>
                    </div>
                    <div class="pl-4">
                        <p class="fs-18 mb-1">Enrolled Courses</p>
                        <h5 class="fs-26 mb-0">{{ $purchasedCourses->count() }}</h5>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <!-- Wishlist Courses -->
    {{-- <div class="col-lg-4 responsive-column-half">
        <div class="card card-item dashboard-info-card shadow-sm">
            <div class="card-body d-flex align-items-center">
                <div class="icon-element flex-shrink-0 bg-2 text-white rounded-circle p-3">
                    <i class="la la-heart-o fs-30"></i>
                </div>
                <div class="pl-4">
                    <p class="fs-18 mb-1">Wishlist Courses</p>
                    <h5 class="fs-26 mb-0">{{ $user->wishlist()->count() ?? 0 }}</h5>
                </div>
            </div>
        </div>
    </div> --}}
</div>

<!-- ========================= -->
<!--     My Courses Grid       -->
<!-- ========================= -->
<h4 class="mb-3">Your Courses</h4>

<div class="row">
    @forelse($purchasedCourses as $course)
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card h-100 shadow-sm">

            <!-- Course Thumbnail (uniform size) -->
            <div class="ratio ratio-16x9">
                <img src="{{ $course->course_image }}" 
                     alt="{{ $course->course_title }}" 
                     class="card-img-top">
            </div>

            <div class="card-body d-flex flex-column">
                <h5 class="card-title">{{ $course->course_title }}</h5>
                
                <p class="text-muted small mb-2">
                    {{ $course->lectures_count ?? 0 }} Lessons
                </p>

                <!-- Progress Bar (optional if you track progress) -->
                @if(isset($course->progress))
                <div class="progress mb-2" style="height: 6px;">
                    <div class="progress-bar bg-success" role="progressbar"
                         style="width: {{ $course->progress }}%;" 
                         aria-valuenow="{{ $course->progress }}" 
                         aria-valuemin="0" aria-valuemax="100">
                    </div>
                </div>
                @endif

                <a href="{{ route('user.course.learn', $course->id) }}" 
                   class="btn btn-primary btn-sm mb-1">Continue Learning</a>
                <a href="{{ route('course-details', $course->id) }}" 
   class="btn btn-secondary btn-sm">Course Details</a>

            </div>
        </div>
    </div>
    @empty
        <div class="col-12">
            <div class="alert alert-info">You haven't enrolled in any course yet.</div>
        </div>
    @endforelse
</div>

@endsection

@push('scripts')
    {{-- <script src="{{ asset('customjs/user/wishlist.js') }}"></script> --}}
    <script src="{{ asset('customjs/cart/index.js') }}"></script>
@endpush
