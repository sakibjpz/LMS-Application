@extends('backend.admin.master')

@section('content')
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Application Settings</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.real-life-section.index') }}">Real Life Section</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add New Section</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-4">Add New Real Life Section</h4>
            
            <form action="{{ route('admin.real-life-section.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="row">
                    <div class="col-lg-8">
                        <!-- Content Section -->
                        <div class="card shadow-sm mb-4">
                            <div class="card-header bg-light">
                                <h5 class="mb-0">Section Content</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title *</label>
                                    <input type="text" class="form-control" id="title" name="title" 
                                           value="{{ old('title') }}" required>
                                    <small class="text-muted">Main heading for the section</small>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description *</label>
                                    <textarea class="form-control" id="description" name="description" 
                                              rows="5" required>{{ old('description') }}</textarea>
                                    <small class="text-muted">Detailed description shown below the title</small>
                                </div>
                                
                                <!-- Button Settings -->
                                <div class="row mt-4">
                                    <div class="col-md-6 mb-3">
                                        <label for="button_text" class="form-label">Button Text</label>
                                        <input type="text" class="form-control" id="button_text" name="button_text" 
                                               value="{{ old('button_text') }}">
                                        <small class="text-muted">Leave empty if no button needed</small>
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="button_link" class="form-label">Button Link</label>
                                        <input type="text" class="form-control" id="button_link" name="button_link" 
                                               value="{{ old('button_link') }}">
                                        <small class="text-muted">URL when button is clicked</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-4">
                        <!-- Image Upload -->
                        <div class="card shadow-sm mb-4">
                            <div class="card-header bg-light">
                                <h5 class="mb-0">Section Image</h5>
                            </div>
                            <div class="card-body text-center">
                                <div class="mb-3">
                                    <div id="imagePreview" class="bg-light d-flex align-items-center justify-content-center mx-auto mb-3"
                                         style="width: 200px; height: 150px; border: 2px dashed #ddd; border-radius: 8px;">
                                        <i class="bx bx-image text-muted" style="font-size: 3rem;"></i>
                                    </div>
                                    
                                    <label for="image" class="form-label">Upload Image</label>
                                    <input type="file" class="form-control" id="image" name="image" 
                                           accept="image/*" onchange="previewImage(this)">
                                    <small class="text-muted">Recommended: 500x400 pixels, PNG/SVG format</small>
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
                                        Active Section
                                    </label>
                                    <small class="text-muted d-block">Inactive sections won't appear on the website</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Form Actions -->
                <div class="row mt-4">
                    <div class="col-12 text-end">
                        <a href="{{ route('admin.real-life-section.index') }}" class="btn btn-outline-secondary me-2">Cancel</a>
                        <button type="submit" class="btn btn-primary">Save Section</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function previewImage(input) {
    const preview = document.getElementById('imagePreview');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            preview.innerHTML = `<img src="${e.target.result}" 
                                   style="width: 100%; height: 100%; object-fit: contain; border-radius: 6px;">`;
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