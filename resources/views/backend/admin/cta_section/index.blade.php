@extends('backend.admin.master')


@section('content')
<div class="page-content">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Manage CTA Section</h6>
                    
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Ribbon Text</th>
                                    <th>Main Text</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($ctaSections as $ctaSection)
                                <tr>
                                    <td>{{ $ctaSection->id }}</td>
                                    <td>{{ $ctaSection->ribbon_text ?? 'N/A' }}</td>
                                    <td>{{ Str::limit($ctaSection->main_text, 50) }}</td>
                                    <td>
                                        @if($ctaSection->is_active)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>{{ $ctaSection->created_at->format('d M, Y') }}</td>
                                    <td>
                                        <a href="{{ route('admin.cta-section.edit', $ctaSection->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                    </td>
                                </tr>
                               @empty
<tr>
    <td colspan="6" class="text-center py-4">
        <div class="alert alert-info">
            <h5>No CTA Section found!</h5>
            <p>Click the button below to create your first CTA Section.</p>
            <a href="{{ route('admin.cta-section.create') }}" class="btn btn-primary mt-2">Create First CTA Section</a>
        </div>
    </td>
</tr>
@endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3">
                        <a href="{{ route('admin.cta-section.create') }}" class="btn btn-primary">Add New CTA Section</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection