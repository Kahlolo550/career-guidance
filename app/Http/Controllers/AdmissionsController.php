<?php

namespace App\Http\Controllers;

use App\Models\Institution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Admission; 

class AdmissionsController extends Controller
{

    public function store(Request $request , $institutionId)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'details' => 'required|string',
            'document' => 'required|file|mimes:pdf,doc,docx',
            'institution_id' => 'required|exists:institutions,id',
        ]);
    
        $documentPath = $request->file('document')->store('admissions');
    
        Admission::create([
            'title' => $request->title,
            'details' => $request->details,
            'document' => $documentPath,
            'institution_id' => $request->institution_id,
            'published' => true, 
        ]);
    
        return redirect()->route('institution.admissions.dashboard', $request->institution_id)
                         ->with('success', 'Admission uploaded and published successfully!');
    }

    public function index($institutionId)
    {
        $institution = Institution::findOrFail($institutionId);
    
        $admissions = Admission::where('institution_id', $institutionId)->get();
    
        return view('institution.admissions.dashboard', compact('admissions', 'institution'));
    }
    

    public function create()
    {
        return view('admissions.upload'); 
    }

   

    public function published()
    {
        $admissions = Admission::where('published', true)->get();
    
        return view('institution.admissions.published', compact('admissions'));
    }

    public function showInstitutionDashboard($institutionId)
{
    $institution = Institution::findOrFail($institutionId);
    
    $admissions = Admission::where('institution_id', $institutionId)->get();

    $admissions = Admission::where('institution_id', $institution->id)->where('published', true)->get();

    return view('institution.institution.dashboard', compact('institution', 'admissions'));
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
        Storage::delete($admission->document); 
    }

    $admission->delete();

    return redirect()->route('institutions.admissions.index', $institutionId)->with('success', 'Admission deleted successfully.');
}

}
