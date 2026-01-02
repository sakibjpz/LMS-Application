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
                    <li class="breadcrumb-item active" aria-current="page">Edit Section</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-4">Edit Real Life Section</h4>
            
            <form action="{{ route('admin.real-life-section.update', $real_life_section) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
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
                                           value="{{ old('title', $real_life_section->title) }}" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description *</label>
                                    <textarea class="form-control" id="description" name="description" 
                                              rows="5" required>{{ old('description', $real_life_section->description) }}</textarea>
                                </div>
                                
                                <!-- Button Settings -->
                                <div class="row mt-4">
                                    <div class="col-md-6 mb-3">
                                        <label for="button_text" class="form-label">Button Text</label>
                                        <input type="text" class="form-control" id="button_text" name="button_text" 
                                               value="{{ old('button_text', $real_life_section->button_text) }}">
                                        <small class="text-muted">Leave empty if no button needed</small>
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="button_link" class="form-label">Button Link</label>
                                        <input type="text" class="form-control" id="button_link" name="button_link" 
                                               value="{{ old('button_link', $real_life_section->button_link) }}">
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
                                    @if($real_life_section->image)
                                        <img src="{{ asset('storage/' . $real_life_section->image) }}" 
                                             id="imagePreview"
                                             style="width: 200px; height: 150px; object-fit: contain; border-radius: 8px;"
                                             class="mb-3">
                                    @else
                                        <div id="imagePreview" class="bg-light d-flex align-items-center justify-content-center mx-auto mb-3"
                                             style="width: 200px; height: 150px; border: 2px dashed #ddd; border-radius: 8px;">
                                            <i class="bx bx-image text-muted" style="font-size: 3rem;"></i>
                                        </div>
                                    @endif
                                    
                                    <label for="image" class="form-label">Change Image</label>
                                    <input type="file" class="form-control" id="image" name="image" 
                                           accept="image/*" onchange="previewImage(this)">
                                    <small class="text-muted">Leave empty to keep current image</small>
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
                                           value="{{ old('display_order', $real_life_section->display_order) }}" min="0">
                                </div>
                                
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" 
                                           id="is_active" name="is_active" value="1"
                                           {{ $real_life_section->is_active ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">
                                        Active Section
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Form Actions -->
                <div class="row mt-4">
                    <div class="col-12 text-end">
                        <a href="{{ route('admin.real-life-section.index') }}" class="btn btn-outline-secondary me-2">Cancel</a>
                        <button type="submit" class="btn btn-primary">Update Section</button>
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
            // Works for SVG, PNG, JPG, WEBP
            const mimeType = input.files[0].type;
            if (mimeType === 'image/svg+xml') {
                preview.innerHTML = e.target.result ? `<embed src="${e.target.result}" type="image/svg+xml" 
                                                        style="width: 200px; height: 150px; object-fit: contain; border-radius: 8px;">` : '';
            } else {
                preview.innerHTML = `<img src="${e.target.result}" 
                                       style="width: 200px; height: 150px; object-fit: contain; border-radius: 8px;">`;
            }
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
