<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Faculty;
use App\Models\Application;
use App\Models\Institution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class InstitutionController extends Controller
{

    // Home page for the institution
    public function home()
{
    $institution = Auth::guard('institution')->user();

    $faculties = $institution->faculties ?? [];
    $courses = $institution->courses ?? [];
    $admissions = $institution->admissions ??[];
    $faculties = Faculty::all();

    return view('institution.home', compact('institution', 'faculties', 'courses','admissions'));
}


    // Show form to create a faculty
    public function createFaculty()
    {
        
       $faculties=Faculty::all();
       
    $institution = auth()->guard('institution')->user();
        return view('institution.faculties.create', compact('institution','faculties'));
    }

    // Store a new faculty
    public function storeFaculty(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $faculties = Faculty::all();
        $institution = Auth::guard('institution')->user();
        Faculty::create([
            'name' => $request->name,
            'institution_id' => $institution->id, 
        ]);

        return redirect()->back()->with('success', 'Faculty created successfully!');
    }

    public function createCourse()
    {
       $faculties=Faculty::all();
    $institution = auth()->guard('institution')->user(); 
    return view('institution.courses.create', compact('institution','faculties'));
    }

    
    public function storeCourse(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'faculty_id' => 'required|exists:faculties,id', 
        ]);

        Course::create([
            'name' => $request->name,
            'faculty_id' => $request->faculty_id,
        ]);

        return redirect()->back()->with('success', 'Course created successfully!');
    }
    public function index()
{
    $institutions = Institution::all();
    return view('admin.institutions.index', compact('institutions'));
}

public function create()
{
    return view('admin.institutions.create');
}

public function store(Request $request)
{
    $request->validate(['name' => 'required']);
    Institution::create(['name' => $request->name]);
    return redirect()->route('institutions.index')->with('success','Institution added successfully');
}

public function edit($id){
    $institutions = Institution::firstOrFail($id);

    return view('admin.institutions.index', compact('institutions'));
}

public function update(Request $request, $id)
{
    $institutions = Institution::findOrFail($id);
    $institutions->update($request->all());

    return redirect()->route('institutions.index')->with('success','Item updated');
}


public function show($id)
{   $institutions=Institution::all();
    $institution = Institution::with(['faculties', ])->findOrFail($id);
    return view('admin.institutions.show', compact('institution','institutions'));
}


public function destroy($id)
{
    $institution = Institution::findOrFail($id);
    $institution->delete(); 
    return redirect()->route('institutions.index');
}




public function dashboard()
{
    $faculties = Faculty::all();
    $institution = auth()->user()->institution;
    $course = Course::find(1); // Or fetch the relevant course for the user

    $applications = Application::whereHas('course', function($query) use ($institution) {
        $query->where('institution_id', $institution->id);
    })->get();

    return view('institution.home', compact('institution', 'applications', 'faculties', 'course')); // Pass $course here
}


public function showApplications($institutionId)
{
    $institution = Institution::findOrFail($institutionId);
    $applications = Application::whereHas('course', function($query) use ($institutionId) {
        $query->where('institution_id', $institutionId);
    })->get();
    
    $faculties=Faculty::all();

    return view('institution.applications.index', compact('institution', 'applications','faculties'));
}



public function showProfile($id)
{  
    $faculties=Faculty::all();
    $institution = Institution::findOrFail($id);
    return view('institution.profile', compact('institution','faculties'));
}

public function editProfile($id)
{
    $faculties=Faculty::all();
    $institution = Institution::findOrFail($id);
    return view('institution.edit-profile', compact('institution','faculties'));
}

public function updateprofile(Request $request, $id)
    {
        $institution = Institution::findOrFail($id);

        $faculties=Faculty::all();
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'current_password' => 'required',
            'password' => 'nullable|min:8|confirmed',
        ]);

        // Check if current password matches
        if (!Hash::check($validated['current_password'], $institution->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }
        if ($request->hasFile('profile_photo')) {
            $path = $request->file('profile_photo')->store('profile_photos', 'public');
            $institution->profile_photo = $path;
        }
        
        $institution->name = $validated['name'];
        $institution->email = $validated['email'];

        // Handle profile photo upload
        if ($request->hasFile('profile_photo')) {
            $path = $request->file('profile_photo')->store('profile_photos', 'public');
            $institution->profile_photo = $path;
        }

        // Update password if provided
        if (!empty($validated['password'])) {
            $institution->password = bcrypt($validated['password']);
        }

        $institution->save();

        return redirect()->route('institution.profile', $institution->id)->with('success', 'Profile updated successfully.');
    }
    public function updatePhoto(Request $request, $id)
{
    $request->validate([
        'profile_photo' => 'required|image|max:2048',
    ]);

    $institution = Institution::findOrFail($id);

    if ($request->hasFile('profile_photo')) {
        $path = $request->file('profile_photo')->store('profile_photos', 'public');
        $institution->profile_photo = $path;
        $institution->save();
    }

    return redirect()->route('institution.profile', $id)->with('success', 'Profile photo updated successfully.');
}

public function updatePassword(Request $request, $id)
{
    $request->validate([
        'current_password' => 'required',
        'new_password' => 'required|min:8|confirmed',
    ]);

    $institution = Institution::findOrFail($id);

    if (!Hash::check($request->current_password, $institution->password)) {
        return back()->withErrors(['current_password' => 'The current password is incorrect.']);
    }

    $institution->password = Hash::make($request->new_password);
    $institution->save();

    return redirect()->route('institution.profile', $id)->with('success', 'Password updated successfully.');
}


// In InstitutionController.php
public function search(Request $request)
{
    $query = $request->input('query');
    $institutions = Institution::where('name', 'like', '%' . $query . '%')->get();
    return response()->json($institutions);
}

public function showFacultyCourses($institutionId, $facultyId)
{
    // Get the institution and the faculty
    $institution = Institution::findOrFail($institutionId);
    $faculty = Faculty::findOrFail($facultyId);

    // Get courses related to the selected faculty
    $courses = $faculty->courses;
    $faculties=Faculty::all();
    // Return the view with institution, faculty, and courses data
    return view('institution.courses.show', compact('institution', 'faculty', 'courses','faculties'));
}




}
