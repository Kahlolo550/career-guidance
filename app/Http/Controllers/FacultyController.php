<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Faculty;
use App\Models\Admission;
use App\Models\Institution;
use Illuminate\Http\Request;

class FacultyController extends Controller
{
    public function index()
    {
        $faculties = Faculty::all();
        return view('admin.faculties.index', compact('faculties'));
    }

    public function create()
    {
        $institutions = Institution::all(); // To allow selection of the associated institution
        return view('admin.faculties.create', compact('institutions'));
    }


public function show($id)
{

    
    $institution = Institution::with('faculties')->findOrFail($id);
    $faculty = Faculty::with('courses')->findOrFail($id);
   
  
    return view('admin.faculties.show', compact('faculty','institution'));
}

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'institution_id' => 'required|exists:institutions,id'
        ]);

        Faculty::create([
            'name' => $request->name,
            'institution_id' => $request->institution_id
        ]);

        return redirect()->back()->with('success', 'Faculty added successfully');
    }


    public function edit($id)
    {
        $faculty = Faculty::findOrFail($id);
        $institutions = Institution::all();
        return view('faculties.edit', compact('faculty', 'institutions'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'institution_id' => 'required|exists:institutions,id'
        ]);

        $faculty = Faculty::findOrFail($id);
        $faculty->update([
            'name' => $request->name,
            'institution_id' => $request->institution_id
        ]);

        return redirect()->route('faculties.index')->with('success', 'Faculty updated successfully');
    }

    public function destroy($id)
    {
        $faculty = Faculty::findOrFail($id);
        $faculty->delete();

        return redirect()->back()->with('success', 'Faculty deleted successfully');
    }

   
    public function instshow($id)
    {
        // Get the institution by its ID
        $institution = Institution::findOrFail($id);
    
        // Get all faculties related to this institution
        $faculties = Faculty::where('institution_id', $id)->get();
    
        // Initialize an empty array for courses
        $courses = [];
    
        // Initialize faculty as null
        $faculty = null;
    
        // If a specific faculty is selected, filter the courses by the selected faculty
        if (request()->has('faculty_id')) {
            $faculty_id = request()->get('faculty_id');
            $faculty = Faculty::findOrFail($faculty_id); // Retrieve the specific faculty
            // Filter courses by the faculty_id
            $courses = Course::where('faculty_id', $faculty_id)->get();
        }
    
        // Get admissions related to the institution
        $admissions = Admission::where('institution_id', $id)->get();
    
        // Pass the data to the view (passing faculty only if it's set)
        return view('institution.faculties.show', compact('institution', 'faculties', 'courses', 'admissions', 'faculty'));
    }
    
}
