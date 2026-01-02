<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\ItDepartment;
use Illuminate\Http\Request;

class ItDepartmentController extends Controller
{
    public function index()
    {
        $members = ItDepartment::ordered()->get();
        return view('backend.admin.it-department.index', compact('members'));
    }

    public function create()
    {
        return view('backend.admin.it-department.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20',
            'expertise' => 'nullable|string',
            'experience_years' => 'nullable|integer',
            'display_order' => 'nullable|integer',
        ]);

        $data = $request->except('photo', 'social_links');
        
        // Handle social links
        $socialLinks = [];
        if ($request->linkedin) $socialLinks['linkedin'] = $request->linkedin;
        if ($request->github) $socialLinks['github'] = $request->github;
        if ($request->twitter) $socialLinks['twitter'] = $request->twitter;
        $data['social_links'] = !empty($socialLinks) ? json_encode($socialLinks) : null;
        
        // Handle photo upload
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('it-department', 'public');
        }
        
        ItDepartment::create($data);
        
        return redirect()->route('admin.it-department.index')
                         ->with('success', 'IT Department member added successfully');
    }

    public function show(ItDepartment $itDepartment)
    {
        return view('backend.admin.it-department.show', compact('itDepartment'));
    }

    public function edit(ItDepartment $itDepartment)
    {
        return view('backend.admin.it-department.edit', compact('itDepartment'));
    }

    public function update(Request $request, ItDepartment $itDepartment)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20',
            'expertise' => 'nullable|string',
            'experience_years' => 'nullable|integer',
            'display_order' => 'nullable|integer',
        ]);

        $data = $request->except('photo', 'social_links');
        
        // Handle social links
        $socialLinks = [];
        if ($request->linkedin) $socialLinks['linkedin'] = $request->linkedin;
        if ($request->github) $socialLinks['github'] = $request->github;
        if ($request->twitter) $socialLinks['twitter'] = $request->twitter;
        $data['social_links'] = !empty($socialLinks) ? json_encode($socialLinks) : null;
        
        // Handle photo upload
        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($itDepartment->photo) {
                \Storage::disk('public')->delete($itDepartment->photo);
            }
            $data['photo'] = $request->file('photo')->store('it-department', 'public');
        }
        
        $itDepartment->update($data);
        
        return redirect()->route('admin.it-department.index')
                         ->with('success', 'IT Department member updated successfully');
    }

    public function destroy(ItDepartment $itDepartment)
    {
        // Delete photo if exists
        if ($itDepartment->photo) {
            \Storage::disk('public')->delete($itDepartment->photo);
        }
        
        $itDepartment->delete();
        
        return redirect()->route('admin.it-department.index')
                         ->with('success', 'IT Department member deleted successfully');
    }
}