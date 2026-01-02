@extends('frontend.master')

@section('content')

<style>
.blog-card-img {
    width: 100%;
    height: 200px;
    object-fit: cover;
}

.card-item {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    height: 420px;
}

.badge-category {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.read-time-badge {
    background-color: #f8f9fa;
    color: #666;
    font-size: 12px;
}

.views-count {
    color: #666;
    font-size: 14px;
}
</style>

<section class="blog-area section--padding bg-gray overflow-hidden">
    <div class="container">
        <div class="section-heading text-center">
            <h5 class="ribbon ribbon-lg mb-2">News feeds</h5>
            <h2 class="section__title">Latest News & Articles</h2>
            <span class="section-divider"></span>
        </div><!-- end section-heading -->

        <!-- Featured Posts Carousel -->
        @if($featuredPosts->count() > 0)
        <div class="blog-post-carousel owl-action-styled half-shape mt-30px">
            @foreach($featuredPosts as $post)
            <div class="card card-item">
                <div class="card-image">
                    <a href="{{ route('blog.details', $post->slug) }}" class="d-block">
                        @if($post->featured_image)
                            <img class="card-img-top blog-card-img" src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}">
                        @else
                            <img class="card-img-top blog-card-img" src="{{ asset('frontend/images/default-blog.jpg') }}" alt="{{ $post->title }}">
                        @endif
                    </a>
                    <div class="course-badge-labels">
                        <div class="course-badge">{{ $post->published_at->format('M d, Y') }}</div>
                        @if($post->category)
                            <div class="course-badge badge-category ml-1">{{ $post->category }}</div>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="{{ route('blog.details', $post->slug) }}">{{ $post->title }}</a>
                    </h5>
                    
                    @if($post->excerpt)
                    <p class="card-text text-muted mb-2">{{ Str::limit($post->excerpt, 100) }}</p>
                    @endif
                    
                    <ul class="generic-list-item generic-list-item-bullet d-flex align-items-center flex-wrap fs-14 pt-2">
                        <li>By <a href="#">{{ $post->author ?? 'Admin' }}</a></li>
                        <li><span class="read-time-badge">{{ $post->read_time ?? 5 }} min read</span></li>
                        <li><span class="views-count">{{ $post->views }} views</span></li>
                    </ul>
                    
                    <div class="d-flex justify-content-between align-items-center pt-3">
                        <a href="{{ route('blog.details', $post->slug) }}" class="btn theme-btn theme-btn-sm theme-btn-white">
                            Read More <i class="la la-arrow-right icon ml-1"></i>
                        </a>
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
            @endforeach
        </div><!-- end blog-post-carousel -->
        @endif

        <!-- Main Blog Grid -->
        <div class="row mt-5">
            <!-- Blog Posts -->
            <div class="col-lg-8">
                <div class="row">
                    @forelse($posts as $post)
                    <div class="col-lg-6 col-md-6 mb-4">
                        <div class="card card-item h-100">
                            <div class="card-image">
                                <a href="{{ route('blog.details', $post->slug) }}" class="d-block">
                                    @if($post->featured_image)
                                        <img class="card-img-top blog-card-img" src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}">
                                    @else
                                        <img class="card-img-top blog-card-img" src="{{ asset('frontend/images/default-blog.jpg') }}" alt="{{ $post->title }}">
                                    @endif
                                </a>
                                <div class="course-badge-labels">
                                    <div class="course-badge">{{ $post->published_at->format('M d, Y') }}</div>
                                    @if($post->category)
                                        <div class="course-badge badge-category ml-1">{{ $post->category }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="{{ route('blog.details', $post->slug) }}">{{ Str::limit($post->title, 60) }}</a>
                                </h5>
                                
                                @if($post->excerpt)
                                <p class="card-text text-muted mb-2">{{ Str::limit($post->excerpt, 80) }}</p>
                                @endif
                                
                                <ul class="generic-list-item generic-list-item-bullet d-flex align-items-center flex-wrap fs-14 pt-2">
                                    <li>By <a href="#">{{ $post->author ?? 'Admin' }}</a></li>
                                    <li><span class="read-time-badge">{{ $post->read_time ?? 5 }} min read</span></li>
                                </ul>
                            </div>
                            <div class="card-footer bg-white border-top-0">
                                <a href="{{ route('blog.details', $post->slug) }}" class="btn btn-outline-primary btn-sm btn-block">
                                    Read More <i class="la la-arrow-right ml-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-lg-12">
                        <div class="text-center py-5">
                            <i class="la la-newspaper-o la-4x text-muted mb-3"></i>
                            <h4 class="text-muted">No Blog Posts Yet</h4>
                            <p class="text-muted">Check back soon for our latest articles and updates.</p>
                        </div>
                    </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                @if($posts->hasPages())
                <div class="row mt-4">
                    <div class="col-lg-12">
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-center">
                                {{ $posts->links() }}
                            </ul>
                        </nav>
                    </div>
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Categories Widget -->
                @if($categories->count() > 0)
                <div class="card mb-4">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Categories</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled mb-0">
                            @foreach($categories as $category)
                            <li class="mb-2">
                                <a href="#" class="text-dark d-flex justify-content-between align-items-center">
                                    <span>{{ $category }}</span>
                                    <span class="badge badge-light">{{ \App\Models\BlogPost::published()->where('category', $category)->count() }}</span>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif

                <!-- Recent Posts -->
                @if($featuredPosts->count() > 0)
                <div class="card mb-4">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Recent Posts</h5>
                    </div>
                    <div class="card-body">
                        @foreach($featuredPosts->take(3) as $post)
                        <div class="media mb-3">
                            @if($post->featured_image)
                            <img src="{{ asset('storage/' . $post->featured_image) }}" 
                                 class="mr-3 rounded" 
                                 width="60" height="60" 
                                 alt="{{ $post->title }}">
                            @else
                            <div class="mr-3 bg-light rounded d-flex align-items-center justify-content-center" 
                                 style="width: 60px; height: 60px;">
                                <i class="la la-file-text text-muted"></i>
                            </div>
                            @endif
                            <div class="media-body">
                                <h6 class="mt-0 mb-1">
                                    <a href="{{ route('blog.details', $post->slug) }}" class="text-dark">
                                        {{ Str::limit($post->title, 40) }}
                                    </a>
                                </h6>
                                <small class="text-muted">{{ $post->published_at->format('M d, Y') }}</small>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Tags Widget -->
                @php
                    $allTags = [];
                    foreach($posts as $post) {
                        if($post->tags && is_array($post->tags)) {
                            $allTags = array_merge($allTags, $post->tags);
                        }
                    }
                    $uniqueTags = array_unique($allTags);
                @endphp
                
                @if(!empty($uniqueTags))
                <div class="card">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Popular Tags</h5>
                    </div>
                    <div class="card-body">
                        <div class="tag-cloud">
                            @foreach(array_slice($uniqueTags, 0, 10) as $tag)
                            <a href="#" class="btn btn-sm btn-outline-secondary mb-2 mr-2">{{ $tag }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end blog-area -->

@endsection