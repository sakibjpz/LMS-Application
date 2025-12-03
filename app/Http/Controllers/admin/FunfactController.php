<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Funfact;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class FunfactController extends Controller
{
    /**
     * Show all funfacts
     */
    public function index()
    {
        $funfacts = Funfact::orderBy('sort_order')->get();
        return view('backend.admin.funfacts.index', compact('funfacts'));
    }

    /**
     * Store a new funfact
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'value' => 'required|integer',
            'svg_icon' => 'nullable|file|mimes:svg',
            'color_class' => 'nullable|string|max:50',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $funfact = new Funfact();
        $funfact->title = $request->title;
        $funfact->value = $request->value;
        $funfact->color_class = $request->color_class;
        $funfact->sort_order = $request->sort_order;
        $funfact->is_active = $request->has('is_active');

        // Handle SVG upload
        if ($request->hasFile('svg_icon')) {
            $file = $request->file('svg_icon');
            $filename = Str::slug($request->title) . '-' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/funfacts', $filename);
            $funfact->svg_icon = 'storage/funfacts/' . $filename;
        }

        $funfact->save();

        return redirect()->back()->with('success', 'Funfact added successfully!');
    }

    /**
     * Update existing funfact
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'value' => 'required|integer',
            'svg_icon' => 'nullable|file|mimes:svg',
            'color_class' => 'nullable|string|max:50',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $funfact = Funfact::findOrFail($id);
        $funfact->title = $request->title;
        $funfact->value = $request->value;
        $funfact->color_class = $request->color_class;
        $funfact->sort_order = $request->sort_order;
        $funfact->is_active = $request->has('is_active');

        // Handle SVG upload if new file is uploaded
        if ($request->hasFile('svg_icon')) {
            // Delete old SVG if exists
            if ($funfact->svg_icon && Storage::exists('public/funfacts/' . basename($funfact->svg_icon))) {
                Storage::delete('public/funfacts/' . basename($funfact->svg_icon));
            }

            $file = $request->file('svg_icon');
            $filename = Str::slug($request->title) . '-' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/funfacts', $filename);
            $funfact->svg_icon = 'storage/funfacts/' . $filename;
        }

        $funfact->save();

        return back()->with('success', 'Funfact updated successfully!');
    }

    /**
     * Delete funfact
     */
    public function destroy($id)
    {
        $funfact = Funfact::findOrFail($id);

        // Delete SVG file if exists
        if ($funfact->svg_icon && Storage::exists('public/funfacts/' . basename($funfact->svg_icon))) {
            Storage::delete('public/funfacts/' . basename($funfact->svg_icon));
        }

        $funfact->delete();

        return back()->with('success', 'Funfact removed successfully!');
    }
}
