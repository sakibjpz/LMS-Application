@extends('backend.admin.master')

@section('content')
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Our Team</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.administration.index') }}">Administration</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Member</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-4">Edit Administration Member</h4>
            
            <form action="{{ route('admin.administration.update', $administration->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <!-- Left Column -->
                    <div class="col-lg-8">
                        <!-- Basic Information -->
                        <div class="card shadow-sm mb-4">
                            <div class="card-header bg-light">
                                <h5 class="mb-0">Basic Information</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="name" class="form-label">Full Name *</label>
                                        <input type="text" class="form-control" id="name" name="name" 
                                               value="{{ old('name', $administration->name) }}" required>
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="position" class="form-label">Position *</label>
                                        <input type="text" class="form-control" id="position" name="position" 
                                               value="{{ old('position', $administration->position) }}" required>
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="department" class="form-label">Department</label>
                                        <select class="form-control" id="department" name="department">
                                            <option value="">Select Department</option>
                                            <option value="Academic" {{ old('department', $administration->department) == 'Academic' ? 'selected' : '' }}>Academic</option>
                                            <option value="Student Affairs" {{ old('department', $administration->department) == 'Student Affairs' ? 'selected' : '' }}>Student Affairs</option>
                                            <option value="Finance" {{ old('department', $administration->department) == 'Finance' ? 'selected' : '' }}>Finance</option>
                                            <option value="HR & Administration" {{ old('department', $administration->department) == 'HR & Administration' ? 'selected' : '' }}>HR & Administration</option>
                                            <option value="Registrar Office" {{ old('department', $administration->department) == 'Registrar Office' ? 'selected' : '' }}>Registrar Office</option>
                                            <option value="Quality Assurance" {{ old('department', $administration->department) == 'Quality Assurance' ? 'selected' : '' }}>Quality Assurance</option>
                                            <option value="Admissions" {{ old('department', $administration->department) == 'Admissions' ? 'selected' : '' }}>Admissions</option>
                                        </select>
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="years_of_service" class="form-label">Years of Service</label>
                                        <input type="number" class="form-control" id="years_of_service" name="years_of_service" 
                                               value="{{ old('years_of_service', $administration->years_of_service) }}" min="0" max="50">
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="form-label">Email Address</label>
                                        <input type="email" class="form-control" id="email" name="email" 
                                               value="{{ old('email', $administration->email) }}">
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="phone" class="form-label">Phone Number</label>
                                        <input type="text" class="form-control" id="phone" name="phone" 
                                               value="{{ old('phone', $administration->phone) }}">
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="office_location" class="form-label">Office Location</label>
                                        <input type="text" class="form-control" id="office_location" name="office_location" 
                                               value="{{ old('office_location', $administration->office_location) }}">
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="office_hours" class="form-label">Office Hours</label>
                                        <input type="text" class="form-control" id="office_hours" name="office_hours" 
                                               value="{{ old('office_hours', $administration->office_hours) }}">
                                    </div>
                                    
                                    <div class="col-12 mb-3">
                                        <label for="bio" class="form-label">Biography</label>
                                        <textarea class="form-control" id="bio" name="bio" rows="4">{{ old('bio', $administration->bio) }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Social Links -->
                        <div class="card shadow-sm mb-4">
                            <div class="card-header bg-light">
                                <h5 class="mb-0">Social Links</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @php
                                        $socialLinks = $administration->social_links ?? [];
                                    @endphp
                                    <div class="col-md-6 mb-3">
                                        <label for="linkedin" class="form-label">LinkedIn Profile</label>
                                        <input type="url" class="form-control" id="linkedin" name="linkedin" 
                                               value="{{ old('linkedin', $socialLinks['linkedin'] ?? '') }}">
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="twitter" class="form-label">Twitter Profile</label>
                                        <input type="url" class="form-control" id="twitter" name="twitter" 
                                               value="{{ old('twitter', $socialLinks['twitter'] ?? '') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Right Column -->
                    <div class="col-lg-4">
                        <!-- Profile Photo -->
                        <div class="card shadow-sm mb-4">
                            <div class="card-header bg-light">
                                <h5 class="mb-0">Profile Photo</h5>
                            </div>
                            <div class="card-body text-center">
                                <div class="mb-3">
                                    @if($administration->photo)
                                        <img src="{{ asset('storage/' . $administration->photo) }}" 
                                             id="photoPreview" class="rounded-circle mb-3"
                                             style="width: 150px; height: 150px; object-fit: cover;">
                                    @else
                                        <div id="photoPreview" class="rounded-circle bg-light d-flex align-items-center justify-content-center mx-auto mb-3"
                                             style="width: 150px; height: 150px;">
                                            <i class="bx bx-user text-muted" style="font-size: 4rem;"></i>
                                        </div>
                                    @endif
                                    
                                    <label for="photo" class="form-label">Change Photo</label>
                                    <input type="file" class="form-control" id="photo" name="photo" 
                                           accept="image/*" onchange="previewPhoto(this)">
                                    <small class="text-muted">Leave empty to keep current photo</small>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Settings -->
                        <div class="card shadow-sm">
                            <div class="card-header bg-light">
                                <h5 class="mb-0">Settings</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="display_order" class="form-label">Display Order</label>
                                    <input type="number" class="form-control" id="display_order" name="display_order" 
                                           value="{{ old('display_order', $administration->display_order) }}" min="0">
                                </div>
                                
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" 
                                           id="is_active" name="is_active" value="1"
                                           {{ $administration->is_active ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">
                                        Active Member
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Form Actions -->
                <div class="row mt-4">
                    <div class="col-12 text-end">
                        <a href="{{ route('admin.administration.index') }}" class="btn btn-outline-secondary me-2">Cancel</a>
                        <button type="submit" class="btn btn-primary">Update Member</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function previewPhoto(input) {
    const preview = document.getElementById('photoPreview');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            preview.innerHTML = `<img src="${e.target.result}" class="rounded-circle" 
                                   style="width: 150px; height: 150px; object-fit: cover;">`;
        }
        
        reader.readAsDataURL(input.files[0]);
    }
}
</script>

<style>
.card-header.bg-light {
    background-color: #f8f9fa !important;
    border-bottom: 1px solid #dee2e6;
}
</style>
@endsection