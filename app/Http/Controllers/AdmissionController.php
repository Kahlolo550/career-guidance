<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\Admission;
use App\Models\Institution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class AdmissionController extends Controller
{
    public function index($institutionId)
    {
      
        $institution = Institution::findOrFail($institutionId);
         
       $institutions = Institution::all();
        $admissions = Admission::where('institution_id', $institutionId)->get();

        return view('admissions.dashboard', compact('admissions', 'institution','institutions'));
    }

    public function create()
    {
    
        return view('admissions.upload');
    }
    public function upload(){
        // Fetch all institutions
        $institutions = Institution::all();
        
        // You can either fetch a single institution here if needed
        $institution = Institution::first();  // Or use `find($id)` to get a specific institution
        
       $faculties=Faculty::all();
        // Return the view
        return view('institution.admissions.upload', compact('institutions', 'institution','faculties'));
    }
    
    public function store( Request $request, $institutionId)
    {
        // Validate the incoming request
        $request->validate([
            'title' => 'required|string|max:255',
            'details' => 'required|string',
            'document' => 'required|file|mimes:pdf|max:2048',
        ]);
    
        // Ensure the institution ID exists and is valid
        $institution = Institution::find($institutionId);
    
        if (!$institution) {
            return redirect()->back()->withErrors(['error' => 'Invalid Institution ID.']);
        }
    
        // Store the uploaded document
        $documentPath = $request->file('document')->store('admissions', 'public');
    
        // Create a new Admission record
        Admission::create([
            'title' => $request->title,
            'details' => $request->details,
            'document' => $documentPath,
            'institution_id' => $institutionId, // Use the institution ID as passed from the route
            'published' => true,
        ]);
    
        // Redirect back with a success message
        return redirect()->back()->with('success', 'Admission uploaded and published successfully!');
    }
    
    public function published($institutionId)
    {
        // Get all institutions for the navigation dropdown or list
        $institutions = Institution::all();
    
        // Find the specific institution by ID
        $institution = Institution::findOrFail($institutionId); // Throws 404 if not found
        $admissions = $institution->admissions()->where('published', true)->get();

    
        // Get admissions for the selected institution that are published
        $admissions = Admission::where('institution_id', $institutionId)
            ->where('published', true)
            ->get();
            $admissions = Admission::where('institution_id', $institutionId)
    ->where('published', true)
    ->get();



    
        // Return data to the view
        return view('admissions.published', compact('institutions', 'institution', 'admissions'));
    }
    

    public function showInstitutionDashboard($institutionId)
    {
        $institution = Institution::findOrFail($institutionId);

        
        $admissions = Admission::where('institution_id', $institution->id)->where('published', true)->get();

        return view('institution.dashboard', compact('institution', 'admissions'));
    }

    public function publish(Request $request, $id)
    {
       
        $admission = Admission::findOrFail($id);
        
       $faculties=Faculty::all();
      
        $admission->published = !$admission->published;
        $admission->save();
        
        return redirect()->back()->with('success', 'Admission status updated successfully!');
    }

    public function destroy($institutionId, $id)
    {
        $admission = Admission::findOrFail($id);
        
        if ($admission->document) {
            Storage::disk('public')->delete($admission->document); 
        }

        $admission->delete();

        return redirect()->back()->with('success', 'Admission deleted successfully.');
    }
    public function view($id)
{
   
    $admission = Admission::findOrFail($id);
    

    $filePath = storage_path('app/public/' . $admission->document);

   
    if (!file_exists($filePath)) {
        abort(404);
    }

   
    return response()->file($filePath);
}

}
