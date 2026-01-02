<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Administration;
use Illuminate\Http\Request;

class AdministrationController extends Controller
{
    public function index()
    {
        $members = Administration::ordered()->get();
        return view('backend.admin.administration.index', compact('members'));
    }

    public function create()
    {
        return view('backend.admin.administration.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'department' => 'nullable|string|max:100',
            'bio' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20',
            'office_location' => 'nullable|string',
            'office_hours' => 'nullable|string',
            'years_of_service' => 'nullable|integer',
            'display_order' => 'nullable|integer',
        ]);

        $data = $request->except('photo', 'social_links');
        
        // Handle social links
        $socialLinks = [];
        if ($request->linkedin) $socialLinks['linkedin'] = $request->linkedin;
        if ($request->twitter) $socialLinks['twitter'] = $request->twitter;
        $data['social_links'] = !empty($socialLinks) ? json_encode($socialLinks) : null;
        
        // Handle photo upload
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('administration', 'public');
        }
        
        Administration::create($data);
        
        return redirect()->route('admin.administration.index')
                         ->with('success', 'Administration member added successfully');
    }

    public function show(Administration $administration)
    {
        return view('backend.admin.administration.show', compact('administration'));
    }

    public function edit(Administration $administration)
    {
        return view('backend.admin.administration.edit', compact('administration'));
    }

    public function update(Request $request, Administration $administration)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'department' => 'nullable|string|max:100',
            'bio' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20',
            'office_location' => 'nullable|string',
            'office_hours' => 'nullable|string',
            'years_of_service' => 'nullable|integer',
            'display_order' => 'nullable|integer',
        ]);

        $data = $request->except('photo', 'social_links');
        
        // Handle social links
        $socialLinks = [];
        if ($request->linkedin) $socialLinks['linkedin'] = $request->linkedin;
        if ($request->twitter) $socialLinks['twitter'] = $request->twitter;
        $data['social_links'] = !empty($socialLinks) ? json_encode($socialLinks) : null;
        
        // Handle photo upload
        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($administration->photo) {
                \Storage::disk('public')->delete($administration->photo);
            }
            $data['photo'] = $request->file('photo')->store('administration', 'public');
        }
        
        $administration->update($data);
        
        return redirect()->route('admin.administration.index')
                         ->with('success', 'Administration member updated successfully');
    }

    public function destroy(Administration $administration)
    {
        // Delete photo if exists
        if ($administration->photo) {
            \Storage::disk('public')->delete($administration->photo);
        }
        
        $administration->delete();
        
        return redirect()->route('admin.administration.index')
                         ->with('success', 'Administration member deleted successfully');
    }
}