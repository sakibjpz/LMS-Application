@extends('backend.admin.master')

@section('content')
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Our Team</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Administration</li>
                </ol>
            </nav>
            </div>
    </div>
    <!--end breadcrumb-->
    
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="card-title mb-0">Administration Team</h4>
                <a href="{{ route('admin.administration.create') }}" class="btn btn-primary">
                    <i class="la la-plus"></i> Add New Member
                </a>
            </div>
            
            @if($members->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Photo</th>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Department</th>
                            <th>Office</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($members as $index => $member)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                @if($member->photo)
                                    <img src="{{ asset('storage/' . $member->photo) }}" 
                                         width="50" height="50" 
                                         class="rounded-circle object-fit-cover">
                                @else
                                    <div class="rounded-circle bg-light d-flex align-items-center justify-content-center" 
                                         style="width: 50px; height: 50px;">
                                        <i class="bx bx-user text-muted"></i>
                                    </div>
                                @endif
                            </td>
                            <td>{{ $member->name }}</td>
                            <td>{{ $member->position }}</td>
                            <td>
                                @if($member->department)
                                    <span class="badge bg-info">{{ $member->department }}</span>
                                @else
                                    <span class="text-muted">N/A</span>
                                @endif
                            </td>
                            <td>
                                @if($member->office_location)
                                    <small class="text-muted">{{ $member->office_location }}</small>
                                @else
                                    <span class="text-muted">N/A</span>
                                @endif
                            </td>
                            <td>
                                @if($member->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('admin.administration.edit', $member->id) }}" 
                                       class="btn btn-sm btn-warning px-3" title="Edit">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.administration.destroy', $member->id) }}" 
                                          method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete this member?')">
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
                <i class="la la-users la-4x text-muted mb-3"></i>
                <h5 class="text-muted">No Administration Members</h5>
                <p class="text-muted">Add your first administration team member.</p>
                <a href="{{ route('admin.administration.create') }}" class="btn btn-primary">
                    <i class="la la-plus"></i> Add First Member
                </a>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection