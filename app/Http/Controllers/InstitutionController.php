<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Faculty;
use App\Models\Application;
use App\Models\Institution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return view('institution.faculties.create');
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

        return redirect()->route('institution.home', compact('faculties'))->with('success', 'Faculty created successfully!');
    }

    public function createCourse()
    {
       
    $institution = auth()->guard('institution')->user(); 
    return view('institution.courses.create', compact('institution'));
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

        return redirect()->route('institution.home')->with('success', 'Course created successfully!');
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
{
    $institution = Institution::with(['faculties', ])->findOrFail($id);
    return view('admin.institutions.show', compact('institution'));
}


public function destroy($id)
{
    $institution = Institution::findOrFail($id);
    $institution->delete(); 
    return redirect()->route('institutions.index');
}




public function dashboard()
{   $faculties = Faculty::all();
    $institution = auth()->user()->institution; 
    $applications = Application::whereHas('course', function($query) use ($institution) {
        $query->where('institution_id', $institution->id);
    })->get();

    return view('institution.home', compact('institution', 'applications','faculties'));
}

public function showApplications($institutionId)
{
    $institution = Institution::findOrFail($institutionId);
    $applications = Application::whereHas('course', function($query) use ($institutionId) {
        $query->where('institution_id', $institutionId);
    })->get();

    return view('institution.applications.index', compact('institution', 'applications'));
}





}
