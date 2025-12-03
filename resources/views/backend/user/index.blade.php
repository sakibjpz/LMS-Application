@extends('backend.user.master')

@section('content')

<div class="row">
    <!-- Enrolled Courses -->
    <div class="col-lg-4 responsive-column-half">
    <a href="{{ route('user.user.myCourses') }}" style="text-decoration: none; color: inherit;">
        <div class="card card-item dashboard-info-card">
            <div class="card-body d-flex align-items-center">
                <div class="icon-element flex-shrink-0 bg-1 text-white">
                    <!-- SVG icon omitted for brevity -->
                </div>
                <div class="pl-4">
                    <p class="card-text fs-18">Enrolled Courses</p>
                    <h5 class="card-title pt-2 fs-26">{{ $purchasedCourses->count() }}</h5>
                </div>
            </div>
        </div>
    </a>
</div>


    <!-- Wishlist Courses -->
    <div class="col-lg-4 responsive-column-half">
        <div class="card card-item dashboard-info-card">
            <div class="card-body d-flex align-items-center">
                <div class="icon-element flex-shrink-0 bg-2 text-white">
                    <!-- SVG icon omitted for brevity -->
                </div>
                <div class="pl-4">
                    <p class="card-text fs-18">Wishlist Courses</p>
                    <h5 class="card-title pt-2 fs-26">{{ $user->wishlist()->count() ?? 0 }}</h5>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Purchase Amount -->
    <div class="col-lg-4 responsive-column-half">
        <div class="card card-item dashboard-info-card">
            <div class="card-body d-flex align-items-center">
                <div class="icon-element flex-shrink-0 bg-3 text-white">
                    <!-- SVG icon omitted for brevity -->
                </div>
                <div class="pl-4">
                    <p class="card-text fs-18">Total Purchase Amount</p>
                    <h5 class="card-title pt-2 fs-26">
                        {{ $purchasedCourses->sum('price') ?? 0 }}
                    </h5>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
    <script src="{{ asset('customjs/user/wishlist.js') }}"></script>
    <script src="{{ asset('customjs/cart/index.js') }}"></script>
@endpush
