@extends('frontend.master')

@section('content')
<div class="container my-5">
    <h2 class="mb-4">{{ $category->name }} - Subcategories</h2>

    <div class="row">
        @foreach($category->subcategory as $sub)
            <div class="col-md-4 mb-3">
                <div class="card h-100 shadow-sm rounded-3">
                    <img src="{{ asset($sub->image ?? 'frontend/images/img2.jpg') }}" 
                         class="card-img-top" alt="{{ $sub->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $sub->name }}</h5>
                        <p class="card-text">{{ $sub->description ?? '' }}</p>
                        <a href="#" class="btn btn-primary">View Courses</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
