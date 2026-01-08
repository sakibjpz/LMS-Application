@extends('backend.admin.master')


@section('content')
<div class="page-content">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Create CTA Section</h6>
                    
                    <form action="{{ route('admin.cta-section.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="ribbon_text" class="form-label">Ribbon Text (Optional)</label>
                            <input type="text" class="form-control" id="ribbon_text" name="ribbon_text" 
                                   placeholder="e.g., Limited Time Offer">
                            @error('ribbon_text')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="main_text" class="form-label">Main Text *</label>
                            <textarea class="form-control" id="main_text" name="main_text" rows="4" 
                                      placeholder="Enter your call-to-action text here..." required></textarea>
                            @error('main_text')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" checked>
                                <label class="form-check-label" for="is_active">Active</label>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Create CTA Section</button>
                        <a href="{{ route('admin.cta-section.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection