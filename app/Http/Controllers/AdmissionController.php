<?php

namespace App\Http\Controllers;

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

       
        $admissions = Admission::where('institution_id', $institutionId)->get();

        return view('admissions.dashboard', compact('admissions', 'institution'));
    }

    public function create()
    {
    
        return view('admissions.upload');
    }

    public function store(Request $request, $institutionId)
    {
        
        $request->validate([
            'title' => 'required|string|max:255',
            'details' => 'required|string',
            'document' => 'required|file|mimes:pdf|max:2048', 
            'institution_id' => 'required|exists:institutions,id',
        ]);

        $documentPath = $request->file('document')->store('admissions', 'public'); 

        Admission::create([
            'title' => $request->title,
            'details' => $request->details,
            'document' => $documentPath,
            'institution_id' => $request->institution_id,
            'published' => true, 
        ]);

        return redirect()->back()
                         ->with('success', 'Admission uploaded and published successfully!');
    }

    public function published()
    {
       $institutions=Institution::all();
        $admissions = Admission::where('published', true)->get();
        return view('admissions.published', compact('admissions','institutions'));
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
