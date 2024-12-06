<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Faculty;
use App\Models\Application;
use App\Models\Institution;
use Illuminate\Http\Request;
use App\Models\Qualification;

class QualificationController extends Controller
{ 

    public function create()
{
    // Fetch all faculties (for the dropdown)
    $faculties = Faculty::all();

    // Fetch the current authenticated institution
    $institution = auth()->user()->institution;

    // Fetch all courses for the dropdown
    $courses = Course::all();

    // Optionally fetch a specific faculty (based on some logic)
    // For example, get the first faculty if needed (or set the relevant logic)
    $faculty = Faculty::first(); // Adjust based on your requirements
    
    $institution = auth()->guard('institution')->user();

    // Return the view with the required data
    return view('institution.qualifications.create', compact('institution', 'courses', 'faculties', 'faculty'));
}

    

public function store(Request $request)
    {
        // Your logic for storing the qualification
        $validatedData = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'subject_name' => 'required|array',
            'needed_grades' => 'required|array',
        ]);

        // Logic for storing each qualification
        foreach ($validatedData['subject_name'] as $key => $subject) {
            Qualification::create([
                'course_id' => $validatedData['course_id'],
                'subject_name' => $subject,
                'needed_grades' => explode(',', $validatedData['needed_grades'][$key]),
            ]);
        }

        return redirect()->back()->with('success', 'Qualifications added successfully.');
    }
}
