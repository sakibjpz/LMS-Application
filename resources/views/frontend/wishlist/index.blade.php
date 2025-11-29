@extends('frontend.master')

@section('content')
<div class="container py-5">
    <h2>Your Wishlist</h2>
    <hr>

    <div class="row">
        @forelse($wishlistItems as $item)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <img src="{{ asset($item->course->course_image) }}" class="card-img-top" alt="Course Image">

                    <div class="card-body">
                        <h5>{{ $item->course->course_name }}</h5>
                        <p class="text-muted">{{ $item->course->user->name }}</p>

                        <p>
                            <strong>${{ $item->course->selling_price }}</strong>
                            <span class="text-danger"><del>${{ $item->course->discount_price }}</del></span>
                        </p>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p>No items in your wishlist.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
