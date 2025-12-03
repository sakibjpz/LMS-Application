@extends('frontend.master')

@section('content')

@include('frontend.section.breadcrumb', ['title' => 'Checkout'])

<!-- ================================
   START CHECKOUT AREA
================================= -->
<form id="payment-form" method="post" action="{{ route('order') }}">
    @csrf

    <section class="cart-area section--padding">
        <div class="container">
            <div class="row">
                <!-- Billing & Payment -->
                <div class="col-lg-7">
                    <!-- Billing Details Card -->
                    <div class="card card-item">
                        <div class="card-body">
                            <h3 class="card-title fs-22 pb-3">Billing Details</h3>
                            <div class="divider"><span></span></div>
                            
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="row">
                                <div class="input-box col-lg-6">
                                    <label class="label-text">First Name</label>
                                    <div class="form-group">
                                        <input class="form-control form--control" type="text" name="first_name"
                                            placeholder="e.g. Alex" value="{{ $user ? $user->first_name : '' }}" required>
                                        <span class="la la-user input-icon"></span>
                                    </div>
                                </div>
                                <div class="input-box col-lg-6">
                                    <label class="label-text">Last Name</label>
                                    <div class="form-group">
                                        <input class="form-control form--control" type="text" name="last_name"
                                            placeholder="e.g. Smith" value="{{ $user ? $user->last_name : '' }}" required>
                                        <span class="la la-user input-icon"></span>
                                    </div>
                                </div>
                                <div class="input-box col-lg-12">
                                    <label class="label-text">Email Address</label>
                                    <div class="form-group">
                                        <input class="form-control form--control" type="email" name="email"
                                            placeholder="e.g. alexsmith@gmail.com"
                                            value="{{ $user ? $user->email : '' }}" required>
                                        <span class="la la-envelope input-icon"></span>
                                    </div>
                                </div>
                                <div class="input-box col-lg-12">
                                    <label class="label-text">Phone Number</label>
                                    <div class="form-group">
                                        <input id="phone" class="form-control form--control" type="tel"
                                            name="phone" value="{{ $user ? $user->phone : '' }}" required>
                                        <span class="la la-phone input-icon"></span>
                                    </div>
                                </div>
                                <div class="input-box col-lg-12">
                                    <label class="label-text">Address</label>
                                    <div class="form-group">
                                        <input class="form-control form--control" type="text" name="address"
                                            placeholder="e.g. 12345 Little Baker St, Melbourne"
                                            value="{{ $user ? $user->address : '' }}" required>
                                        <span class="la la-map-marker input-icon"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Method Card -->
                    <div class="card card-item">
                        <div class="card-body">
                            <h3 class="card-title fs-22 pb-3">Select Payment Method</h3>
                            <div class="divider"><span></span></div>
                            <div class="payment-option-wrap">
                                <div class="payment-tab">
                                    <div class="payment-tab-toggle">
                                        <input id="stripe" name="payment_type" type="radio" value="stripe">
                                        <label for="stripe">Stripe</label>
                                        <img class="payment-logo" src="{{ asset('frontend/images/stripe.png') }}" alt="">
                                    </div>
                                    <div class="payment-tab-content">
                                        <p class="fs-15 lh-24">In order to complete your transaction, we will transfer
                                            you over to Stripe's secure servers.</p>
                                    </div>
                                </div>

                                <div class="payment-tab">
                                    <div class="payment-tab-toggle">
                                        <input id="paypal" name="payment_type" type="radio" value="paypal">
                                        <label for="paypal">PayPal</label>
                                        <img class="payment-logo" src="{{ asset('frontend/images/paypal.png') }}" alt="">
                                    </div>
                                    <div class="payment-tab-content">
                                        <p class="fs-15 lh-24">In order to complete your transaction, we will transfer
                                            you over to PayPal's secure servers.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="col-lg-5">
                    <div class="card card-item">
                        <div class="card-body">
                            <h3 class="card-title fs-22 pb-3">Order Details</h3>
                            <div class="divider"><span></span></div>
                            <div class="order-details-lists">
                                @forelse($cart as $item)
                                    <div class="media media-card border-bottom border-bottom-gray pb-3 mb-3">
                                        <a href="{{ route('course-details', $item->course->course_name_slug) }}" class="media-img">
                                            <img src="{{ asset($item->course->course_image) }}" alt="Cart image">
                                        </a>

                                        <input type="hidden" name="course_id[]" value="{{ $item->course->id }}" />
                                        <input type="hidden" name="course_name[]" value="{{ $item->course->course_name }}" />
                                        <input type="hidden" name="course_image[]" value="{{ $item->course->course_image }}" />
                                        <input type="hidden" name="course_price[]" value="{{ $item->course->discount_price ?? $item->course->selling_price }}" />
                                        <input type="hidden" name="instructor_id[]" value="{{$item->course->instructor_id}}" />
                                        <div class="media-body">
                                            <h5 class="fs-15 pb-2">
                                                {{ $item->course->course_name }}
                                            </h5>
                                            <p class="text-black font-weight-semi-bold lh-18">
                                                ${{ $item->course->discount_price ?? $item->course->selling_price }}
                                            </p>
                                        </div>
                                    </div>
                                @empty
                                    <p>No Cart Data Found !</p>
                                @endforelse
                            </div>
                            <a href="/cart" class="btn-text"><i class="la la-edit mr-1"></i>Edit</a>
                        </div>
                    </div>

                    <!-- Order Summary Card -->
                    <div class="card card-item">
                        <div class="card-body">
                            <h3 class="card-title fs-22 pb-3">Order Summary</h3>
                            <div class="divider"><span></span></div>
                            <ul class="generic-list-item generic-list-item-flash fs-15">
                                <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                                    <span class="text-black">Original price:</span>
                                    <span>${{ $total }}</span>
                                    <input type="hidden" name="original_price" value="{{ $total }}" />
                                </li>

                                @if (session()->get('coupon'))
                                    <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                                        <span class="text-black">Coupon discounts:</span>
                                        <span>-${{ session()->get('coupon') }}</span>
                                    </li>
                                @endif
                                <li class="d-flex align-items-center justify-content-between font-weight-bold">
                                    <span class="text-black">Total:</span>
                                    <span>${{ $total - session()->get('coupon') }}</span>
                                    <input type="hidden" name="total_price" value="{{ $total - session()->get('coupon') }}" />
                                </li>
                            </ul>

                            <div class="btn-box border-top border-top-gray pt-3">
                                <!-- Proceed Button -->
                                <button type="submit" class="btn theme-btn w-100">
                                    Proceed <i class="la la-arrow-right icon ml-1"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- end row -->
        </div><!-- end container -->
    </section>
</form>

<!-- ================================
   Demo Payment Form (Independent)
================================= -->
<div class="container mt-3">
    <div class="card card-item">
        <div class="card-body">
            <form action="{{ route('checkout.demo') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success w-100">
                    Demo Payment
                </button>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
@endpush
