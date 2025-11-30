<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    // List all testimonials
    public function index()
    {
        $testimonials = Testimonial::all();
        return view('backend.admin.testimonials.index', compact('testimonials'));
    }

    // Show form to create a new testimonial
    public function create()
    {
        return view('backend.admin.testimonials.create');
    }

    // Store a new testimonial
    public function store(Request $request)
    {
        $request->validate([
            'author_name' => 'required|string|max:255',
            'author_designation' => 'nullable|string|max:255',
            'testimonial_text' => 'required|string',
            'author_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'video_path' => 'nullable|mimes:mp4,mov,avi|max:20000'
        ]);

        $testimonial = new Testimonial();
        $testimonial->author_name = $request->author_name;
        $testimonial->author_designation = $request->author_designation;
        $testimonial->testimonial_text = $request->testimonial_text;

        // Upload author image
        if($request->hasFile('author_image')){
            $testimonial->author_image = $request->file('author_image')->store('testimonials/images', 'public');
        }

        // Upload video
        if($request->hasFile('video_path')){
            $testimonial->video_path = $request->file('video_path')->store('testimonials/videos', 'public');
        }

        $testimonial->save();

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial created successfully.');
    }

    // Show form to edit a testimonial
    public function edit($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        return view('backend.admin.testimonials.edit', compact('testimonial'));
    }

    // Update testimonial
    public function update(Request $request, $id)
    {
        $testimonial = Testimonial::findOrFail($id);

        $request->validate([
            'author_name' => 'required|string|max:255',
            'author_designation' => 'nullable|string|max:255',
            'testimonial_text' => 'required|string',
            'author_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'video_path' => 'nullable|mimes:mp4,mov,avi|max:20000'
        ]);

        $testimonial->author_name = $request->author_name;
        $testimonial->author_designation = $request->author_designation;
        $testimonial->testimonial_text = $request->testimonial_text;

        // Replace author image if uploaded
        if($request->hasFile('author_image')){
            if($testimonial->author_image){
                Storage::disk('public')->delete($testimonial->author_image);
            }
            $testimonial->author_image = $request->file('author_image')->store('testimonials/images', 'public');
        }

        // Replace video if uploaded
        if($request->hasFile('video_path')){
            if($testimonial->video_path){
                Storage::disk('public')->delete($testimonial->video_path);
            }
            $testimonial->video_path = $request->file('video_path')->store('testimonials/videos', 'public');
        }

        $testimonial->save();

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial updated successfully.');
    }

    // Delete testimonial
    public function destroy($id)
    {
        $testimonial = Testimonial::findOrFail($id);

        if($testimonial->author_image){
            Storage::disk('public')->delete($testimonial->author_image);
        }
        if($testimonial->video_path){
            Storage::disk('public')->delete($testimonial->video_path);
        }

        $testimonial->delete();

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial deleted successfully.');
    }
}
