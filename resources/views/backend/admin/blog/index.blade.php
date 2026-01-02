@extends('backend.admin.master')

@section('content')
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Blog</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Blog Posts</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="card-title mb-0">Blog Posts</h4>
                <a href="{{ route('admin.blog.create') }}" class="btn btn-primary">
                    <i class="la la-plus"></i> Add New Post
                </a>
            </div>
            
            @if($posts->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Featured Image</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Author</th>
                            <th>Views</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($posts as $index => $post)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                @if($post->featured_image)
                                    <img src="{{ asset('storage/' . $post->featured_image) }}" 
                                         width="60" height="60" 
                                         class="rounded object-fit-cover">
                                @else
                                    <div class="bg-light d-flex align-items-center justify-content-center" 
                                         style="width: 60px; height: 60px;">
                                        <i class="bx bx-image text-muted"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <strong>{{ $post->title }}</strong><br>
                                <small class="text-muted">{{ Str::limit($post->excerpt, 50) }}</small>
                            </td>
                            <td>
                                @if($post->category)
                                    <span class="badge bg-info">{{ $post->category }}</span>
                                @else
                                    <span class="text-muted">Uncategorized</span>
                                @endif
                            </td>
                            <td>{{ $post->author ?? 'Admin' }}</td>
                            <td>{{ $post->views }}</td>
                            <td>
                                @if($post->is_published)
                                    <span class="badge bg-success">Published</span><br>
                                    <small class="text-muted">{{ $post->published_at->format('M d, Y') }}</small>
                                @else
                                    <span class="badge bg-warning">Draft</span>
                                @endif
                                
                                @if($post->is_featured)
                                    <span class="badge bg-primary mt-1">Featured</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('blog.details', $post->slug) }}" 
                                       target="_blank" class="btn btn-sm btn-info px-3" title="View">
                                        View
                                    </a>
                                    <a href="{{ route('admin.blog.edit', $post->id) }}" 
                                       class="btn btn-sm btn-warning px-3" title="Edit">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.blog.destroy', $post->id) }}" 
                                          method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete this post?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger px-3" title="Delete">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="text-center py-5">
                <i class="la la-newspaper-o la-4x text-muted mb-3"></i>
                <h5 class="text-muted">No Blog Posts</h5>
                <p class="text-muted">Create your first blog post to share with your audience.</p>
                <a href="{{ route('admin.blog.create') }}" class="btn btn-primary">
                    <i class="la la-plus"></i> Create First Post
                </a>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection