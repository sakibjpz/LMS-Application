<div class="card card-item">
    <div class="card-body">
        <div class="preview-course-video">
            <a href="javascript:void(0)" data-toggle="modal" data-target="#previewModal">
                <img src="{{ asset($course->course_image) }}"
                     data-src="{{ asset($course->course_image) }}" alt="course-img"
                     class="w-100 rounded lazy">

                <div class="preview-course-video-content">
                    <div class="overlay"></div>
                    <div class="play-button">
                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" x="0px"
                             y="0px" viewBox="-307.4 338.8 91.8 91.8"
                             style="enable-background:new -307.4 338.8 91.8 91.8;"
                             xml:space="preserve">
                            <style type="text/css">
                                .st0 { fill: #ffffff; border-radius: 100px; }
                                .st1 { fill: #000000; }
                            </style>
                            <g>
                                <circle class="st0" cx="-261.5" cy="384.7" r="45.9"></circle>
                                <path class="st1"
                                      d="M-272.9,363.2l35.8,20.7c0.7,0.4,0.7,1.3,0,1.7l-35.8,20.7c-0.7,0.4-1.5-0.1-1.5-0.9V364C-274.4,363.3-273.5,362.8-272.9,363.2z">
                                </path>
                            </g>
                        </svg>
                    </div>
                    <p class="fs-15 font-weight-bold text-white pt-3">Preview this course</p>
                </div>
            </a>
        </div><!-- end preview-course-video -->

       <div class="preview-course-feature-content pt-40px">
    <p class="d-flex align-items-center pb-2">
        @if($course->discount_price && $course->discount_price < $course->selling_price)
            <!-- Show discounted price -->
            <span class="fs-35 font-weight-semi-bold text-black">${{ number_format($course->discount_price, 2) }}</span>
            <span class="before-price mx-1">${{ number_format($course->selling_price, 2) }}</span>
            
            @php
                $discountPercentage = round((($course->selling_price - $course->discount_price) / $course->selling_price) * 100);
            @endphp
            <span class="price-discount">{{ $discountPercentage }}% off</span>
        @else
            <!-- Show regular price -->
            <span class="fs-35 font-weight-semi-bold text-black">${{ number_format($course->selling_price, 2) }}</span>
        @endif
    </p>
    
    @if($course->discount_price && $course->discount_price < $course->selling_price)
        <p class="preview-price-discount-text pb-35px">
            <!-- You can add discount end date logic here if you have discount_end_date field -->
            <span class="text-color-3">Limited time</span> offer!
        </p>
    @endif
            <!-- ===== Updated Buy / Cart Buttons ===== -->
            <div class="buy-course-btn-box">
                @auth
                    @if(auth()->user()->hasPurchased($course->id))
                        <!-- User already purchased -->
                        <a href="{{ url('course/learn/'.$course->id) }}" class="btn theme-btn w-100 mb-2">
                            <i class="la la-play-circle mr-1"></i> Continue Learning
                        </a>
                    @else
                        <!-- Not purchased -->
                        <form action="{{ route('cart.add') }}" method="POST" class="mb-2">
                            @csrf
                            <input type="hidden" name="course_id" value="{{ $course->id }}">
                            <button type="submit" class="btn theme-btn w-100">
                                <i class="la la-shopping-cart fs-18 mr-1"></i> Add to Cart
                            </button>
                        </form>

                        <a href="{{ route('checkout.index') }}" class="btn theme-btn w-100 theme-btn-white mb-2">
                            <i class="la la-shopping-bag mr-1"></i> Buy This Course
                        </a>
                    @endif
                @else
                    <!-- Not logged in -->
                    <a href="{{ route('login') }}" class="btn theme-btn w-100 mb-2">
                        Login to Buy
                    </a>
                @endauth
            </div>
            <!-- ===== End Buy / Cart Buttons ===== -->

            <p class="fs-14 text-center pb-4">30-Day Money-Back Guarantee</p>

          <div class="preview-course-incentives">
    <h3 class="card-title fs-18 pb-2">This course includes</h3>
    <ul class="generic-list-item pb-3">
        {{-- @if($course->duration)
            <li><i class="la la-play-circle-o mr-2 text-color"></i>{{ $course->duration }} hours on-demand video</li>
        @endif
         --}}
        @if($course->resources)
            <li><i class="la la-file-text mr-2 text-color"></i>{{ $course->resources }} downloadable resources</li>
        @endif
        
        <li><i class="la la-key mr-2 text-color"></i>Full lifetime access</li>
        {{-- <li><i class="la la-television mr-2 text-color"></i>Access on mobile and TV</li> --}}
        
        @if($course->certificate == 'yes')
            <li><i class="la la-certificate mr-2 text-color"></i>Certificate of Completion</li>
        @endif
    </ul>
    <div class="section-block"></div>
    <!-- Removed "Training 5 or more people" section -->
</div>
<!-- end preview-course-incentives -->
        </div><!-- end preview-course-content -->
    </div>
</div><!-- end card -->
