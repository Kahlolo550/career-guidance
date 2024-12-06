<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\Application;
use App\Models\Institution;
use Illuminate\Http\Request;

class InstitutionApplicationsController extends Controller
{
    public function index()
    {
        $institutionId = auth()->user()->institution_id; // Assuming the institution is tied to the logged-in user
        $institution = Institution::findOrFail($institutionId);
        $applications = Application::where('institution_id', $institutionId)->with('course', 'user')->get();
        
       $faculties=Faculty::all();
        return view('institution.applications.index', compact('applications', 'institution','faculties'));
    }
    
    public function updateStatus(Request $request, $id)
    {
        $application = Application::findOrFail($id);
        
        if ($request->status === 'accepted') {
            $sameSchoolAcceptedCount = Application::where('former_school', $application->former_school)
                ->where('status', 'accepted')
                ->count();
    
            if ($sameSchoolAcceptedCount >= 2) {
                return redirect()->back()->with('error', 'You cannot accept more than 2 students from the same school.');
            }
        }
    
        $application->status = $request->status;
        $application->save();
    
        return redirect()->back()->with('success', 'Application status updated successfully.');
    }
    

}
