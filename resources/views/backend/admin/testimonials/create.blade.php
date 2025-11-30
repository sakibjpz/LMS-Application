@extends('backend.admin.master')

@section('content')
<div class="container">
    <h1>Add New Testimonial</h1>

    <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary mb-3">Back to List</a>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                   <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group mb-3">
            <label for="author_name">Author Name</label>
            <input type="text" name="author_name" class="form-control" value="{{ old('author_name') }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="author_designation">Author Designation</label>
            <input type="text" name="author_designation" class="form-control" value="{{ old('author_designation') }}">
        </div>

        <div class="form-group mb-3">
            <label for="testimonial_text">Testimonial Text</label>
            <textarea name="testimonial_text" class="form-control" rows="4" required>{{ old('testimonial_text') }}</textarea>
        </div>

        <div class="form-group mb-3">
            <label for="author_image">Author Image</label>
            <input type="file" name="author_image" class="form-control">
        </div>

        <div class="form-group mb-3">
            <label for="video_path">Video</label>
            <input type="file" name="video_path" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Save Testimonial</button>
    </form>
</div>
@endsection
