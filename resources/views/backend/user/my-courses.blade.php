@extends('backend.user.master')

@section('content')
<div class="page-content">

    <h3>My Courses</h3>

    <div class="row">
        @forelse($courses as $course)
        <div class="col-md-4">
            <div class="card mb-3">
                <img src="{{ asset($course->thumbnail) }}" class="card-img-top">
                <div class="card-body">
                    <h5>{{ $course->title }}</h5>

                  <a href="{{ route('user.course.learn', $course->id) }}" class="btn btn-primary">
    Continue Learning
</a>

                </div>
            </div>
        </div>
        @empty
        <p>No courses enrolled yet.</p>
        @endforelse
    </div>

</div>
@endsection
