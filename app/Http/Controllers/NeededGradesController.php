<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Institution;
use Illuminate\Http\Request;

class NeededGradesController extends Controller
{
    public function index()
    {
        $courses = Course::with('qualifications')->get();
        $institutions = Institution::all();
        return view('neededgrades.index', compact('institutions', 'courses'));
    }

    
}
