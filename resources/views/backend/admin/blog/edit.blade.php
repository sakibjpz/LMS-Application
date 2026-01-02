@extends('backend.admin.master')

@section('content')
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Blog</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.blog.index') }}">Blog Posts</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Post</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-4">Edit Blog Post</h4>
            
            <form action="{{ route('admin.blog.update', $blog->id) }}" method="POST" enctype="multipart/form-data" id="blogForm">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <!-- Left Column: Content -->
                    <div class="col-lg-8">
                        <!-- Basic Information -->
                        <div class="card shadow-sm mb-4">
                            <div class="card-header bg-light">
                                <h5 class="mb-0">Post Content</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Post Title *</label>
                                    <input type="text" class="form-control" id="title" name="title" 
                                           value="{{ old('title', $blog->title) }}" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="excerpt" class="form-label">Excerpt</label>
                                    <textarea class="form-control" id="excerpt" name="excerpt" rows="3">{{ old('excerpt', $blog->excerpt) }}</textarea>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="content" class="form-label">Content *</label>
                                    <textarea class="form-control" id="content" name="content" rows="10">{{ old('content', $blog->content) }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Existing Images -->
                        @if($blog->images->count() > 0)
                        <div class="card shadow-sm mb-4">
                            <div class="card-header bg-light">
                                <h5 class="mb-0">Existing Images</h5>
                            </div>
                            <div class="card-body">
                                <div class="row" id="existingImagesContainer">
                                    @foreach($blog->images as $image)
                                    <div class="col-md-4 mb-3 image-item" data-id="{{ $image->id }}">
                                        <div class="card">
                                            <img src="{{ asset('storage/' . $image->image_path) }}" 
                                                 class="card-img-top" 
                                                 alt="Blog image"
                                                 style="height: 150px; object-fit: cover;">
                                            <div class="card-body p-2">
                                                <input type="text" 
                                                       class="form-control form-control-sm mb-2" 
                                                       value="{{ $image->caption }}"
                                                       placeholder="Caption"
                                                       onchange="updateImageCaption({{ $image->id }}, this.value)">
                                                <button type="button" 
                                                        class="btn btn-sm btn-danger btn-block"
                                                        onclick="deleteImage({{ $image->id }})">
                                                    <i class="la la-trash"></i> Delete
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- New Images Upload -->
                        <div class="card shadow-sm mb-4">
                            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Add More Images</h5>
                                <button type="button" class="btn btn-sm btn-primary" onclick="addImageField()">
                                    <i class="la la-plus"></i> Add Image Field
                                </button>
                            </div>
                            <div class="card-body" id="imageUploadContainer">
                                <div class="image-upload-item mb-4">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">New Image</label>
                                            <input type="file" class="form-control" name="blog_images[]" accept="image/*">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Caption (Optional)</label>
                                            <input type="text" class="form-control" name="captions[]" placeholder="Image caption">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Right Column: Settings -->
                    <div class="col-lg-4">
                        <!-- Featured Image -->
                        <div class="card shadow-sm mb-4">
                            <div class="card-header bg-light">
                                <h5 class="mb-0">Featured Image</h5>
                            </div>
                            <div class="card-body text-center">
                                <div class="mb-3">
                                    @if($blog->featured_image)
                                        <img src="{{ asset('storage/' . $blog->featured_image) }}" 
                                             id="featuredImagePreview"
                                             style="width: 200px; height: 150px; object-fit: cover; border-radius: 8px;"
                                             class="mb-3">
                                    @else
                                        <div id="featuredImagePreview" class="bg-light d-flex align-items-center justify-content-center mx-auto mb-3"
                                             style="width: 200px; height: 150px; border: 2px dashed #ddd; border-radius: 8px;">
                                            <i class="bx bx-image text-muted" style="font-size: 3rem;"></i>
                                        </div>
                                    @endif
                                    
                                    <label for="featured_image" class="form-label">Change Featured Image</label>
                                    <input type="file" class="form-control" id="featured_image" name="featured_image" 
                                           accept="image/*" onchange="previewFeaturedImage(this)">
                                    <small class="text-muted">Leave empty to keep current image</small>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Post Settings -->
                        <div class="card shadow-sm mb-4">
                            <div class="card-header bg-light">
                                <h5 class="mb-0">Post Settings</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="author" class="form-label">Author</label>
                                        <input type="text" class="form-control" id="author" name="author" 
                                               value="{{ old('author', $blog->author) }}">
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="category" class="form-label">Category</label>
                                        <input type="text" class="form-control" id="category" name="category" 
                                               value="{{ old('category', $blog->category) }}" list="categoryList">
                                        <datalist id="categoryList">
                                            <option value="Technology">
                                            <option value="Education">
                                            <option value="Business">
                                            <option value="Lifestyle">
                                            <option value="Health">
                                        </datalist>
                                    </div>
                                    
                                    <div class="col-12 mb-3">
                                        <label for="tags" class="form-label">Tags</label>
                                        <input type="text" class="form-control" id="tags" name="tags" 
                                               value="{{ old('tags', $blog->tags ? implode(', ', $blog->tags) : '') }}">
                                        <small class="text-muted">Separate with commas</small>
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="read_time" class="form-label">Read Time (minutes)</label>
                                        <input type="number" class="form-control" id="read_time" name="read_time" 
                                               value="{{ old('read_time', $blog->read_time) }}" min="1" max="60">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Publishing Options -->
                        <div class="card shadow-sm mb-4">
                            <div class="card-header bg-light">
                                <h5 class="mb-0">Publishing Options</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" role="switch" 
                                           id="is_published" name="is_published" value="1"
                                           {{ $blog->is_published ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_published">
                                        Published
                                    </label>
                                </div>
                                
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" role="switch" 
                                           id="is_featured" name="is_featured" value="1"
                                           {{ $blog->is_featured ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_featured">
                                        Featured Post
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <!-- SEO Settings -->
                        <div class="card shadow-sm">
                            <div class="card-header bg-light">
                                <h5 class="mb-0">SEO Settings</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="meta_title" class="form-label">Meta Title</label>
                                    <input type="text" class="form-control" id="meta_title" name="meta_title" 
                                           value="{{ old('meta_title', $blog->meta_title) }}">
                                </div>
                                
                                <div class="mb-3">
                                    <label for="meta_description" class="form-label">Meta Description</label>
                                    <textarea class="form-control" id="meta_description" name="meta_description" rows="3">{{ old('meta_description', $blog->meta_description) }}</textarea>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="meta_keywords" class="form-label">Meta Keywords</label>
                                    <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" 
                                           value="{{ old('meta_keywords', $blog->meta_keywords) }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Form Actions -->
                <div class="row mt-4">
                    <div class="col-12 text-end">
                        <a href="{{ route('admin.blog.index') }}" class="btn btn-outline-secondary me-2">Cancel</a>
                        <button type="submit" class="btn btn-primary">Update Post</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
let imageCount = 1;

function addImageField() {
    imageCount++;
    const container = document.getElementById('imageUploadContainer');
    const newField = document.createElement('div');
    newField.className = 'image-upload-item mb-4';
    newField.innerHTML = `
        <div class="d-flex justify-content-between align-items-center mb-2">
            <label class="form-label">New Image ${imageCount}</label>
            <button type="button" class="btn btn-sm btn-danger" onclick="removeImageField(this)">
                <i class="la la-trash"></i> Remove
            </button>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <input type="file" class="form-control" name="blog_images[]" accept="image/*">
            </div>
            <div class="col-md-6 mb-3">
                <input type="text" class="form-control" name="captions[]" placeholder="Image caption">
            </div>
        </div>
    `;
    container.appendChild(newField);
}

function removeImageField(button) {
    button.closest('.image-upload-item').remove();
}

function previewFeaturedImage(input) {
    const preview = document.getElementById('featuredImagePreview');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            preview.innerHTML = `<img src="${e.target.result}" 
                                   style="width: 200px; height: 150px; object-fit: cover; border-radius: 8px;">`;
        }
        
        reader.readAsDataURL(input.files[0]);
    }
}

// Delete existing image via AJAX
function deleteImage(imageId) {
    if (confirm('Are you sure you want to delete this image?')) {
        fetch(`/admin/blog-image/${imageId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.querySelector(`.image-item[data-id="${imageId}"]`).remove();
            }
        })
        .catch(error => console.error('Error:', error));
    }
}

// Update image caption via AJAX
function updateImageCaption(imageId, caption) {
    // You can implement this if you want live caption updates
    console.log(`Image ${imageId} caption updated to: ${caption}`);
}

// Auto-calculate read time
document.getElementById('content').addEventListener('input', function() {
    const wordCount = this.value.trim().split(/\s+/).length;
    const readTime = Math.ceil(wordCount / 200);
    document.getElementById('read_time').value = readTime > 0 ? readTime : 1;
});
</script>

<style>
.card-header.bg-light {
    background-color: #f8f9fa !important;
    border-bottom: 1px solid #dee2e6;
}

.image-upload-item {
    padding: 15px;
    border: 1px solid #e9ecef;
    border-radius: 8px;
    background-color: #f8f9fa;
}

.image-item .card {
    transition: transform 0.3s ease;
}

.image-item .card:hover {
    transform: translateY(-5px);
}
</style>
@endsection