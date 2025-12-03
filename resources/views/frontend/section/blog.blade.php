{{-- resources/views/frontend/section/blog.blade.php --}}

@extends('frontend.master')

@section('content')

<style>
/* Uniform image size for all blog cards */
.blog-card-img {
    width: 100%;
    height: 200px;       /* Adjust as needed */
    object-fit: cover;   /* Crop images nicely */
}

/* Uniform card height */
.card-item {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    height: 420px;       /* Adjust as needed */
}
</style>

<section class="blog-area section--padding bg-gray overflow-hidden">
    <div class="container">
        <div class="section-heading text-center">
            <h5 class="ribbon ribbon-lg mb-2">News feeds</h5>
            <h2 class="section__title">Latest News & Articles</h2>
            <span class="section-divider"></span>
        </div><!-- end section-heading -->

        <div class="blog-post-carousel owl-action-styled half-shape mt-30px">

            {{-- Blog Card 1 --}}
            <div class="card card-item">
                <div class="card-image">
                    <a href="#" class="d-block">
                        <img class="card-img-top blog-card-img" src="{{ asset('frontend/images/update-image-2.jpg') }}" alt="Card image cap">
                    </a>
                    <div class="course-badge-labels">
                        <div class="course-badge">Jan 24, 2020</div>
                    </div>
                </div>
                <div class="card-body">
                    <h5 class="card-title"><a href="#">Sales Training: Practical Techniques</a></h5>
                    <ul class="generic-list-item generic-list-item-bullet d-flex align-items-center flex-wrap fs-14 pt-2">
                        <li>By <a href="#">TechyDevs</a></li>
                        <li><a href="#">4 Comments</a></li>
                        <li><a href="#">130 Likes</a></li>
                    </ul>
                    <div class="d-flex justify-content-between align-items-center pt-3">
                        <a href="#" class="btn theme-btn theme-btn-sm theme-btn-white">Read More <i class="la la-arrow-right icon ml-1"></i></a>
                        <div class="share-wrap">
                            <ul class="social-icons social-icons-styled">
                                <li><a href="#" class="facebook-bg"><i class="la la-facebook"></i></a></li>
                                <li><a href="#" class="twitter-bg"><i class="la la-twitter"></i></a></li>
                                <li><a href="#" class="instagram-bg"><i class="la la-instagram"></i></a></li>
                            </ul>
                            <div class="icon-element icon-element-sm shadow-sm cursor-pointer share-toggle" title="Toggle to expand social icons">
                                <i class="la la-share-alt"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Blog Card 2 --}}
            <div class="card card-item">
                <div class="card-image">
                    <a href="#" class="d-block">
                        <img class="card-img-top blog-card-img" src="{{ asset('frontend/images/update-image-3.jpg') }}" alt="Card image cap">
                    </a>
                    <div class="course-badge-labels">
                        <div class="course-badge">Jan 24, 2020</div>
                    </div>
                </div>
                <div class="card-body">
                    <h5 class="card-title"><a href="#">Ultimate Photoshop Training: From Beginner</a></h5>
                    <ul class="generic-list-item generic-list-item-bullet d-flex align-items-center flex-wrap fs-14 pt-2">
                        <li>By <a href="#">TechyDevs</a></li>
                        <li><a href="#">4 Comments</a></li>
                        <li><a href="#">130 Likes</a></li>
                    </ul>
                    <div class="d-flex justify-content-between align-items-center pt-3">
                        <a href="#" class="btn theme-btn theme-btn-sm theme-btn-white">Read More <i class="la la-arrow-right icon ml-1"></i></a>
                        <div class="share-wrap">
                            <ul class="social-icons social-icons-styled">
                                <li><a href="#" class="facebook-bg"><i class="la la-facebook"></i></a></li>
                                <li><a href="#" class="twitter-bg"><i class="la la-twitter"></i></a></li>
                                <li><a href="#" class="instagram-bg"><i class="la la-instagram"></i></a></li>
                            </ul>
                            <div class="icon-element icon-element-sm shadow-sm cursor-pointer share-toggle" title="Toggle to expand social icons">
                                <i class="la la-share-alt"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Blog Card 3 --}}
            <div class="card card-item">
                <div class="card-image">
                    <a href="#" class="d-block">
                        <img class="card-img-top blog-card-img" src="{{ asset('frontend/images/update-image-4.jpg') }}" alt="Card image cap">
                    </a>
                    <div class="course-badge-labels">
                        <div class="course-badge">Jan 24, 2020</div>
                    </div>
                </div>
                <div class="card-body">
                    <h5 class="card-title"><a href="#">Sales Training: Practical Techniques</a></h5>
                    <ul class="generic-list-item generic-list-item-bullet d-flex align-items-center flex-wrap fs-14 pt-2">
                        <li>By <a href="#">TechyDevs</a></li>
                        <li><a href="#">4 Comments</a></li>
                        <li><a href="#">130 Likes</a></li>
                    </ul>
                    <div class="d-flex justify-content-between align-items-center pt-3">
                        <a href="#" class="btn theme-btn theme-btn-sm theme-btn-white">Read More <i class="la la-arrow-right icon ml-1"></i></a>
                        <div class="share-wrap">
                            <ul class="social-icons social-icons-styled">
                                <li><a href="#" class="facebook-bg"><i class="la la-facebook"></i></a></li>
                                <li><a href="#" class="twitter-bg"><i class="la la-twitter"></i></a></li>
                                <li><a href="#" class="instagram-bg"><i class="la la-instagram"></i></a></li>
                            </ul>
                            <div class="icon-element icon-element-sm shadow-sm cursor-pointer share-toggle" title="Toggle to expand social icons">
                                <i class="la la-share-alt"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Blog Card 4 --}}
            <div class="card card-item">
                <div class="card-image">
                    <a href="#" class="d-block">
                        <img class="card-img-top blog-card-img" src="{{ asset('frontend/images/update-image-5.jpg') }}" alt="Card image cap">
                    </a>
                    <div class="course-badge-labels">
                        <div class="course-badge">Jan 24, 2020</div>
                    </div>
                </div>
                <div class="card-body">
                    <h5 class="card-title"><a href="#">Sales Training: Practical Techniques</a></h5>
                    <ul class="generic-list-item generic-list-item-bullet d-flex align-items-center flex-wrap fs-14 pt-2">
                        <li>By <a href="#">TechyDevs</a></li>
                        <li><a href="#">4 Comments</a></li>
                        <li><a href="#">130 Likes</a></li>
                    </ul>
                    <div class="d-flex justify-content-between align-items-center pt-3">
                        <a href="#" class="btn theme-btn theme-btn-sm theme-btn-white">Read More <i class="la la-arrow-right icon ml-1"></i></a>
                        <div class="share-wrap">
                            <ul class="social-icons social-icons-styled">
                                <li><a href="#" class="facebook-bg"><i class="la la-facebook"></i></a></li>
                                <li><a href="#" class="twitter-bg"><i class="la la-twitter"></i></a></li>
                                <li><a href="#" class="instagram-bg"><i class="la la-instagram"></i></a></li>
                            </ul>
                            <div class="icon-element icon-element-sm shadow-sm cursor-pointer share-toggle" title="Toggle to expand social icons">
                                <i class="la la-share-alt"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Blog Card 5 --}}
            <div class="card card-item">
                <div class="card-image">
                    <a href="#" class="d-block">
                        <img class="card-img-top blog-card-img" src="{{ asset('frontend/images/update-image-6.jpg') }}" alt="Card image cap">
                    </a>
                    <div class="course-badge-labels">
                        <div class="course-badge">Jan 24, 2020</div>
                    </div>
                </div>
                <div class="card-body">
                    <h5 class="card-title"><a href="#">Sales Training: Practical Techniques</a></h5>
                    <ul class="generic-list-item generic-list-item-bullet d-flex align-items-center flex-wrap fs-14 pt-2">
                        <li>By <a href="#">TechyDevs</a></li>
                        <li><a href="#">4 Comments</a></li>
                        <li><a href="#">130 Likes</a></li>
                    </ul>
                    <div class="d-flex justify-content-between align-items-center pt-3">
                        <a href="#" class="btn theme-btn theme-btn-sm theme-btn-white">Read More <i class="la la-arrow-right icon ml-1"></i></a>
                        <div class="share-wrap">
                            <ul class="social-icons social-icons-styled">
                                <li><a href="#" class="facebook-bg"><i class="la la-facebook"></i></a></li>
                                <li><a href="#" class="twitter-bg"><i class="la la-twitter"></i></a></li>
                                <li><a href="#" class="instagram-bg"><i class="la la-instagram"></i></a></li>
                            </ul>
                            <div class="icon-element icon-element-sm shadow-sm cursor-pointer share-toggle" title="Toggle to expand social icons">
                                <i class="la la-share-alt"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Blog Card 6 --}}
            <div class="card card-item">
                <div class="card-image">
                    <a href="#" class="d-block">
                        <img class="card-img-top blog-card-img" src="{{ asset('frontend/images/update-image-1.2.jpg') }}" alt="Card image cap">
                    </a>
                    <div class="course-badge-labels">
                        <div class="course-badge">Jan 24, 2020</div>
                    </div>
                </div>
                <div class="card-body">
                    <h5 class="card-title"><a href="#">Sales Training: Practical Techniques</a></h5>
                    <ul class="generic-list-item generic-list-item-bullet d-flex align-items-center flex-wrap fs-14 pt-2">
                        <li>By <a href="#">TechyDevs</a></li>
                        <li><a href="#">4 Comments</a></li>
                        <li><a href="#">130 Likes</a></li>
                    </ul>
                    <div class="d-flex justify-content-between align-items-center pt-3">
                        <a href="#" class="btn theme-btn theme-btn-sm theme-btn-white">Read More <i class="la la-arrow-right icon ml-1"></i></a>
                        <div class="share-wrap">
                            <ul class="social-icons social-icons-styled">
                                <li><a href="#" class="facebook-bg"><i class="la la-facebook"></i></a></li>
                                <li><a href="#" class="twitter-bg"><i class="la la-twitter"></i></a></li>
                                <li><a href="#" class="instagram-bg"><i class="la la-instagram"></i></a></li>
                            </ul>
                            <div class="icon-element icon-element-sm shadow-sm cursor-pointer share-toggle" title="Toggle to expand social icons">
                                <i class="la la-share-alt"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div><!-- end blog-post-carousel -->

    </div><!-- end container -->
</section><!-- end blog-area -->

@endsection
