<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Funfact;
use Illuminate\Http\Request;

class FunfactController extends Controller
{
    /**
     * Show all funfacts
     */
    public function index()
    {
        $funfacts = Funfact::orderBy('order')->get();
        return view('backend.admin.funfacts.index', compact('funfacts'));
    }

    /**
     * Store a new funfact
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'count' => 'required|string|max:50',
            'order' => 'nullable|integer',
            'is_active' => 'nullable',
        ]);

        Funfact::create([
            'title' => $request->title,
            'count' => $request->count,
            'order' => $request->order ?? 0,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->back()->with('success', 'Funfact added successfully!');
    }

    /**
     * Update existing funfact
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'count' => 'required|string|max:50',
            'order' => 'nullable|integer',
            'is_active' => 'nullable',
        ]);

        $funfact = Funfact::findOrFail($id);
        
        $funfact->update([
            'title' => $request->title,
            'count' => $request->count,
            'order' => $request->order ?? $funfact->order,
            'is_active' => $request->boolean('is_active'),
        ]);

        return back()->with('success', 'Funfact updated successfully!');
    }

    /**
     * Delete funfact
     */
    public function destroy($id)
    {
        $funfact = Funfact::findOrFail($id);
        $funfact->delete();

        return back()->with('success', 'Funfact removed successfully!');
    }
}