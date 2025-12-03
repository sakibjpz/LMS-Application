@extends('backend.admin.master')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Funfacts</h1>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Add Funfact Form -->
    <div class="card mb-5">
        <div class="card-header">
            Add New Funfact
        </div>
        <div class="card-body">
            <form action="{{ route('admin.funfacts.store') }}" method="POST" class="row g-3" enctype="multipart/form-data">
                @csrf
                <div class="col-md-4">
                    <input type="text" name="title" class="form-control" placeholder="Title" required>
                </div>
                <div class="col-md-2">
                    <input type="number" name="value" class="form-control" placeholder="Value" required>
                </div>
                <div class="col-md-2">
    <input type="file" name="svg_icon" class="form-control" accept=".svg">
</div>

                <div class="col-md-2">
                    <input type="text" name="color_class" class="form-control" placeholder="Color Class">
                </div>
                <div class="col-md-1">
                    <input type="number" name="sort_order" class="form-control" placeholder="Sort">
                </div>
                <div class="col-md-1 form-check">
                    <input type="checkbox" name="is_active" class="form-check-input" id="addIsActive" checked>
                    <label class="form-check-label" for="addIsActive">Active</label>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Add Funfact</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Funfacts Table -->
    <div class="card">
        <div class="card-header">
            Existing Funfacts
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Title</th>
                        <th>Value</th>
                        <th>SVG Icon</th>
                        <th>Color Class</th>
                        <th>Sort Order</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($funfacts as $funfact)
                    <tr>
                        <td>{{ $funfact->title }}</td>
                        <td>{{ $funfact->value }}</td>
                       <td>
    @if($funfact->svg_icon)
        <img src="{{ asset($funfact->svg_icon) }}" alt="SVG Icon" width="40">
    @endif
</td>

                        <td>{{ $funfact->color_class }}</td>
                        <td>{{ $funfact->sort_order }}</td>
                        <td>
                            @if($funfact->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <!-- Edit Button -->
                            <button class="btn btn-sm btn-warning" 
                                onclick="openEditModal({{ $funfact->id }}, '{{ $funfact->title }}', {{ $funfact->value }}, '{{ $funfact->svg_icon }}', '{{ $funfact->color_class }}', {{ $funfact->sort_order }}, {{ $funfact->is_active ? 1 : 0 }})">
                                Edit
                            </button>

                            <!-- Delete Button -->
                            <form action="{{ route('funfacts.destroy', $funfact->id) }}" method="POST" class="d-inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Edit Funfact</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body row g-3">
                    <div class="col-md-6">
                        <input type="text" name="title" id="editTitle" class="form-control" placeholder="Title" required>
                    </div>
                    <div class="col-md-6">
                        <input type="number" name="value" id="editValue" class="form-control" placeholder="Value" required>
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="svg_icon" id="editSvgIcon" class="form-control" placeholder="SVG Icon">
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="color_class" id="editColorClass" class="form-control" placeholder="Color Class">
                    </div>
                    <div class="col-md-6">
                        <input type="number" name="sort_order" id="editSortOrder" class="form-control" placeholder="Sort Order">
                    </div>
                    <div class="col-md-6 form-check">
                        <input type="checkbox" name="is_active" class="form-check-input" id="editIsActive">
                        <label class="form-check-label" for="editIsActive">Active</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
