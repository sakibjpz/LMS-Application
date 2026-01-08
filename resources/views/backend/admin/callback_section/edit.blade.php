@extends('backend.admin.master')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Edit Callback Section</h1>

    <div class="card">
        <div class="card-header">
            Edit Content
        </div>
        <div class="card-body">
            <form action="{{ route('admin.callback-section.update', $callbackSection->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="content_title" class="form-label">Content Title</label>
                    <input type="text" name="content_title" class="form-control" 
                           value="{{ old('content_title', $callbackSection->content_title) }}" required>
                </div>
                
                <div class="mb-3">
                    <label for="content_description" class="form-label">Content Description</label>
                    <textarea name="content_description" class="form-control" rows="4" required>
                        {{ old('content_description', $callbackSection->content_description) }}
                    </textarea>
                </div>
                
                <div class="mb-3 form-check">
                    <input type="checkbox" name="is_active" class="form-check-input" id="isActive" 
                           {{ $callbackSection->is_active ? 'checked' : '' }}>
                    <label class="form-check-label" for="isActive">Active</label>
                </div>
                
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('admin.callback-section.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection