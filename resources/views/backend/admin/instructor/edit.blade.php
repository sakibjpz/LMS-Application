@extends('backend.admin.master')

@section('content')
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Instructor</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.instructor.index') }}">Instructors</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Instructor</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-4">Edit Instructor Profile</h4>
            
            <form action="{{ route('admin.instructor.update', $instructor->id) }}" method="POST" enctype="multipart/form-data">
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
                                               value="{{ old('name', $instructor->name) }}" required>
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="form-label">Email Address *</label>
                                        <input type="email" class="form-control" id="email" name="email" 
                                               value="{{ old('email', $instructor->email) }}" required>
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="phone" class="form-label">Phone Number</label>
                                        <input type="text" class="form-control" id="phone" name="phone" 
                                               value="{{ old('phone', $instructor->phone) }}">
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="address" class="form-label">Address</label>
                                        <input type="text" class="form-control" id="address" name="address" 
                                               value="{{ old('address', $instructor->address) }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Biography -->
                        <div class="card shadow-sm mb-4">
                            <div class="card-header bg-light">
                                <h5 class="mb-0">Biography</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="bio" class="form-label">About Instructor</label>
                                    <textarea class="form-control" id="bio" name="bio" rows="5">{{ old('bio', $instructor->bio) }}</textarea>
                                    <small class="text-muted">This will be displayed on the trainer's public profile page.</small>
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
                                @if($instructor->photo)
                                    <img src="{{ asset($instructor->photo) }}" 
                                         class="rounded-circle mb-3" 
                                         alt="{{ $instructor->name }}"
                                         width="150" height="150">
                                @else
                                    <div class="rounded-circle bg-light d-flex align-items-center justify-content-center mx-auto mb-3"
                                         style="width: 150px; height: 150px;">
                                        <i class="bx bx-user text-muted" style="font-size: 4rem;"></i>
                                    </div>
                                @endif
                                
                                <div class="mb-3">
                                    <label for="photo" class="form-label">Upload New Photo</label>
                                    <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
                                    <small class="text-muted">Recommended: 300x300 pixels, JPG/PNG format</small>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Status -->
                        <div class="card shadow-sm">
                            <div class="card-header bg-light">
                                <h5 class="mb-0">Account Status</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" 
                                           id="status" name="status" value="1"
                                           {{ $instructor->status == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="status">
                                        Active Account
                                    </label>
                                </div>
                                <small class="text-muted">Inactive instructors won't appear on the trainers page.</small>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Form Actions -->
                <div class="row mt-4">
                    <div class="col-12 text-end">
                        <a href="{{ route('admin.instructor.index') }}" class="btn btn-outline-secondary me-2">Cancel</a>
                        <button type="submit" class="btn btn-primary">Update Instructor Profile</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.card-header.bg-light {
    background-color: #f8f9fa !important;
    border-bottom: 1px solid #dee2e6;
}
</style>
@endpush