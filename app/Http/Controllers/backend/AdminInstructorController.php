<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminInstructorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all_instructors = User::where('role', 'instructor')->latest()->get();
        return view('backend.admin.instructor.index', compact('all_instructors'));
    }


    public function updateStatus(Request $request)
    {
        $user = User::find($request->user_id);
        if ($user) {
            $user->status = $request->status;
            $user->save();

            return response()->json(['success' => true, 'message' => 'User status updated successfully!']);
        }

        return response()->json(['success' => false, 'message' => 'User not found!']);
    }

    public function instructorActive(Request $request){
        $active_instructor = User::where('status', '1')->where('role', 'instructor')->latest()->get();
        return view('backend.admin.instructor.active', compact('active_instructor'));
    }

    public function trainers()
{
    $trainers = User::where('role', 'instructor')->get();
    return view('backend.admin.team.trainers', compact('trainers'));
}

    public function edit($id)
{
    $instructor = User::findOrFail($id);
    return view('backend.admin.instructor.edit', compact('instructor'));
}

public function update(Request $request, $id)
{
    $instructor = User::findOrFail($id);
    
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $id,
        'phone' => 'nullable|string|max:20',
        'bio' => 'nullable|string',
        'address' => 'nullable|string',
    ]);
    
    $instructor->update($request->all());
    
    return redirect()->route('admin.instructor.index')
                     ->with('success', 'Instructor profile updated successfully');
}


public function create()
{
    return view('backend.admin.instructor.create');
}

public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:8|confirmed',
        'phone' => 'nullable|string|max:20',
        'bio' => 'nullable|string',
    ]);
    
    $instructor = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'phone' => $request->phone,
        'bio' => $request->bio,
        'role' => 'instructor',
        'status' => 1,
    ]);
    
    return redirect()->route('admin.instructor.index')
                     ->with('success', 'Instructor created successfully');
}


}
