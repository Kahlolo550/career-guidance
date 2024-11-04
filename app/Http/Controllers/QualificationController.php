<?php

namespace App\Http\Controllers;

use App\Models\Qualification;
use Illuminate\Http\Request;

class QualificationController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'subject_name' => 'required|array', // Change to array to handle multiple subjects
            'needed_grades' => 'required|array', // Change to array to handle multiple needed grades
        ]);

        // Loop through each subject name and its corresponding needed grades
        foreach ($validatedData['subject_name'] as $key => $subject) {
            Qualification::create([
                'course_id' => $validatedData['course_id'],
                'subject_name' => $subject,
                'needed_grades' => explode(',', $validatedData['needed_grades'][$key]), // Convert each needed grade to an array
            ]);
        }

        // Redirect back with success message
        return redirect()->back()->with('success', 'Qualifications added successfully.');
    }
}
