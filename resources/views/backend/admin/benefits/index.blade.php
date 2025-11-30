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
        @foreach($benefits as $benefit)
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

                        <form method="POST" action="{{ route('admin.benefit.update', $benefit->id) }}">
                            @csrf
                            @method('PUT')

                            <label class="mt-2">Icon (SVG or IMG HTML)</label>
                            <textarea name="icon" rows="4" class="form-control">{{ $benefit->icon }}</textarea>

                            <label class="mt-2">Title</label>
                            <input type="text" name="title" class="form-control" value="{{ $benefit->title }}">

                            <label class="mt-2">Description</label>
                            <textarea name="description" rows="3" class="form-control">{{ $benefit->description }}</textarea>

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
            <form method="POST" action="{{ route('admin.benefit.store') }}">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">Add New Benefit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <label>Icon (SVG or IMG HTML)</label>
                    <textarea name="icon" class="form-control" rows="4"></textarea>

                    <label class="mt-2">Title</label>
                    <input type="text" name="title" class="form-control">

                    <label class="mt-2">Description</label>
                    <textarea name="description" rows="3" class="form-control"></textarea>

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

                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary w-100">Add Benefit</button>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection
