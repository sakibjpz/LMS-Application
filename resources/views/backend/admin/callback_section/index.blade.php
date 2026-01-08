@extends('backend.admin.master')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Manage Callback Section</h1>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Add/Edit Form -->
    <div class="card mb-5">
        <div class="card-header">
            Callback Section Content
        </div>
        <div class="card-body">
            <form action="{{ route('admin.callback-section.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="content_title" class="form-label">Content Title</label>
                    <input type="text" name="content_title" class="form-control" 
                           placeholder="Enter title (e.g., ফ্রি কলে পরামর্শ নিন)" required>
                </div>
                <div class="mb-3">
                    <label for="content_description" class="form-label">Content Description</label>
                    <textarea name="content_description" class="form-control" rows="4" 
                              placeholder="Enter description" required></textarea>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" name="is_active" class="form-check-input" id="isActive" checked>
                    <label class="form-check-label" for="isActive">Active</label>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>

    <!-- Existing Content Table -->
    <div class="card">
        <div class="card-header">
            Current Content
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($callbackSections as $section)
                    <tr>
                        <td>{{ $section->content_title }}</td>
                        <td>{{ Str::limit($section->content_description, 100) }}</td>
                        <td>
                            @if($section->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.callback-section.edit', $section->id) }}" 
                               class="btn btn-sm btn-warning">Edit</a>
                            
                            <form action="{{ route('admin.callback-section.destroy', $section->id) }}" 
                                  method="POST" class="d-inline" 
                                  onsubmit="return confirm('Are you sure you want to delete this?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection