<section class="course-area pb-120px">
    <div class="container">
        <div class="section-heading text-center">
            <h5 class="ribbon ribbon-lg mb-2">Choose your desired courses</h5>
            <h2 class="section__title">An endless catalog of skills at your fingertips</h2>
            <span class="section-divider"></span>
        </div><!-- end section-heading -->
    </div><!-- end container -->

    <div class="card-content-wrapper bg-gray pt-50px pb-120px">
        <div class="container">
            <div class="row">

                @foreach ($courses as $course)
                    <div class="col-lg-4 responsive-column-half">
                        <div class="card card-item card-preview" data-tooltip-content="#{{ $course->course_name_slug }}">
                            <div class="card-image">
                                <a href="{{ route('course-details', $course->id) }}" class="d-block">
                                    <img class="card-img-top lazy" width="240" height="240"
                                       <img class="card-img-top lazy" 
     width="240" 
     height="240"
     src="{{ asset($course->course_image) }}" 
     data-src="{{ asset($course->course_image) }}" 
     alt="{{ $course->course_name }}">


                                </a>
                                <div class="course-badge-labels">
                                    <div class="course-badge">
                                        @if ($course->bestseller == 'yes')
                                            Bestseller
                                        @elseif ($course->featured == 'yes')
                                            Featured
                                        @else
                                            HighestRated
                                        @endif
                                    </div>
                                    <div class="course-badge blue">
                                        -{{ round((($course->selling_price - $course->discount_price) / $course->selling_price) * 100) }}%
                                    </div>
                                </div>
                            </div><!-- end card-image -->

                            <div class="card-body">
                                <h6 class="ribbon ribbon-blue-bg fs-14 mb-3">All Levels</h6>
                                <h5 class="card-title">
                                    <a href="{{ route('course-details', $course->id) }}">
                                        {{ \Illuminate\Support\Str::limit($course->course_name, 50) }}
                                    </a>
                                </h5>
                                <p class="card-text">
                                    <a href="#">
                                        {{ $course['user']['name'] }}
                                    </a>
                                </p>
                                <div class="rating-wrap d-flex align-items-center py-2">
                                    <div class="review-stars">
                                        <span class="rating-number">4.4</span>
                                        <span class="la la-star"></span>
                                        <span class="la la-star"></span>
                                        <span class="la la-star"></span>
                                        <span class="la la-star"></span>
                                        <span class="la la-star-o"></span>
                                    </div>
                                    <span class="rating-total pl-1">(20,230)</span>
                                </div><!-- end rating-wrap -->
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="card-price text-black font-weight-bold">
                                        ${{ $course->discount_price }} 
                                        <span class="before-price font-weight-medium">{{ $course->selling_price }}</span>
                                    </p>
                                </div>
                            </div><!-- end card-body -->
                        </div><!-- end card -->
                    </div><!-- end col-lg-4 -->
                @endforeach

            </div><!-- end row -->

            <div class="more-btn-box mt-4 text-center">
                <a href="{{ route('courses.all') }}" class="btn theme-btn">
                    Browse all Courses <i class="la la-arrow-right icon ml-1"></i>
                </a>
            </div><!-- end more-btn-box -->
        </div><!-- end container -->
    </div><!-- end card-content-wrapper -->
</section><!-- end courses-area -->
