@extends('backend.admin.master')

@section('content')
<div class="container">
    <h1>Manage Testimonials</h1>
    <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary mb-3">Add New Testimonial</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Author Name</th>
                <th>Designation</th>
                <th>Text</th>
                <th>Author Image</th>
                <th>Video</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($testimonials as $testimonial)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $testimonial->author_name }}</td>
                <td>{{ $testimonial->author_designation }}</td>
                <td>{{ Str::limit($testimonial->testimonial_text, 50) }}</td>
                <td>
                    @if($testimonial->author_image)
                        <img src="{{ asset('storage/'.$testimonial->author_image) }}" alt="{{ $testimonial->author_name }}" width="50">
                    @endif
                </td>
                <td>
                    @if($testimonial->video_path)
                        <video width="100" height="60" controls>
                            <source src="{{ asset('storage/'.$testimonial->video_path) }}" type="video/mp4">
                        </video>
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.testimonials.edit', $testimonial->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.testimonials.destroy', $testimonial->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
