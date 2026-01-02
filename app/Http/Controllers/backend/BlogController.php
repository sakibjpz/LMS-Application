<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\BlogImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index()
    {
        $posts = BlogPost::orderBy('created_at', 'desc')->get();
        return view('backend.admin.blog.index', compact('posts'));
    }

    public function create()
    {
        return view('backend.admin.blog.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'featured_image' => 'nullable|image|max:2048',
            'author' => 'nullable|string|max:100',
            'category' => 'nullable|string|max:100',
            'tags' => 'nullable|string',
            'read_time' => 'nullable|integer|min:1',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:255',
            'blog_images.*' => 'nullable|image|max:2048',
            'captions.*' => 'nullable|string|max:200',
        ]);

        // Create blog post
        $post = BlogPost::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . Str::random(6),
            'excerpt' => $request->excerpt,
            'content' => $request->content,
            'author' => $request->author,
            'category' => $request->category,
            'tags' => $request->tags ? explode(',', $request->tags) : null,
            'read_time' => $request->read_time,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
            'is_published' => $request->has('is_published'),
            'is_featured' => $request->has('is_featured'),
            'published_at' => $request->has('is_published') ? now() : null,
        ]);

        // Upload featured image
        if ($request->hasFile('featured_image')) {
            $post->featured_image = $request->file('featured_image')->store('blog/featured', 'public');
            $post->save();
        }

        // Upload multiple blog images
        if ($request->hasFile('blog_images')) {
            foreach ($request->file('blog_images') as $index => $image) {
                if ($image->isValid()) {
                    BlogImage::create([
                        'blog_post_id' => $post->id,
                        'image_path' => $image->store('blog/images', 'public'),
                        'caption' => $request->captions[$index] ?? null,
                        'display_order' => $index
                    ]);
                }
            }
        }

        return redirect()->route('admin.blog.index')
                         ->with('success', 'Blog post created successfully');
    }

    public function show(BlogPost $blog)
    {
        return view('backend.admin.blog.show', compact('blog'));
    }

    public function edit(BlogPost $blog)
    {
        return view('backend.admin.blog.edit', compact('blog'));
    }

    public function update(Request $request, BlogPost $blog)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'featured_image' => 'nullable|image|max:2048',
            'author' => 'nullable|string|max:100',
            'category' => 'nullable|string|max:100',
            'tags' => 'nullable|string',
            'read_time' => 'nullable|integer|min:1',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:255',
            'blog_images.*' => 'nullable|image|max:2048',
            'captions.*' => 'nullable|string|max:200',
        ]);

        // Update blog post
        $blog->update([
            'title' => $request->title,
            'excerpt' => $request->excerpt,
            'content' => $request->content,
            'author' => $request->author,
            'category' => $request->category,
            'tags' => $request->tags ? explode(',', $request->tags) : null,
            'read_time' => $request->read_time,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
            'is_published' => $request->has('is_published'),
            'is_featured' => $request->has('is_featured'),
            'published_at' => $request->has('is_published') ? ($blog->published_at ?? now()) : null,
        ]);

        // Update slug if title changed
        if ($blog->wasChanged('title')) {
            $blog->slug = Str::slug($request->title) . '-' . Str::random(6);
            $blog->save();
        }

        // Update featured image
        if ($request->hasFile('featured_image')) {
            // Delete old featured image
            if ($blog->featured_image) {
                \Storage::disk('public')->delete($blog->featured_image);
            }
            $blog->featured_image = $request->file('featured_image')->store('blog/featured', 'public');
            $blog->save();
        }

        // Upload new blog images
        if ($request->hasFile('blog_images')) {
            $currentCount = $blog->images()->count();
            foreach ($request->file('blog_images') as $index => $image) {
                if ($image->isValid()) {
                    BlogImage::create([
                        'blog_post_id' => $blog->id,
                        'image_path' => $image->store('blog/images', 'public'),
                        'caption' => $request->captions[$index] ?? null,
                        'display_order' => $currentCount + $index
                    ]);
                }
            }
        }

        return redirect()->route('admin.blog.index')
                         ->with('success', 'Blog post updated successfully');
    }

    public function destroy(BlogPost $blog)
    {
        // Delete featured image
        if ($blog->featured_image) {
            \Storage::disk('public')->delete($blog->featured_image);
        }

        // Delete blog images
        foreach ($blog->images as $image) {
            \Storage::disk('public')->delete($image->image_path);
            $image->delete();
        }

        $blog->delete();

        return redirect()->route('admin.blog.index')
                         ->with('success', 'Blog post deleted successfully');
    }

    // Delete single image
    public function deleteImage(BlogImage $image)
    {
        \Storage::disk('public')->delete($image->image_path);
        $image->delete();
        
        return response()->json(['success' => true]);
    }
}