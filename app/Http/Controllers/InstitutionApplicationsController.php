<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Institution;
use Illuminate\Http\Request;

class InstitutionApplicationsController extends Controller
{
    public function index(Institution $institution)
{
    // Fetch applications for the institution
    $applications = Application::whereHas('course', function ($query) use ($institution) {
        $query->where('institution_id', $institution->id);
    })->get();

    return view('institution.applications.index', compact('applications'));
}

}
