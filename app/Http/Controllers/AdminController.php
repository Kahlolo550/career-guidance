<?php

namespace App\Http\Controllers;


use App\Models\Faculty;
use App\Models\Institution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // View Admin Profile
    public function showProfile()
    {
        
        $institutions=Institution::all();
        $admin = Auth::user();
        return view('admin.profile.show', compact('admin','institutions'));
    }

    // Edit Admin Profile
    public function editProfile()
    {
        $institutions=Institution::all();
        $admin = Auth::user();
        return view('admin.profile.edit', compact('admin','institutions'));
    }

    public function updateProfile(Request $request)
    {
        
        $institutions=Institution::all();
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'phone' => 'nullable|string|max:20',
            'current_password' => 'required|string|min:8',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $admin = Auth::user();

    
        if (!Hash::check($request->current_password, $admin->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        $admin->name = $request->name;
        $admin->email = $request->email;
       

        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }

   

        $admin->save();

        return redirect()->route('admin.profile.show')->with('success', 'Profile updated successfully.');
    }
    public function createcourse()
{
    // Fetch all institutions and faculties
    $institutions = Institution::all();
    $faculties = Faculty::all();
    dd($institutions);
    $institution=institution::get();
    // Pass institutions and faculties to the view
    return view('admin.courses.create', compact('institutions', 'faculties','institution'));
}
public function getFaculties($institution_id)
{
    // Find the institution by its ID
    $institution = Institution::find($institution_id);

    // If institution exists, get the faculties for that institution
    if ($institution) {
        $faculties = $institution->faculties; 

        // Return faculties as JSON
        return response()->json(['faculties' => $faculties]);
    }

    return response()->json(['faculties' => []]); // Return empty if institution not found
}
public function showlayout(){

    $institutions=Institution::all();
   // Adjust this as per your logic
   $institutions = Institution::all();
   $faculties = Faculty::all();
   dd($institutions);
   $institution=institution::get();
    // Pass the $institution variable to the view
    return view('admin.layouts.header', compact('institutions','institution'));
}
public function index()
{
    $institutions = Institution::all();  // Assuming you have an Institution model
    return view('admin.dashboard', compact('institutions'));  // Pass institutions here
}


}


