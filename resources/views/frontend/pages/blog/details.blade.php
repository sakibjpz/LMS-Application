@extends('frontend.master')

@section('content')

<style>
.blog-header-img {
    width: 100%;
    height: 400px;
    object-fit: cover;
}

.blog-image-gallery {
    width: 100%;
    height: 300px;
    object-fit: cover;
    border-radius: 8px;
    transition: transform 0.3s ease;
}

.blog-image-gallery:hover {
    transform: scale(1.03);
}

.author-avatar {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    object-fit: cover;
}

.content-img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
    margin: 20px 0;
}

.tag-badge {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 5px 15px;
    border-radius: 20px;
    font-size: 14px;
}

.read-time-badge {
    background-color: #f8f9fa;
    color: #666;
    padding: 5px 15px;
    border-radius: 20px;
    font-size: 14px;
}

.share-btn {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    margin: 0 5px;
    color: white;
    font-size: 18px;
}
</style>

<!-- Blog Header -->
<section class="breadcrumb-area bg-gradient py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-content text-center">
                    <h1 class="text-white mb-3">{{ $post->title }}</h1>
                    <div class="d-flex justify-content-center align-items-center flex-wrap text-white-50">
                        <div class="mr-4">
                            <i class="la la-user mr-1"></i> {{ $post->author ?? 'Admin' }}
                        </div>
                        <div class="mr-4">
                            <i class="la la-calendar mr-1"></i> {{ $post->published_at->format('F d, Y') }}
                        </div>
                        <div class="mr-4">
                            <i class="la la-eye mr-1"></i> {{ $post->views }} views
                        </div>
                        <div>
                            <i class="la la-clock mr-1"></i> {{ $post->read_time ?? 5 }} min read
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Blog Content -->
<section class="blog-details-section py-5">
    <div class="container">
        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8">
                <!-- Featured Image -->
                @if($post->featured_image)
                <div class="mb-5">
                    <img src="{{ asset('storage/' . $post->featured_image) }}" 
                         class="blog-header-img rounded shadow"
                         alt="{{ $post->title }}">
                </div>
                @endif

                <!-- Blog Meta -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        @if($post->category)
                        <span class="tag-badge mr-2">{{ $post->category }}</span>
                        @endif
                        <span class="read-time-badge">{{ $post->read_time ?? 5 }} min read</span>
                    </div>
                    <div class="share-buttons">
                        <a href="#" class="share-btn facebook-bg" title="Share on Facebook">
                            <i class="la la-facebook"></i>
                        </a>
                        <a href="#" class="share-btn twitter-bg" title="Share on Twitter">
                            <i class="la la-twitter"></i>
                        </a>
                        <a href="#" class="share-btn linkedin-bg" title="Share on LinkedIn">
                            <i class="la la-linkedin"></i>
                        </a>
                        <a href="#" class="share-btn whatsapp-bg" title="Share on WhatsApp">
                            <i class="la la-whatsapp"></i>
                        </a>
                    </div>
                </div>

                <!-- Blog Content -->
                <article class="blog-content mb-5">
                    @if($post->excerpt)
                    <div class="lead mb-4">
                        <p class="font-italic">{{ $post->excerpt }}</p>
                    </div>
                    @endif

                    <div class="content-body">
                        {!! nl2br(e($post->content)) !!}
                    </div>
                </article>

                <!-- Image Gallery -->
                @if($post->images->count() > 0)
                <div class="image-gallery mb-5">
                    <h4 class="mb-4">Gallery</h4>
                    <div class="row">
                        @foreach($post->images as $image)
                        <div class="col-md-4 mb-4">
                            <div class="gallery-item">
                                <img src="{{ asset('storage/' . $image->image_path) }}" 
                                     class="blog-image-gallery"
                                     alt="Blog image {{ $loop->iteration }}"
                                     data-toggle="modal" 
                                     data-target="#imageModal"
                                     data-src="{{ asset('storage/' . $image->image_path) }}"
                                     data-caption="{{ $image->caption }}">
                                @if($image->caption)
                                <p class="text-center text-muted mt-2 mb-0"><small>{{ $image->caption }}</small></p>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Tags -->
                @if($post->tags && count($post->tags) > 0)
                <div class="tags-section mb-5">
                    <h5 class="mb-3">Tags</h5>
                    <div class="tag-cloud">
                        @foreach($post->tags as $tag)
                        <a href="#" class="btn btn-sm btn-outline-secondary mb-2 mr-2">{{ $tag }}</a>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Author Bio -->
                <div class="author-card card shadow-sm mb-5">
                    <div class="card-body">
                        <div class="media">
                            <div class="mr-3">
                                <img src="{{ asset('frontend/images/default-avatar.jpg') }}" 
                                     class="author-avatar"
                                     alt="{{ $post->author ?? 'Admin' }}">
                            </div>
                            <div class="media-body">
                                <h5 class="mt-0">{{ $post->author ?? 'Admin' }}</h5>
                                <p class="text-muted mb-2">Blog Author</p>
                                <p>Experienced writer sharing insights on {{ $post->category ?? 'various topics' }}.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Related Posts -->
                @if($relatedPosts->count() > 0)
                <div class="related-posts mb-5">
                    <h4 class="mb-4">Related Posts</h4>
                    <div class="row">
                        @foreach($relatedPosts as $relatedPost)
                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                @if($relatedPost->featured_image)
                                <img src="{{ asset('storage/' . $relatedPost->featured_image) }}" 
                                     class="card-img-top"
                                     alt="{{ $relatedPost->title }}"
                                     style="height: 180px; object-fit: cover;">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <a href="{{ route('blog.details', $relatedPost->slug) }}" class="text-dark">
                                            {{ Str::limit($relatedPost->title, 50) }}
                                        </a>
                                    </h5>
                                    <p class="card-text text-muted">
                                        <small>{{ $relatedPost->published_at->format('M d, Y') }}</small>
                                    </p>
                                    <a href="{{ route('blog.details', $relatedPost->slug) }}" class="btn btn-sm btn-outline-primary">
                                        Read More
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Recent Posts -->
                @if($recentPosts->count() > 0)
                <div class="card mb-4">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Recent Posts</h5>
                    </div>
                    <div class="card-body">
                        @foreach($recentPosts as $recent)
                        <div class="media mb-3">
                            @if($recent->featured_image)
                            <img src="{{ asset('storage/' . $recent->featured_image) }}" 
                                 class="mr-3 rounded" 
                                 width="60" height="60" 
                                 style="object-fit: cover;"
                                 alt="{{ $recent->title }}">
                            @else
                            <div class="mr-3 bg-light rounded d-flex align-items-center justify-content-center" 
                                 style="width: 60px; height: 60px;">
                                <i class="la la-file-text text-muted"></i>
                            </div>
                            @endif
                            <div class="media-body">
                                <h6 class="mt-0 mb-1">
                                    <a href="{{ route('blog.details', $recent->slug) }}" class="text-dark">
                                        {{ Str::limit($recent->title, 40) }}
                                    </a>
                                </h6>
                                <small class="text-muted">{{ $recent->published_at->format('M d, Y') }}</small>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Categories -->
                @php
                    $allCategories = \App\Models\BlogPost::published()
                                                         ->select('category')
                                                         ->distinct()
                                                         ->pluck('category');
                @endphp
                
                @if($allCategories->count() > 0)
                <div class="card mb-4">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Categories</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled mb-0">
                            @foreach($allCategories as $category)
                            <li class="mb-2">
                                <a href="#" class="text-dark d-flex justify-content-between align-items-center">
                                    <span>{{ $category }}</span>
                                    <span class="badge badge-light">
                                        {{ \App\Models\BlogPost::published()->where('category', $category)->count() }}
                                    </span>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif

                <!-- Popular Tags -->
                @php
                    $popularTags = [];
                    $allPosts = \App\Models\BlogPost::published()->get();
                    foreach($allPosts as $p) {
                        if($p->tags && is_array($p->tags)) {
                            $popularTags = array_merge($popularTags, $p->tags);
                        }
                    }
                    $tagCounts = array_count_values($popularTags);
                    arsort($tagCounts);
                    $topTags = array_slice(array_keys($tagCounts), 0, 10);
                @endphp
                
                @if(!empty($topTags))
                <div class="card">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Popular Tags</h5>
                    </div>
                    <div class="card-body">
                        <div class="tag-cloud">
                            @foreach($topTags as $tag)
                            <a href="#" class="btn btn-sm btn-outline-secondary mb-2 mr-2">{{ $tag }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Image Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Image Preview</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <img id="modalImage" src="" class="img-fluid" alt="">
                <p id="modalCaption" class="mt-3 text-muted"></p>
            </div>
        </div>
    </div>
</div>

<script>
// Image Modal
$('#imageModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var imageSrc = button.data('src');
    var caption = button.data('caption');
    
    var modal = $(this);
    modal.find('#modalImage').attr('src', imageSrc);
    modal.find('#modalCaption').text(caption || '');
});

// Share buttons
document.querySelectorAll('.share-btn').forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        const url = window.location.href;
        const title = document.title;
        
        if (this.classList.contains('facebook-bg')) {
            window.open(`https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}`, '_blank');
        } else if (this.classList.contains('twitter-bg')) {
            window.open(`https://twitter.com/intent/tweet?url=${encodeURIComponent(url)}&text=${encodeURIComponent(title)}`, '_blank');
        } else if (this.classList.contains('linkedin-bg')) {
            window.open(`https://www.linkedin.com/shareArticle?mini=true&url=${encodeURIComponent(url)}&title=${encodeURIComponent(title)}`, '_blank');
        } else if (this.classList.contains('whatsapp-bg')) {
            window.open(`https://wa.me/?text=${encodeURIComponent(title + ' ' + url)}`, '_blank');
        }
    });
});
</script>

@endsection