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
            <form action="{{ route('admin.funfacts.store') }}" method="POST" class="row g-3">
                @csrf
                <div class="col-md-4">
                    <input type="text" name="title" class="form-control" placeholder="Title (e.g., expert instructors)" required>
                </div>
                <div class="col-md-3">
                    <input type="text" name="count" class="form-control" placeholder="Count (e.g., 7520)" required>
                </div>
                <div class="col-md-2">
                    <input type="number" name="order" class="form-control" placeholder="Order" value="0">
                </div>
                <div class="col-md-2 form-check">
                    <input type="checkbox" name="is_active" class="form-check-input" id="addIsActive" checked>
                    <label class="form-check-label" for="addIsActive">Active</label>
                </div>
                <div class="col-md-1">
                    <button type="submit" class="btn btn-primary">Add</button>
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
                        <th>Count</th>
                        <th>Order</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($funfacts as $funfact)
                    <tr>
                        <td>{{ $funfact->title }}</td>
                        <td>{{ $funfact->count }}</td>
                        <td>{{ $funfact->order }}</td>
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
                                onclick="openEditModal({{ $funfact->id }}, '{{ $funfact->title }}', '{{ $funfact->count }}', {{ $funfact->order }}, {{ $funfact->is_active ? 1 : 0 }})">
                                Edit
                            </button>

                            <!-- Delete Button -->
                            <form action="{{ route('admin.funfacts.destroy', $funfact->id) }}" method="POST" class="d-inline-block">
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
                        <input type="text" name="count" id="editCount" class="form-control" placeholder="Count" required>
                    </div>
                    <div class="col-md-6">
                        <input type="number" name="order" id="editOrder" class="form-control" placeholder="Order">
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

<script>
function openEditModal(id, title, count, order, isActive) {
    // Set form action
    document.getElementById('editForm').action = '/admin/funfacts/' + id;
    
    // Set form values
    document.getElementById('editTitle').value = title;
    document.getElementById('editCount').value = count;
    document.getElementById('editOrder').value = order;
    document.getElementById('editIsActive').checked = isActive;
    
    // Show modal
    var editModal = new bootstrap.Modal(document.getElementById('editModal'));
    editModal.show();
}
</script>
@endsection