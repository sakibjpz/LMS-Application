@extends('backend.admin.master')

@section('content')
<div class="container">
    <h1>Edit Testimonial</h1>

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

    <form action="{{ route('admin.testimonials.update', $testimonial->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="author_name">Author Name</label>
            <input type="text" name="author_name" class="form-control" value="{{ old('author_name', $testimonial->author_name) }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="author_designation">Author Designation</label>
            <input type="text" name="author_designation" class="form-control" value="{{ old('author_designation', $testimonial->author_designation) }}">
        </div>

        <div class="form-group mb-3">
            <label for="testimonial_text">Testimonial Text</label>
            <textarea name="testimonial_text" class="form-control" rows="4" required>{{ old('testimonial_text', $testimonial->testimonial_text) }}</textarea>
        </div>

        <div class="form-group mb-3">
            <label for="author_image">Author Image</label>
            @if($testimonial->author_image)
                <div class="mb-2">
                    <img src="{{ asset('storage/'.$testimonial->author_image) }}" width="100" alt="Author Image">
                </div>
            @endif
            <input type="file" name="author_image" class="form-control">
        </div>

        <div class="form-group mb-3">
            <label for="video_path">Video</label>
            @if($testimonial->video_path)
                <div class="mb-2">
                    <video width="200" height="120" controls>
                        <source src="{{ asset('storage/'.$testimonial->video_path) }}" type="video/mp4">
                    </video>
                </div>
            @endif
            <input type="file" name="video_path" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Update Testimonial</button>
    </form>
</div>
@endsection
