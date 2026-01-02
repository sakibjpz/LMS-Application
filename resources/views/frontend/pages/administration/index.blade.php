@extends('frontend.master')

@section('content')
<!-- Hero Section -->
<section class="breadcrumb-area bg-gradient py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-content text-center">
                    <h1 class="text-white mb-3">Administration</h1>
                    <p class="text-white-50 mb-0">Meet our dedicated administrative team supporting your learning journey</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Administration Team Section -->
<section class="administration-section py-5">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-12">
                <div class="section-heading text-center">
                    <h2 class="section__title">Administrative Leadership</h2>
                    <p class="section__desc">Professional team ensuring smooth academic operations and student support</p>
                </div>
            </div>
        </div>

        @if($members->count() > 0)
            <div class="row">
                @foreach($members as $member)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card admin-member-card border-0 shadow-sm h-100">
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
                            
                            <!-- Position & Department -->
                            <p class="text-primary mb-1">{{ $member->position }}</p>
                            
                            @if($member->department)
                            <p class="text-muted mb-2">
                                <small>{{ $member->department }} Department</small>
                            </p>
                            @endif
                            
                            <!-- Years of Service -->
                            @if($member->years_of_service)
                            <div class="service-years mb-3">
                                <i class="la la-trophy text-warning mr-1"></i>
                                <small class="text-muted">{{ $member->years_of_service }}+ years of service</small>
                            </div>
                            @endif
                            
                            <!-- Office Info -->
                            @if($member->office_location || $member->office_hours)
                            <div class="office-info mb-3">
                                @if($member->office_location)
                                <div class="office-item mb-1">
                                    <i class="la la-map-marker text-muted mr-1"></i>
                                    <small class="text-muted">{{ $member->office_location }}</small>
                                </div>
                                @endif
                                @if($member->office_hours)
                                <div class="office-item">
                                    <i class="la la-clock text-muted mr-1"></i>
                                    <small class="text-muted">{{ $member->office_hours }}</small>
                                </div>
                                @endif
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
                <h4 class="text-muted">Administration Team Coming Soon</h4>
                <p class="text-muted">Our administrative team will be listed here soon</p>
            </div>
        @endif
    </div>
</section>

<style>
.breadcrumb-area.bg-gradient {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
}

.admin-member-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border-radius: 10px;
    overflow: hidden;
}

.admin-member-card:hover {
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
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
}

.member-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(40,167,69,0.8);
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
    color: #28a745;
    font-size: 18px;
    transition: transform 0.3s ease;
}

.social-link:hover {
    transform: scale(1.1);
    color: #218838;
}

.service-years .la-trophy {
    color: #ffc107;
}

.office-item, .contact-item {
    font-size: 0.85rem;
}

.contact-item a, .office-item {
    color: #666;
    text-decoration: none;
}

.contact-item a:hover {
    color: #28a745;
    text-decoration: underline;
}
</style>
@endsection