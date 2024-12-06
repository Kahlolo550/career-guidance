<?php




namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Application;
use App\Models\Institution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    public function create()
    {
        $courses = Course::all(); 
        return view('applications.create', compact('courses'));
    }

    public function store(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to apply for a course.');
        }

        $validatedData = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'institution_id' => 'required|exists:institutions,id',
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'former_school' => 'required|string|max:255',
            'candidate_number' => 'required|string|max:255',
            'grades' => 'required|array',
            'grades.*' => 'required|string', 
        ]);

       
        $user = auth()->user();
        $institutionId = $validatedData['institution_id'];
        $applicationCount = Application::where('user_id', $user->id)
            ->whereHas('course', function ($query) use ($institutionId) {
                $query->where('institution_id', $institutionId);
            })
            ->count();

        if ($applicationCount >= 2) {
            return back()->withErrors(['You can only apply for a maximum of 2 courses per institution.']);
        }

        Application::create([
            'user_id' => $user->id,
            'course_id' => $validatedData['course_id'],
            'institution_id' => $validatedData['institution_id'],
            'name' => $validatedData['name'],
            'surname' => $validatedData['surname'],
            'former_school' => $validatedData['former_school'],
            'candidate_number' => $validatedData['candidate_number'],
            'grades' => json_encode($validatedData['grades']), // Store grades as JSON
        ]);

        return redirect()->route('applications.index')->with('success', 'Application submitted successfully.');
    }

    public function index(Request $request)
    {
        // Retrieve all institutions along with their applications
        $institutions = Institution::with('applications')->get();
        $applications = collect(); // Default empty collection
    
        // If an institution is selected, fetch its applications
        if ($request->has('institution_id')) {
            $institutionId = $request->input('institution_id');
            $applications = Application::with('course', 'institution', 'user')
                                       ->where('institution_id',)
                                       ->get();
        }
        $institutions=Institution::all();

    // Paginate the applications for the institution
    $applications = Application::where('institution_id')->paginate(10); // Adjust the number as needed

    return view('applications.index', compact( 'applications','institutions'));
    
        // Pass the institutions and applications to the view
    
    }
    
}
