<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Admission;
use App\Models\Application;
use App\Models\Institution;
use Illuminate\Http\Request;
use App\Models\Qualification;

class UserDashboardController extends Controller{

public function index()
{
    $courses = Course::with('qualifications')->get();
    $institutions = Institution::all();
    $admissions = Admission::all();
    $user = auth()->user(); // Fetch the authenticated user
    
    // Check if a user is authenticated
    if (!$user) {
        return redirect()->route('login')->with('error', 'You must be logged in to access the dashboard.');
    }

    // Fetch applications related to the authenticated user
    $applications = Application::with('institution', 'course')
                               ->where('user_id', $user->id)
                               ->get();

    $institutionId = $institutions->first()->id ?? null;

    return view('dashboard', compact('applications', 'institutions', 'courses', 'institutionId'));
}


    public function getQualifications($institutionId)
    {
        $courses = Course::with('qualifications')->where('institution_id', $institutionId)->get();
    
        // Debugging output
        dd($courses); // This will dump the courses data and stop further execution.
    
        return response()->json(['courses' => $courses]);
    }
    

}
