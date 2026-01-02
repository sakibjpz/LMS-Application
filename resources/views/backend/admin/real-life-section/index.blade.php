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
                    <li class="breadcrumb-item active" aria-current="page">Real Life Section</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="card-title mb-0">Real Life Sections</h4>
                <a href="{{ route('admin.real-life-section.create') }}" class="btn btn-primary">
                    <i class="la la-plus"></i> Add New Section
                </a>
            </div>
            
            @if($sections->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Button</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sections as $index => $section)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                @if($section->image)
                                    <img src="{{ asset('storage/' . $section->image) }}" 
                                         width="80" height="60" 
                                         class="rounded object-fit-cover">
                                @else
                                    <div class="bg-light d-flex align-items-center justify-content-center" 
                                         style="width: 80px; height: 60px;">
                                        <i class="bx bx-image text-muted"></i>
                                    </div>
                                @endif
                            </td>
                            <td>{{ Str::limit($section->title, 50) }}</td>
                            <td>{{ Str::limit($section->description, 70) }}</td>
                            <td>
                                @if($section->hasButton())
                                    <span class="badge bg-success">Yes</span><br>
                                    <small>{{ $section->button_text }}</small>
                                @else
                                    <span class="badge bg-secondary">No</span>
                                @endif
                            </td>
                            <td>
                                @if($section->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('admin.real-life-section.edit', $section->id) }}" 
                                       class="btn btn-sm btn-warning px-3" title="Edit">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.real-life-section.destroy', $section->id) }}" 
                                          method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete this section?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger px-3" title="Delete">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="text-center py-5">
                <i class="la la-cubes la-4x text-muted mb-3"></i>
                <h5 class="text-muted">No Real Life Sections</h5>
                <p class="text-muted">Add your first real life section for the home page.</p>
                <a href="{{ route('admin.real-life-section.create') }}" class="btn btn-primary">
                    <i class="la la-plus"></i> Add First Section
                </a>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection