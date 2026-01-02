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
                    <li class="breadcrumb-item"><a href="{{ route('admin.it-department.index') }}">IT Department</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add New Member</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-4">Add New IT Department Member</h4>
            
            <form action="{{ route('admin.it-department.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
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
                                               value="{{ old('name') }}" required>
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="position" class="form-label">Position *</label>
                                        <input type="text" class="form-control" id="position" name="position" 
                                               value="{{ old('position') }}" required>
                                        <small class="text-muted">e.g., "IT Manager", "Network Engineer"</small>
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="form-label">Email Address</label>
                                        <input type="email" class="form-control" id="email" name="email" 
                                               value="{{ old('email') }}">
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="phone" class="form-label">Phone Number</label>
                                        <input type="text" class="form-control" id="phone" name="phone" 
                                               value="{{ old('phone') }}">
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="expertise" class="form-label">Expertise/Skills</label>
                                        <input type="text" class="form-control" id="expertise" name="expertise" 
                                               value="{{ old('expertise') }}">
                                        <small class="text-muted">e.g., "Network Security, Cloud Computing"</small>
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="experience_years" class="form-label">Years of Experience</label>
                                        <input type="number" class="form-control" id="experience_years" name="experience_years" 
                                               value="{{ old('experience_years') }}" min="0" max="50">
                                    </div>
                                    
                                    <div class="col-12 mb-3">
                                        <label for="bio" class="form-label">Biography</label>
                                        <textarea class="form-control" id="bio" name="bio" rows="4">{{ old('bio') }}</textarea>
                                        <small class="text-muted">Brief professional background</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Social Links -->
                        <div class="card shadow-sm mb-4">
                            <div class="card-header bg-light">
                                <h5 class="mb-0">Social Links (Optional)</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="linkedin" class="form-label">LinkedIn Profile</label>
                                        <input type="url" class="form-control" id="linkedin" name="linkedin" 
                                               value="{{ old('linkedin') }}" placeholder="https://linkedin.com/in/username">
                                    </div>
                                    
                                    <div class="col-md-4 mb-3">
                                        <label for="github" class="form-label">GitHub Profile</label>
                                        <input type="url" class="form-control" id="github" name="github" 
                                               value="{{ old('github') }}" placeholder="https://github.com/username">
                                    </div>
                                    
                                    <div class="col-md-4 mb-3">
                                        <label for="twitter" class="form-label">Twitter Profile</label>
                                        <input type="url" class="form-control" id="twitter" name="twitter" 
                                               value="{{ old('twitter') }}" placeholder="https://twitter.com/username">
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
                                    <div id="photoPreview" class="rounded-circle bg-light d-flex align-items-center justify-content-center mx-auto mb-3"
                                         style="width: 150px; height: 150px;">
                                        <i class="bx bx-user text-muted" style="font-size: 4rem;"></i>
                                    </div>
                                    
                                    <label for="photo" class="form-label">Upload Photo</label>
                                    <input type="file" class="form-control" id="photo" name="photo" 
                                           accept="image/*" onchange="previewPhoto(this)">
                                    <small class="text-muted">Recommended: 300x300 pixels, JPG/PNG format</small>
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
                                           value="{{ old('display_order', 0) }}" min="0">
                                    <small class="text-muted">Lower numbers appear first</small>
                                </div>
                                
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" 
                                           id="is_active" name="is_active" value="1" checked>
                                    <label class="form-check-label" for="is_active">
                                        Active Member
                                    </label>
                                    <small class="text-muted d-block">Inactive members won't appear on the website</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Form Actions -->
                <div class="row mt-4">
                    <div class="col-12 text-end">
                        <a href="{{ route('admin.it-department.index') }}" class="btn btn-outline-secondary me-2">Cancel</a>
                        <button type="submit" class="btn btn-primary">Add Member</button>
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