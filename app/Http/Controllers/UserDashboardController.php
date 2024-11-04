<?php

namespace App\Http\Controllers;

use App\Models\Admission;
use App\Models\Course;
use App\Models\Institution;
use App\Models\Qualification;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function index()
    {
        $courses = Course::with('qualifications')->get();
        $institutions = Institution::all();
        return view('dashboard', compact('institutions', 'courses'));
    }

    public function getQualifications($institutionId)
    {
        $courses = Course::with('qualifications')->where('institution_id', $institutionId)->get();
    
        // Debugging output
        dd($courses); // This will dump the courses data and stop further execution.
    
        return response()->json(['courses' => $courses]);
    }
    

}
