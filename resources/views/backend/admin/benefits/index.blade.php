@extends('backend.admin.master')

@section('content')
<div class="page-content">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0">All Benefits</h5>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBenefitModal">
            + Add New Benefit
        </button>
    </div>

    <!-- List of Benefits -->
    <div class="row">
        @foreach($benefits as $index => $benefit)
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-body">

                        <div class="d-flex justify-content-between">
                            <h6>Benefit #{{ $benefit->id }}</h6>
                            <form action="{{ route('admin.benefit.destroy', $benefit->id) }}" method="POST" onsubmit="return confirm('Delete this item?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </div>

                        <form method="POST" action="{{ route('admin.benefit.update', $benefit->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Current Icon Preview -->
                            <div class="mb-2">
                                <label>Current Icon:</label><br>
                                @if($benefit->icon_image)
                                    <img src="{{ asset($benefit->icon_image) }}" alt="Icon" style="width: 50px; height: 50px; object-fit: contain; background: #f8f9fa; padding: 5px; border-radius: 5px;">
                                    <small class="d-block text-muted">Uploaded Image</small>
                                @elseif($benefit->icon)
                                    <div style="width: 50px; height: 50px; background: #f8f9fa; display: flex; align-items: center; justify-content: center; border-radius: 5px;">
                                        <small>SVG Code</small>
                                    </div>
                                @else
                                    <div style="width: 50px; height: 50px; background: #f8f9fa; display: flex; align-items: center; justify-content: center; border-radius: 5px;">
                                        <small>No Icon</small>
                                    </div>
                                @endif
                            </div>

                            <!-- Upload New Image -->
                            <label class="mt-2">Upload Icon Image</label>
                            <input type="file" name="icon_image" class="form-control mb-2" accept="image/*">
                            <small class="text-muted">Upload JPG, PNG, SVG, or WebP (max: 2MB)</small>

                            <!-- OR Enter SVG Code -->
                            <label class="mt-3">OR: SVG Code (Alternative)</label>
                            <textarea name="icon" rows="3" class="form-control" placeholder="Paste SVG code here...">{{ $benefit->icon }}</textarea>
                            <small class="text-muted">If you upload an image, this SVG will be ignored</small>

                            <label class="mt-3">Benefit Title</label>
                            <input type="text" name="title" class="form-control" value="{{ $benefit->title }}" required>

                            <label class="mt-2">Description</label>
                            <textarea name="description" rows="3" class="form-control" required>{{ $benefit->description }}</textarea>

                            <label class="mt-2">Icon Color Class</label>
                            <select name="icon_class" class="form-control">
                                <option value="">None</option>
                                <option value="blue" {{ $benefit->icon_class == 'blue' ? 'selected' : '' }}>Blue</option>
                                <option value="green" {{ $benefit->icon_class == 'green' ? 'selected' : '' }}>Green</option>
                                <option value="blue-light" {{ $benefit->icon_class == 'blue-light' ? 'selected' : '' }}>Blue Light</option>
                                <option value="green-multi" {{ $benefit->icon_class == 'green-multi' ? 'selected' : '' }}>Green Multi</option>
                            </select>

                            <label class="mt-2">Sort Order</label>
                            <input type="number" name="sort_order" class="form-control" value="{{ $benefit->sort_order }}">

                            <label class="mt-3">
                                <input type="checkbox" name="is_active" value="1" {{ $benefit->is_active ? 'checked' : '' }}> Active
                            </label>

                            <!-- Section Title - Only for first benefit -->
                            @if($index === 0)
                                <label class="mt-3">Section Main Title</label>
                                <input type="text" name="section_title" class="form-control" value="{{ $benefit->section_title }}" placeholder="What you will get from Civil tech">
                                <small class="text-muted">This title appears above ALL benefits (only set here)</small>
                            @else
                                <input type="hidden" name="section_title" value="">
                            @endif

                            <button class="btn btn-success w-100 mt-3">Update</button>
                        </form>

                    </div>
                </div>
            </div>
        @endforeach
    </div>

</div>


<!-- Add Benefit Modal -->
<div class="modal fade" id="addBenefitModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.benefit.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">Add New Benefit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <label>Upload Icon Image</label>
                    <input type="file" name="icon_image" class="form-control mb-2" accept="image/*">
                    <small class="text-muted">Upload JPG, PNG, SVG, or WebP (max: 2MB)</small>

                    <label class="mt-3">OR: SVG Code (Alternative)</label>
                    <textarea name="icon" class="form-control" rows="3" placeholder="Paste SVG code here..."></textarea>
                    <small class="text-muted">If you upload an image, this SVG will be ignored</small>

                    <label class="mt-3">Benefit Title</label>
                    <input type="text" name="title" class="form-control" required>

                    <label class="mt-2">Description</label>
                    <textarea name="description" rows="3" class="form-control" required></textarea>

                    <label class="mt-2">Icon Class</label>
                    <select name="icon_class" class="form-control">
                        <option value="">None</option>
                        <option value="blue">Blue</option>
                        <option value="green">Green</option>
                        <option value="blue-light">Blue Light</option>
                        <option value="green-multi">Green Multi</option>
                    </select>

                    <label class="mt-2">Sort Order</label>
                    <input type="number" name="sort_order" class="form-control" value="0">

                    <label class="mt-3">
                        <input type="checkbox" name="is_active" value="1" checked> Active
                    </label>

                    <!-- Section Title field removed from add modal -->
                    <input type="hidden" name="section_title" value="">

                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary w-100">Add Benefit</button>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection