@extends('frontend.master')

@section('content')
<!-- Hero Section -->
<section class="breadcrumb-area bg-gradient py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-content text-center">
                    <h1 class="text-white mb-3">IT Department</h1>
                    <p class="text-white-50 mb-0">Meet our expert IT team dedicated to technological excellence</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- IT Team Section -->
<section class="it-team-section py-5">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-12">
                <div class="section-heading text-center">
                    <h2 class="section__title">Our IT Experts</h2>
                    <p class="section__desc">Professional team ensuring seamless technological infrastructure</p>
                </div>
            </div>
        </div>

        @if($members->count() > 0)
            <div class="row">
                @foreach($members as $member)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card team-member-card border-0 shadow-sm h-100">
                        <!-- Member Image -->
                        <div class="member-img-wrapper">
                            @if($member->photo)
                                <img src="{{ asset('storage/' . $member->photo) }}" 
                                     class="card-img-top member-img"
                                     alt="{{ $member->name }}">
                            @else
                                <div class="member-placeholder d-flex align-items-center justify-content-center">
                                    <i class="la la-user la-4x text-light"></i>
                                </div>
                            @endif
                            <div class="member-overlay">
                                <div class="social-links">
                                    @if($member->social_links)
                                        @if(isset($member->social_links['linkedin']))
                                        <a href="{{ $member->social_links['linkedin'] }}" target="_blank" class="social-link">
                                            <i class="la la-linkedin"></i>
                                        </a>
                                        @endif
                                        @if(isset($member->social_links['github']))
                                        <a href="{{ $member->social_links['github'] }}" target="_blank" class="social-link">
                                            <i class="la la-github"></i>
                                        </a>
                                        @endif
                                        @if(isset($member->social_links['twitter']))
                                        <a href="{{ $member->social_links['twitter'] }}" target="_blank" class="social-link">
                                            <i class="la la-twitter"></i>
                                        </a>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="card-body text-center p-4">
                            <!-- Member Name -->
                            <h5 class="card-title mb-1">{{ $member->name }}</h5>
                            
                            <!-- Position -->
                            <p class="text-primary mb-2">{{ $member->position }}</p>
                            
                            <!-- Expertise -->
                            @if($member->expertise)
                            <div class="expertise mb-3">
                                <span class="badge badge-light">{{ $member->expertise }}</span>
                            </div>
                            @endif
                            
                            <!-- Experience -->
                            @if($member->experience_years)
                            <div class="experience mb-3">
                                <i class="la la-clock text-muted mr-1"></i>
                                <small class="text-muted">{{ $member->experience_years }}+ years experience</small>
                            </div>
                            @endif
                            
                            <!-- Bio -->
                            @if($member->bio)
                            <p class="text-muted mb-3">
                                <small>{{ Str::limit($member->bio, 100) }}</small>
                            </p>
                            @endif
                            
                            <!-- Contact Info -->
                            <div class="contact-info">
                                @if($member->email)
                                <div class="contact-item mb-1">
                                    <i class="la la-envelope text-muted mr-1"></i>
                                    <small><a href="mailto:{{ $member->email }}">{{ $member->email }}</a></small>
                                </div>
                                @endif
                                
                                @if($member->phone)
                                <div class="contact-item">
                                    <i class="la la-phone text-muted mr-1"></i>
                                    <small><a href="tel:{{ $member->phone }}">{{ $member->phone }}</a></small>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <!-- No Members Message -->
            <div class="text-center py-5">
                <div class="mb-4">
                    <i class="la la-users la-4x text-muted"></i>
                </div>
                <h4 class="text-muted">IT Team Coming Soon</h4>
                <p class="text-muted">Our IT experts will be listed here soon</p>
            </div>
        @endif
    </div>
</section>

<style>
.breadcrumb-area.bg-gradient {
    background: linear-gradient(135deg, #0066cc 0%, #0099ff 100%);
}

.team-member-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border-radius: 10px;
    overflow: hidden;
}

.team-member-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
}

.member-img-wrapper {
    position: relative;
    overflow: hidden;
    height: 250px;
}

.member-img, .member-placeholder {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.member-placeholder {
    background: linear-gradient(135deg, #0066cc 0%, #0099ff 100%);
}

.member-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,102,204,0.8);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.member-img-wrapper:hover .member-overlay {
    opacity: 1;
}

.social-links {
    display: flex;
    gap: 15px;
}

.social-link {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    background: white;
    border-radius: 50%;
    color: #0066cc;
    font-size: 18px;
    transition: transform 0.3s ease;
}

.social-link:hover {
    transform: scale(1.1);
    color: #004d99;
}

.expertise .badge {
    font-size: 0.8rem;
    padding: 5px 10px;
    background-color: #f0f7ff;
    color: #0066cc;
    font-weight: normal;
}

.contact-item a {
    color: #666;
    text-decoration: none;
}

.contact-item a:hover {
    color: #0066cc;
    text-decoration: underline;
}
</style>
@endsection