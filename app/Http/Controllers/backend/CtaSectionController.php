<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\CtaSection;
use Illuminate\Http\Request;

class CtaSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index()
{
    // Test database connection
    try {
        $count = CtaSection::count();
        \Log::info("CTA Sections count: " . $count);
    } catch (\Exception $e) {
        \Log::error("Database error: " . $e->getMessage());
        return "Database error: " . $e->getMessage();
    }
    
    $ctaSections = CtaSection::latest()->get();
    \Log::info("Found " . $ctaSections->count() . " CTA sections");
    
    // Pass to view
    return view('backend.admin.cta_section.index', compact('ctaSections'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.admin.cta_section.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'ribbon_text' => 'nullable|string|max:255',
            'main_text' => 'required|string',
            'is_active' => 'boolean',
        ]);

        CtaSection::create([
            'ribbon_text' => $request->ribbon_text,
            'main_text' => $request->main_text,
            'is_active' => $request->is_active ?? true,
        ]);

        return redirect()->route('admin.cta-section.index')
            ->with('success', 'CTA Section created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(CtaSection $ctaSection)
    {
        // Usually not needed for admin panel, but keeping for RESTful structure
        return view('backend.admin.cta_section.show', compact('ctaSection'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CtaSection $ctaSection)
    {
        return view('backend.admin.cta_section.edit', compact('ctaSection'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CtaSection $ctaSection)
    {
        $request->validate([
            'ribbon_text' => 'nullable|string|max:255',
            'main_text' => 'required|string',
            'is_active' => 'boolean',
        ]);

        $ctaSection->update([
            'ribbon_text' => $request->ribbon_text,
            'main_text' => $request->main_text,
            'is_active' => $request->is_active ?? $ctaSection->is_active,
        ]);

        return redirect()->route('admin.cta-section.index')
            ->with('success', 'CTA Section updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CtaSection $ctaSection)
    {
        $ctaSection->delete();
        
        return redirect()->route('admin.cta-section.index')
            ->with('success', 'CTA Section deleted successfully.');
    }
}