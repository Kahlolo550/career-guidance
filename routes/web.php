<?php

use App\Models\Institution;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AdmissionController;
use App\Http\Controllers\AdmissionsController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\InstitutionController;
use App\Http\Controllers\NeededGradesController;
use App\Http\Controllers\QualificationController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\InstitutionApplicationsController;
use App\Http\Controllers\Institution\InstitutionProfileController;

Route::get('/', function () {



    return view('welcome');
});

Route::get('/dashboard', function () {

$institutions = Institution::all();

    return view('dashboard', compact('institutions'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth:admin')->group(function () {
    Route::get('admin/profile', [AdminProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::patch('admin/profile', [AdminProfileController::class, 'update'])->name('admin.profile.update');
    Route::delete('admin/profile', [AdminProfileController::class, 'destroy'])->name('admin.profile.destroy');
});

Route::middleware('auth:institution')->group(function () {
    Route::get('institution/profile', [InstitutionProfileController::class, 'edit'])->name('institution.profile.edit');
    Route::patch('institution/profile', [InstitutionProfileController::class, 'update'])->name('institution.profile.update');
    Route::delete('institution/profile', [InstitutionProfileController::class, 'destroy'])->name('institution.profile.destroy');
});


Route::resource('institutions', InstitutionController::class);
Route::resource('faculties', FacultyController::class);
Route::resource('courses', CourseController::class);
Route::get('/institutions/{id}/edit', [InstitutionController::class, 'edit'])->name('institutions.edit');
// web.php
Route::get('/institutions/{id}', [InstitutionController::class, 'show'])->name('institutions.show');

// web.php
Route::get('faculties/{id}', [FacultyController::class, 'show'])->name('faculties.show');

Route::resource('admissions', AdmissionController::class);
Route::post('admissions/{id}/publish', [AdmissionController::class, 'publish'])->name('admissions.publish');


Route::get('/admissions/create', [AdmissionController::class, 'create'])->name('admissions.create');
Route::post('/admissions', [AdmissionController::class, 'store'])->name('admissions.store');
Route::get('/admissions/published', [AdmissionController::class, 'published'])->name('admissions.published');
Route::get('/institution/{id}/dashboard', [InstitutionController::class, 'showInstitutionDashboard'])->name('institution.home');



// In routes/web.php iim not sure
Route::middleware(['auth:institution'])->group(function () {
    Route::get('/institution/dashboard', [InstitutionController::class, 'dashboard'])->name('institution.dashboard');
    Route::post('/institution/faculty', [FacultyController::class, 'store'])->name('faculties.store');
    Route::post('/institution/course', [CourseController::class, 'store'])->name('courses.store');
    Route::post('/institution/admission/publish', [AdmissionController::class, 'publish'])->name('admissions.publish');




});

// Example of a route for publishing admissions
Route::patch('institution/admissions/{id}/publish', [AdmissionController::class, 'publish'])->name('admissions.publish');

//Route::get('/institutions/{id}/home', [InstitutionController::class, 'show'])->name('institutions.show');
Route::get('/faculties/{id}', [FacultyController::class, 'show'])->name('faculties.show');

//Route::get('/institutions/{id}/home', [InstitutionController::class, 'home'])->name('institution.home');



Route::middleware(['auth:institution'])->group(function () {
    Route::get('/institution/home', [InstitutionController::class, 'home'])->name('institution.home');
    Route::get('/institution/faculties/create', [InstitutionController::class, 'createFaculty'])->name('institution.faculties.create');
    Route::post('/institution/faculties/store', [InstitutionController::class, 'storeFaculty'])->name('institution.faculties.store');
    Route::get('/institution/courses/create', [InstitutionController::class, 'createCourse'])->name('institution.courses.create');

    Route::resource('institution.admissions', AdmissionsController::class);

    Route::post('/institution/courses/store', [InstitutionController::class, 'storeCourse'])->name('institution.courses.store');
});



Route::prefix('institutions')->group(function () {
    Route::get('{institutionId}/admissions', [AdmissionController::class, 'index'])->name('admissions.index');
    Route::get('{institutionId}/admissions/create', [AdmissionController::class, 'create'])->name('admissions.create');
    Route::post('{institutionId}/admissions', [AdmissionController::class, 'store'])->name('institution.admissions.store');
    Route::get('{institutionId}/admissions/published', [AdmissionController::class, 'published'])->name('admissions.published');
});


Route::get('/institutions/{institution}/dashboard', [AdmissionController::class, 'showDashboard'])->name('admissions.dashboard');
Route::get('/institutions/{institutionId}/dashboard', [AdmissionController::class, 'showInstitutionDashboard'])->name('institution.dashboard');
Route::delete('institutions/{institutionId}/admissions/{admissionId}', [AdmissionController::class, 'destroy'])->name('institutions.admissions.destroy');
Route::resource('{institutionId}/institution.admissions', AdmissionsController::class);
Route::post('institutions/{institution}/admissions', [AdmissionsController::class, 'store'])->name('admissions.store');

Route::get('/istitutions/{institution}/admissions', [AdmissionsController::class, 'index'])->name('institution.admissions.dashboard');




    
    

    Route::post('/courses/{course}/qualifications', [QualificationController::class, 'store'])->name('qualifications.store');
 
    Route::get('/view-admissions/{institution_id}', [AdmissionsController::class, 'index'])->name('view-admissions');


    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');

  

    Route::get('/admissions/view/{id}', [AdmissionController::class, 'view'])->name('admissions.view');
    
    Route::get('/qualifications/{institutionId}', [UserDashboardController::class, 'getQualifications']);

    Route::get('/{institution}/neededgrades', [NeededGradesController::class, 'index'])->name('neededgrades');


    Route::middleware(['auth'])->group(function () {
        Route::get('/applications{institution}', [ApplicationController::class, 'index'])->name('applications.index');
        Route::get('/applications/create', [ApplicationController::class, 'create'])->name('applications.create');
        Route::post('/applications', [ApplicationController::class, 'store'])->name('applications.store');
        Route::post('/applications/apply', [ApplicationController::class, 'apply'])->name('applications.apply');
    });
    
    
    Route::post('/applications', [ApplicationController::class, 'store'])
        ->name('applications.store');
    
    // Route for showing the index of applications (optional)
    Route::get('/applications', [ApplicationController::class, 'index'])
        ->name('applications.index');
    
    // If you want to show specific application details
    Route::get('/applications/{application}', [ApplicationController::class, 'show'])
        ->name('applications.show');
    
    // If you want to edit an application (optional)
    Route::get('/applications/{application}/edit', [ApplicationController::class, 'edit'])
        ->name('applications.edit');
    
    // Route for updating an application (optional)
    Route::put('/applications/{application}', [ApplicationController::class, 'update'])
        ->name('applications.update');
    
    // Route for deleting an application (optional)
    Route::delete('/applications/{application}', [ApplicationController::class, 'destroy'])
        ->name('applications.destroy');



        Route::middleware(['auth:institution'])->group(function () {
            Route::get('/institution/{institution}/applications', [InstitutionApplicationsController::class, 'index'])->name('institution.applications.index');
        });
        Route::get('/institution/dashboard', [InstitutionController::class, 'dashboard'])->middleware('auth:institution')->name('institution.dashboard');
   

        Route::get('/institutions/{institutionId}/applications', [InstitutionController::class, 'showApplications'])->name('institution.applications');
        

require __DIR__.'/auth.php';
require __DIR__.'/admin.auth.php';
require __DIR__.'/institution.auth.php';
