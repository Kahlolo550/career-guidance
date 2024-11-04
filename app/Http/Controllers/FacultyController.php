<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
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
}
