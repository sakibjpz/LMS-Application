@extends('frontend.master')

@section('content')
<!-- Trainer Header -->
<section class="breadcrumb-area bg-gradient py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-4 text-center">
                <!-- Trainer Photo -->
                <div class="trainer-main-photo mb-4">
                    @if($trainer->photo)
                        <img src="{{ asset('storage/' . $trainer->photo) }}" 
                             class="rounded-circle shadow-lg"
                             alt="{{ $trainer->name }}"
                             width="200" height="200">
                    @else
                        <div class="rounded-circle bg-light d-flex align-items-center justify-content-center mx-auto shadow-lg"
                             style="width: 200px; height: 200px;">
                            <i class="la la-user la-4x text-muted"></i>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-lg-8">
                <div class="trainer-header-content">
                    <h1 class="text-white mb-2">{{ $trainer->name }}</h1>
                    <p class="text-white-50 mb-3">
                        <i class="la la-book mr-2"></i>
                        {{ $courses->count() }} Courses Created
                    </p>
                    
                    @if($trainer->bio)
                        <p class="text-white mb-4">{{ $trainer->bio }}</p>
                    @endif
                    
                    <!-- Contact Info -->
                    <div class="trainer-contact-info">
                        @if($trainer->email)
                        <a href="mailto:{{ $trainer->email }}" class="text-white mr-4">
                            <i class="la la-envelope mr-1"></i> {{ $trainer->email }}
                        </a>
                        @endif
                        
                        @if($trainer->phone)
                        <a href="tel:{{ $trainer->phone }}" class="text-white">
                            <i class="la la-phone mr-1"></i> {{ $trainer->phone }}
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Trainer Details -->
<section class="trainer-details-section py-5">
    <div class="container">
        <div class="row">
            <!-- Left Column: About Trainer -->
            <div class="col-lg-8">
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h4 class="card-title mb-4">About the Trainer</h4>
                        
                        @if($trainer->bio)
                            <div class="trainer-bio">
                                <p>{{ $trainer->bio }}</p>
                            </div>
                        @else
                            <p class="text-muted">No biography available for this trainer.</p>
                        @endif
                        
                        <!-- Additional Info -->
                        <div class="row mt-4">
                            @if($trainer->address)
                            <div class="col-md-6 mb-3">
                                <h6><i class="la la-map-marker text-primary mr-2"></i> Location</h6>
                                <p class="text-muted">{{ $trainer->address }}</p>
                            </div>
                            @endif
                            
                            <div class="col-md-6 mb-3">
                                <h6><i class="la la-graduation-cap text-primary mr-2"></i> Expertise</h6>
                                <p class="text-muted">Professional Instructor</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Right Column: Stats & Contact -->
            <div class="col-lg-4">
                <!-- Stats Card -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body text-center">
                        <h5 class="card-title mb-4">Training Statistics</h5>
                        
                        <div class="trainer-stats">
                            <div class="stat-item mb-3">
                                <h2 class="text-primary">{{ $courses->count() }}</h2>
                                <p class="text-muted mb-0">Courses Created</p>
                            </div>
                            
                            <div class="stat-item mb-3">
                                <h2 class="text-primary">4.8</h2>
                                <p class="text-muted mb-0">Average Rating</p>
                            </div>
                            
                            <div class="stat-item">
                                <h2 class="text-primary">2K+</h2>
                                <p class="text-muted mb-0">Students Taught</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Contact Card -->
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Contact Trainer</h5>
                        
                        @if($trainer->email)
                        <div class="contact-item mb-3">
                            <i class="la la-envelope text-primary mr-2"></i>
                            <a href="mailto:{{ $trainer->email }}">{{ $trainer->email }}</a>
                        </div>
                        @endif
                        
                        @if($trainer->phone)
                        <div class="contact-item mb-3">
                            <i class="la la-phone text-primary mr-2"></i>
                            <a href="tel:{{ $trainer->phone }}">{{ $trainer->phone }}</a>
                        </div>
                        @endif
                        
                        <button class="btn btn-primary btn-block mt-3">
                            <i class="la la-envelope mr-2"></i> Send Message
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Courses Section -->
        @if($courses->count() > 0)
        <div class="row mt-5">
            <div class="col-lg-12">
                <div class="section-heading">
                    <h2 class="section__title">Courses by {{ $trainer->name }}</h2>
                    <p class="section__desc">Explore all courses created by this instructor</p>
                </div>
                
                <div class="row mt-4">
                    @foreach($courses as $course)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card course-card shadow-sm h-100">
                            @if($course->course_image)
                                <img src="{{ asset('storage/' . $course->course_image) }}" 
                                     class="card-img-top"
                                     alt="{{ $course->course_title }}"
                                     style="height: 180px; object-fit: cover;">
                            @else
                                <div class="card-img-top bg-light d-flex align-items-center justify-content-center"
                                     style="height: 180px;">
                                    <i class="la la-book la-3x text-muted"></i>
                                </div>
                            @endif
                            
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="{{ route('course-details', $course->id) }}" class="text-dark">
                                        {{ $course->course_title }}
                                    </a>
                                </h5>
                                
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
                                   class="btn btn-outline-primary btn-sm btn-block">
                                    View Course
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif
    </div>
</section>

<style>
.breadcrumb-area.bg-gradient {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.trainer-main-photo img {
    border: 5px solid white;
    object-fit: cover;
}

.trainer-contact-info a {
    text-decoration: none;
}

.trainer-contact-info a:hover {
    text-decoration: underline;
}

.trainer-stats .stat-item {
    padding: 15px 0;
    border-bottom: 1px solid #f0f0f0;
}

.trainer-stats .stat-item:last-child {
    border-bottom: none;
}

.contact-item a {
    color: #333;
    text-decoration: none;
}

.contact-item a:hover {
    color: #0066cc;
    text-decoration: underline;
}

.course-card {
    transition: transform 0.3s ease;
}

.course-card:hover {
    transform: translateY(-5px);
}
</style>
@endsection