<section class="testimonial-section">
    <h2 class="testimonial-title">শিক্ষার্থীরা যা বলছেন</h2>



    <div class="testimonial-wrapper">
        @foreach($testimonials as $testimonial)
        <div class="testimonial-item"> <!-- ONE ITEM START -->

            <div class="testimonial-container">

                <!-- LEFT TEXT -->
                <div class="testimonial-content">
                    <p class="testimonial-text">{{ $testimonial->testimonial_text }}</p>

                    <div class="testimonial-author">
                        @if($testimonial->author_image)
                            <img src="{{ asset('storage/'.$testimonial->author_image) }}" alt="{{ $testimonial->author_name }}" class="author-image">
                        @endif

                        <div class="author-info">
                            <h4 class="author-name">{{ $testimonial->author_name }}</h4>
                            <p class="author-designation">{{ $testimonial->author_designation }}</p>
                        </div>

                        <div class="quote-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 80">
                                <path fill="#4a90e2" d="M0 50h20L10 80H0V50zm40 0h20L50 80H40V50z"/>
                                <path fill="#e91e63" d="M0 20h20L10 50H0V20zm40 0h20L50 50H40V20z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- RIGHT VIDEO -->
                <div class="testimonial-video">
                    @if($testimonial->video_path)
                        <video width="320" height="240" controls>
                            <source src="{{ asset('storage/'.$testimonial->video_path) }}" type="video/mp4">
                        </video>
                    @endif
                </div>

            </div>

        </div> <!-- ONE ITEM END -->
        @endforeach
    </div>

</section>
