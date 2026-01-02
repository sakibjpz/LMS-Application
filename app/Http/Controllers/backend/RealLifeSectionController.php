<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\RealLifeSection;
use Illuminate\Http\Request;

class RealLifeSectionController extends Controller
{
    public function index()
    {
        $sections = RealLifeSection::ordered()->get();
        return view('backend.admin.real-life-section.index', compact('sections'));
    }

    public function create()
    {
        return view('backend.admin.real-life-section.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'button_text' => 'nullable|string|max:50',
            'button_link' => 'nullable|string|max:255',
            'display_order' => 'nullable|integer',
        ]);

        $data = $request->only([
            'title', 'description', 'button_text', 
            'button_link', 'display_order'
        ]);
        
        // Handle image upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $data['image'] = $file->storeAs('real-life-sections', $fileName, 'public');
        }
        
        // Set active status
        $data['is_active'] = $request->has('is_active');
        
        RealLifeSection::create($data);
        
        return redirect()->route('admin.real-life-section.index')
                         ->with('success', 'Real Life Section added successfully');
    }

    public function edit(RealLifeSection $real_life_section)
    {
        return view('backend.admin.real-life-section.edit', compact('real_life_section'));
    }

    public function update(Request $request, RealLifeSection $real_life_section)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'button_text' => 'nullable|string|max:50',
            'button_link' => 'nullable|string|max:255',
            'display_order' => 'nullable|integer',
        ]);

        $data = $request->only([
            'title', 'description', 'button_text', 
            'button_link', 'display_order'
        ]);
        
        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($real_life_section->image) {
                \Storage::disk('public')->delete($real_life_section->image);
            }

            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $data['image'] = $file->storeAs('real-life-sections', $fileName, 'public');
        }

        // Set active status
        $data['is_active'] = $request->boolean('is_active');
        
        $real_life_section->update($data);
        
        return redirect()->route('admin.real-life-section.index')
                         ->with('success', 'Real Life Section updated successfully');
    }

    public function destroy(RealLifeSection $realLifeSection)
    {
        // Delete image if exists
        if ($realLifeSection->image) {
            \Storage::disk('public')->delete($realLifeSection->image);
        }
        
        $realLifeSection->delete();
        
        return redirect()->route('admin.real-life-section.index')
                         ->with('success', 'Real Life Section deleted successfully');
    }
}
