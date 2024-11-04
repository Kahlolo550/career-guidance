<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Faculty;
use App\Models\Qualification; // Import the Qualification model
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with('qualifications')->get(); // Eager load qualifications
        return view('admin.courses.index', compact('courses'));
    }

    public function create()
    {
        $faculties = Faculty::all(); // To allow selection of the associated faculty
        return view('admin.courses.create', compact('faculties'));
    }

    public function store(Request $request)
{
    // Validate the request
    $validatedData = $request->validate([
        'name' => 'required|string|max:255|unique:courses,name,NULL,id,faculty_id,' . $request->faculty_id,
        'faculty_id' => 'required|exists:faculties,id',
        'subjects.*' => 'required|string|max:255',
        'grades.*' => 'required|string|max:2',
    ]);

    // Create the course
    $course = Course::create($validatedData);

    // Debugging: Check if subjects and grades are being received
    \Log::info('Subjects: ', $request->subjects);
    \Log::info('Grades: ', $request->grades);
    Course::create([
        'name' => $request->name,
        'faculty_id' => $request->faculty_id,
        'institution_id' => auth()->guard('institution')->user()->id, // Add this line
    ]);
    

    // Store qualifications
    foreach ($request->subjects as $index => $subject) {
        Qualification::create([
            'course_id' => $course->id,
            'subject' => $subject,
            'grade' => $request->grades[$index],
        ]);
    }

    // Set a success message
    return redirect()->back()->with('success', 'Course added successfully with qualifications.');
}



    public function show($id)
    {
        $course = Course::with('qualifications')->findOrFail($id); // Eager load qualifications
        return view('courses.show', compact('course'));
    }

    public function edit($id)
    {
        $course = Course::findOrFail($id);
        $faculties = Faculty::all();
        return view('courses.edit', compact('course', 'faculties'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'faculty_id' => 'required|exists:faculties,id'
        ]);

        $course = Course::findOrFail($id);
        $course->update([
            'name' => $request->name,
            'faculty_id' => $request->faculty_id
        ]);

        return redirect()->route('courses.index')->with('success', 'Course updated successfully');
    }

    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->qualifications()->delete(); // Delete qualifications associated with the course
        $course->delete();

        return redirect()->back()->with('success', 'Course deleted successfully');
    }
}
