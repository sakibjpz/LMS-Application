<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\CallbackSection;
use Illuminate\Http\Request;

class CallbackSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
{
    $callbackSections = CallbackSection::latest()->get();
    return view('backend.admin.callback_section.index', compact('callbackSections'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
{
    $request->validate([
        'content_title' => 'required|string|max:255',
        'content_description' => 'required|string',
        'is_active' => 'nullable',
    ]);

    CallbackSection::create([
        'content_title' => $request->content_title,
        'content_description' => $request->content_description,
        'is_active' => $request->has('is_active'),
    ]);

    return redirect()->back()->with('success', 'Callback section saved successfully!');
}

    /**
     * Display the specified resource.
     */
    public function show(CallbackSection $callbackSection)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CallbackSection $callbackSection)
{
    return view('backend.admin.callback_section.edit', compact('callbackSection'));
}

    /**
     * Update the specified resource in storage.
     */
  public function update(Request $request, CallbackSection $callbackSection)
{
    $request->validate([
        'content_title' => 'required|string|max:255',
        'content_description' => 'required|string',
        'is_active' => 'nullable',
    ]);

    $callbackSection->update([
        'content_title' => $request->content_title,
        'content_description' => $request->content_description,
        'is_active' => $request->has('is_active'),
    ]);

    return redirect()->route('admin.callback-section.index')
        ->with('success', 'Callback section updated successfully!');
}

    /**
     * Remove the specified resource from storage.
     */
   public function destroy(CallbackSection $callbackSection)
{
    $callbackSection->delete();
    
    return redirect()->route('admin.callback-section.index')
        ->with('success', 'Callback section deleted successfully!');
}
}
