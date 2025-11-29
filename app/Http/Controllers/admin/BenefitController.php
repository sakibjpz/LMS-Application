<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Benefit;
use Illuminate\Http\Request;

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
            'title' => 'required|string',
            'description' => 'required|string',
            'icon_class' => 'nullable|string',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        Benefit::create($request->all());

        return back()->with('success', 'Benefit added successfully!');
    }

    /**
     * Update existing benefit
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'icon' => 'nullable|string',
            'title' => 'required|string',
            'description' => 'required|string',
            'icon_class' => 'nullable|string',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $benefit = Benefit::findOrFail($id);
        $benefit->update($request->all());

        return back()->with('success', 'Benefit updated successfully!');
    }

    /**
     * Delete benefit
     */
    public function destroy($id)
    {
        $benefit = Benefit::findOrFail($id);
        $benefit->delete();

        return back()->with('success', 'Benefit removed successfully!');
    }
}
