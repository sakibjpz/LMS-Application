@extends('frontend.master')

@section('content')
    @include('frontend.section.breadcrumb', ['title' => 'Shopping Cart'])

    <!-- Cart Area -->
    <section class="cart-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="cart-table">
                        <h3 class="mb-4">Your Shopping Cart</h3>
                        
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        
                        @if($cartItems->count() > 0)
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Course</th>
                                        <th>Price</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cartItems as $item)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset($item->course->course_image) }}" 
                                                     alt="{{ $item->course->course_title }}" 
                                                     width="80" class="mr-3">
                                                <div>
                                                    <h6 class="mb-1">{{ $item->course->course_title }}</h6>
                                                    <small class="text-muted">By {{ $item->course->user->name ?? 'Instructor' }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            @if($item->course->discount_price && $item->course->discount_price < $item->course->selling_price)
                                                <span class="text-primary">${{ number_format($item->course->discount_price, 2) }}</span>
                                                <small class="text-muted"><del>${{ number_format($item->course->selling_price, 2) }}</del></small>
                                            @else
                                                <span>${{ number_format($item->course->selling_price, 2) }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ route('cart.remove', $item->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="alert alert-info">
                                Your cart is empty. <a href="{{ route('courses.all') }}">Browse courses</a>
                            </div>
                        @endif
                    </div>
                </div>
                
                <div class="col-lg-4">
                    @if($cartItems->count() > 0)
                    <div class="cart-summary card">
                        <div class="card-body">
                            <h5 class="card-title">Order Summary</h5>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Subtotal:</span>
                                <span>${{ number_format($subtotal, 2) }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-3">
                                <strong>Total:</strong>
                                <strong>${{ number_format($subtotal, 2) }}</strong>
                            </div>
                            <a href="{{ route('checkout.index') }}" class="btn btn-primary btn-block">
                                Proceed to Checkout
                            </a>
                            <a href="{{ route('courses.all') }}" class="btn btn-outline-secondary btn-block mt-2">
                                Continue Shopping
                            </a>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

@endsection