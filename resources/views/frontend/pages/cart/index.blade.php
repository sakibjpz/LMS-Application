@extends('frontend.master')

@section('content')
    @include('frontend.section.breadcrumb', ['title' => 'Learning Cart'])

    <!-- Cart Area -->
    <section class="cart-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="cart-table">
                        <h3 class="mb-4">Your Learning Cart</h3>
                        
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
<tr 
    data-price="{{ $item->course->discount_price && $item->course->discount_price < $item->course->selling_price 
        ? $item->course->discount_price 
        : $item->course->selling_price }}"
    data-course-id="{{ $item->course->id }}"
    data-instructor-id="{{ $item->course->user->id ?? 0 }}"
>
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
        <button type="button" 
                class="btn btn-danger btn-sm remove-course-btn" 
                data-id="{{ $item->id }}">
            Remove
        </button>
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
                                <span id="cart-subtotal" data-amount="{{ $subtotal }}">
    ${{ number_format($subtotal, 2) }}
</span>
                            </div>
                            <div class="d-flex justify-content-between mb-3">
                                <strong>Total:</strong>
                                <strong id="cart-total" data-amount="{{ $subtotal }}">
    ${{ number_format($subtotal, 2) }}
</strong>
                            </div>

<!-- Coupon Section -->
<div class="mt-3">
    <label for="coupon-code">Have a coupon?</label>
    <div class="d-flex">
        <input type="text" id="coupon-code" class="form-control" placeholder="Enter coupon code">
        <button type="button" id="apply-coupon-btn" class="btn btn-success ml-2">Apply</button>
    </div>
    <small id="coupon-message" class="text-success mt-1 d-block"></small>
</div>



                            <a href="{{ route('checkout.index') }}" class="btn btn-primary btn-block">
                                Proceed to Checkout
                            </a>
                            <a href="{{ route('courses.all') }}" class="btn btn-outline-secondary btn-block mt-2">
                                Find More Courses
                            </a>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
$(document).ready(function () {

    // ===============================
    // Remove Course from Cart (Live Update)
    // ===============================
    $(document).on('click', '.remove-course-btn', function(e) {
        e.preventDefault();

        var id   = $(this).data('id');
        var url  = '/cart/' + id;
        var $btn = $(this);
        var $row = $btn.closest('tr');

        // Prevent double click
        if ($btn.prop('disabled')) return;

        // Loading state
        $btn.prop('disabled', true).text('Removing...');

        $.ajax({
            url: url,
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            success: function(response) {

                if (response.status === 'success') {

                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: response.message || 'Course removed successfully!',
                        showConfirmButton: false,
                        timer: 3000
                    });

                    // Fade out row first, then update totals using server value
                    $row.fadeOut(300, function () {

                        // ===== Update subtotal & total using server response =====
                        if (response.subtotal !== undefined) {
                            var serverSubtotal = parseFloat(response.subtotal) || 0;

                            $('#cart-subtotal')
                                .data('amount', serverSubtotal)
                                .text('$' + serverSubtotal.toFixed(2));

                            $('#cart-total')
                                .data('amount', serverSubtotal)
                                .text('$' + serverSubtotal.toFixed(2));
                        }

                        // Remove row from DOM
                        $(this).remove();

                        // If cart becomes empty
                        if ($('tbody tr').length === 0) {
                            $('.cart-table').html(`
                                <h3 class="mb-4">Your Shopping Cart</h3>
                                <div class="alert alert-info">
                                    Your cart is empty. 
                                    <a href="{{ route('courses.all') }}">Browse courses</a>
                                </div>
                            `);

                            $('.cart-summary').hide();
                        }
                    });

                    // Update mini cart (if exists)
                    if (typeof getCart === 'function') getCart();
                    if (typeof fetchCart === 'function') fetchCart();

                } else {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'error',
                        title: response.message || 'Failed to remove course',
                        showConfirmButton: false,
                        timer: 3000
                    });

                    $btn.prop('disabled', false).text('Remove');
                }
            },

            error: function(xhr) {
                let message = xhr.responseJSON?.message || 'Something went wrong!';
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'error',
                    title: message,
                    showConfirmButton: false,
                    timer: 3000
                });

                $btn.prop('disabled', false).text('Remove');
            }
        });
    });

});

// ===============================
// Apply Coupon AJAX
// ===============================
$(document).on('click', '#apply-coupon-btn', function(e) {
    e.preventDefault();

    var coupon = $('#coupon-code').val().trim();

    if (!coupon) {
        $('#coupon-message').text('Please enter a coupon code.').removeClass('text-success').addClass('text-danger');
        return;
    }

    // Prepare course IDs and instructor IDs from cart
    var courseIds = [];
    var instructorIds = [];

    $('tbody tr').each(function() {
        courseIds.push($(this).data('course-id')); // we need to add this data attribute in each row
        instructorIds.push($(this).data('instructor-id')); // same here
    });

    $.ajax({
        url: '/apply-coupon', // make sure this route exists and points to applyCoupon
        type: 'POST',
        data: {
            coupon: coupon,
            course_id: courseIds,
            instructor_id: instructorIds,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            if (response.success) {
                $('#coupon-message').text(response.message).removeClass('text-danger').addClass('text-success');

                // Update subtotal & total
                var currentSubtotal = parseFloat($('#cart-subtotal').data('amount')) || 0;
                var discount = parseFloat(response.total_discount || 0);
                var newTotal = currentSubtotal - discount;
                newTotal = newTotal < 0 ? 0 : newTotal;

                $('#cart-total').data('amount', newTotal).text('$' + newTotal.toFixed(2));
            } else {
                $('#coupon-message').text(response.message).removeClass('text-success').addClass('text-danger');
            }
        },
        error: function(xhr) {
            var message = xhr.responseJSON?.message || 'Something went wrong!';
            $('#coupon-message').text(message).removeClass('text-success').addClass('text-danger');
        }
    });
});

</script>
@endpush
