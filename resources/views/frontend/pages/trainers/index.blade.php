@extends('frontend.master')

@section('content')
<!-- Hero Section -->
<section class="breadcrumb-area bg-gradient py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-content text-center">
                    <h1 class="text-white mb-3">Our Expert Trainers</h1>
                    <p class="text-white-50 mb-0">Professional instructors dedicated to your learning success</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Trainers Grid -->
<section class="trainers-section py-5">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-12">
                <div class="section-heading text-center">
                    <h2 class="section__title">Professional Instructors</h2>
                    <p class="section__desc">Learn from certified experts with industry experience</p>
                </div>
            </div>
        </div>

        @if($trainers->count() > 0)
            <div class="row">
                @foreach($trainers as $trainer)
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card trainer-card border-0 shadow-sm h-100">
                        <!-- Trainer Image -->
                        <div class="trainer-img-wrapper">
                            @if($trainer->photo)
    <img src="{{ asset($trainer->photo) }}" 
         class="card-img-top trainer-img"
         alt="{{ $trainer->name }}">
@else

                                <div class="trainer-placeholder d-flex align-items-center justify-content-center">
                                    <i class="la la-user la-4x text-light"></i>
                                </div>
                            @endif
                            <div class="trainer-overlay">
                                <a href="{{ route('trainer.details', $trainer->id) }}" class="btn btn-light btn-sm">View Profile</a>
                            </div>
                        </div>

                        <div class="card-body text-center p-4">
                            <!-- Trainer Name -->
                            <h5 class="card-title mb-1">{{ $trainer->name }}</h5>
                            
                            <!-- Trainer Bio -->
                            <p class="text-muted mb-3">
                                <small>
                                    @if($trainer->bio)
                                        {{ Str::limit($trainer->bio, 80) }}
                                    @else
                                        Certified Professional Instructor
                                    @endif
                                </small>
                            </p>
                            
                            <!-- Course Count -->
                            <div class="trainer-courses mb-3">
                                <span class="badge badge-primary bg-primary">
                                    <i class="la la-book mr-1"></i>
                                    {{ $trainer->courses()->count() }} Courses
                                </span>
                            </div>
                            
                            <!-- View Profile Button -->
                            <a href="{{ route('trainer.details', $trainer->id) }}" class="btn btn-outline-primary btn-sm">
                                View Full Profile
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <!-- No Trainers Message -->
            <div class="text-center py-5">
                <div class="mb-4">
                    <i class="la la-users la-4x text-muted"></i>
                </div>
                <h4 class="text-muted">No Trainers Available</h4>
                <p class="text-muted">Our expert instructors will be listed here soon</p>
            </div>
        @endif
    </div>
</section>

<style>
.breadcrumb-area.bg-gradient {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.trainer-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border-radius: 10px;
    overflow: hidden;
}

.trainer-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
}

.trainer-img-wrapper {
    position: relative;
    overflow: hidden;
    height: 220px;
}

.trainer-img, .trainer-placeholder {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.trainer-placeholder {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.trainer-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.5);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.trainer-img-wrapper:hover .trainer-overlay {
    opacity: 1;
}

.trainer-courses .badge {
    font-size: 0.85rem;
    padding: 5px 12px;
    border-radius: 20px;
}
</style>
@endsection