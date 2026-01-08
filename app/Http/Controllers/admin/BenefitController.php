<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Benefit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BenefitController extends Controller
{
    /**
     * Show all benefits
     */
    public function index()
    {
        $benefits = Benefit::orderBy('sort_order')->get();
        return view('backend.admin.benefits.index', compact('benefits'));
    }

    /**
     * Store a new benefit
     */
    public function store(Request $request)
    {
        $request->validate([
            'icon' => 'nullable|string',
            'icon_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'title' => 'required|string',
            'description' => 'required|string',
            'icon_class' => 'nullable|string',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $data = $request->except('icon_image');

        // Handle image upload
        if ($request->hasFile('icon_image')) {
            $imagePath = $request->file('icon_image')->store('benefit-icons', 'public');
            $data['icon_image'] = 'storage/' . $imagePath;
        }

        Benefit::create($data);

        return back()->with('success', 'Benefit added successfully!');
    }

    /**
     * Update existing benefit
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'icon' => 'nullable|string',
            'icon_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'title' => 'required|string',
            'description' => 'required|string',
            'icon_class' => 'nullable|string',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
            'section_title' => 'nullable|string'
        ]);

        $benefit = Benefit::findOrFail($id);
        $data = $request->except('icon_image');

        // Handle image upload
        if ($request->hasFile('icon_image')) {
            // Delete old image if exists
            if ($benefit->icon_image && Storage::disk('public')->exists(str_replace('storage/', '', $benefit->icon_image))) {
                Storage::disk('public')->delete(str_replace('storage/', '', $benefit->icon_image));
            }
            
            $imagePath = $request->file('icon_image')->store('benefit-icons', 'public');
            $data['icon_image'] = 'storage/' . $imagePath;
        }

        $benefit->update($data);

        return back()->with('success', 'Benefit updated successfully!');
    }

    /**
     * Delete benefit
     */
    public function destroy($id)
    {
        $benefit = Benefit::findOrFail($id);
        
        // Delete associated image
        if ($benefit->icon_image && Storage::disk('public')->exists(str_replace('storage/', '', $benefit->icon_image))) {
            Storage::disk('public')->delete(str_replace('storage/', '', $benefit->icon_image));
        }
        
        $benefit->delete();

        return back()->with('success', 'Benefit removed successfully!');
    }
}