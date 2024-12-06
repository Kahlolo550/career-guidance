<?php

use App\Models\User;
use App\Models\Admission;
use App\Models\Institution;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
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
use App\Http\Controllers\Institution\Auth\ResetPasswordController;
use App\Http\Controllers\Institution\InstitutionProfileController;
use App\Http\Controllers\Institution\Auth\ForgotPasswordController;

Route::get('/', function () {



    return view('welcome');
});

Route::get('/dashboard', function () {
$admissions = Admission::all();
$Users = User::all();

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
    Route::post('/institution/faculty', [FacultyController::class, 'store'])->name('faculties.store');
    
    Route::post('/institution/course', [CourseController::class, 'store'])->name('courses.store');
     
});

Route::get('/admin/institution/faculties/create',[FacultyController::class,'create'])->name('admin.faculties.create');
Route::get('/admin/courses/create', [AdminController::class, 'createcourse'])->name('admin.courses.create');
Route::get('/admin/faculties/{institution_id}/get', [AdminController::class, 'getFaculties'])->name('admin.faculties.get');
Route::get('/admin/dashboard', [CourseController::class, 'admindashboard'])->name('admin.dashboard');


Route::get('/admin/layouts',[AdminController::class,'showlayout'])->name('admin.layouts');
Route::middleware('auth:institution')->group(function () {
    Route::put('/institution/profile/{id}/photo', [InstitutionController::class, 'updatePhoto'])->name('institution.profile.photo.update');
Route::put('/institution/profile/{id}/password', [InstitutionController::class, 'updatePassword'])->name('institution.profile.password.update');

    Route::get('/{id}/institution/profile', [InstitutionController::class, 'showProfile'])->name('institution.profile');
Route::get('/institution/{id}/profile/edit', [InstitutionController::class, 'editProfile'])->name('institution.profile.edit');
Route::put('/institution/{id}/profile', [InstitutionController::class, 'updateProfile'])->name('institution.profile.update');

});


Route::resource('institutions', InstitutionController::class);
Route::resource('faculties', FacultyController::class);
Route::resource('courses', CourseController::class);
Route::get('/institutions/{id}/edit', [InstitutionController::class, 'edit'])->name('institutions.edit');
// web.php
Route::get('/institutions/{id}', [InstitutionController::class, 'show'])->name('institutions.show');

// web.php
Route::get('faculties/{id}', [FacultyController::class, 'show'])->name('faculties.show');

Route::post('admissions/{id}/publish', [AdmissionController::class, 'publish'])->name('admissions.publish');


Route::get('/admissions/create', [AdmissionController::class, 'create'])->name('admissions.create');
Route::post('/institution/{institutionId}/admissions', [AdmissionController::class, 'store'])->name('admissions.store');

Route::get('/admissions/published', [AdmissionController::class, 'published'])->name('admissions.published');
Route::get('/institution/{id}/dashboard', [InstitutionController::class, 'showInstitutionDashboard'])->name('institution.home');



Route::middleware(['auth:institution'])->group(function () {
    Route::get('/institution/dashboard', [InstitutionController::class, 'dashboard'])->name('institution.dashboard');
    Route::post('/institution/faculty', [FacultyController::class, 'store'])->name('faculties.store');
    Route::post('/institution/course', [CourseController::class, 'store'])->name('courses.store');
    Route::post('/institution/admission/publish', [AdmissionController::class, 'publish'])->name('admissions.publish');
    Route::get('/institution/upload_admission', [AdmissionController::class, 'upload'])->name('institution.upload.admission');



});
Route::patch('institution/admissions/{id}/publish', [AdmissionController::class, 'publish'])->name('admissions.publish');

Route::get('/faculties/{id}', [FacultyController::class, 'show'])->name('faculties.show');




Route::middleware(['auth:institution'])->group(function () {
    Route::get('/institution/home', [InstitutionController::class, 'home'])->name('institution.home');
    Route::get('/institution/faculties/create', [InstitutionController::class, 'createFaculty'])->name('institution.faculties.create');
    Route::post('/institution/faculties/store', [InstitutionController::class, 'storeFaculty'])->name('institution.faculties.store');
    Route::get('/institution/courses/create', [InstitutionController::class, 'createCourse'])->name('institution.courses.create');
    Route::get('/institution/{institution}/faculties',[FacultyController::class,'instshow'])->name('institution.faculties.show');
    // Route to show courses for a specific faculty in an institution
Route::get('institution/{institutionId}/faculty/{facultyId}/courses', [InstitutionController::class, 'showFacultyCourses'])->name('institution.courses.show');

    Route::resource('institution.admissions', AdmissionsController::class);

    Route::post('/institution/courses/store', [InstitutionController::class, 'storeCourse'])->name('institution.courses.store');
});



Route::prefix('institutions')->group(function () {
    Route::get('{institutionId}/admissions', [AdmissionController::class, 'index'])->name('admissions.index');
    Route::get('/institutions/{institution}/admissions/create', [AdmissionController::class, 'create'])->name('institution.admissions.create');
    
    Route::post('/institutions/{institutionId}/admissions', [AdmissionController::class, 'store'])->name('institution.admissions.store');
    Route::get('{institutionId}/admissions/published', [AdmissionController::class, 'published'])->name('admissions.published');
});


Route::get('/institutions/{institution}/dashboard', [AdmissionController::class, 'showDashboard'])->name('admissions.dashboard');
Route::get('/institutions/{institutionId}/dashboard', [AdmissionController::class, 'showInstitutionDashboard'])->name('institution.dashboard');
Route::delete('institutions/{institutionId}/admissions/{admissionId}', [AdmissionController::class, 'destroy'])->name('institutions.admissions.destroy');
Route::resource('{institutionId}/institution.admissions', AdmissionsController::class);

Route::get('/istitutions/{institution}/admissions', [AdmissionsController::class, 'index'])->name('institution.admissions.dashboard');




    
    
Route::prefix('courses')->group(function () {
    Route::post('qualifications', [QualificationController::class, 'store'])->name('qualifications.store');
});

    // In routes/web.php
Route::get('/institution/qualifications/create', [QualificationController::class, 'create'])->name('institution.qualifications.create');

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
    
    Route::get('/applications', [ApplicationController::class, 'index'])
        ->name('applications.index');
    
    Route::get('/applications/{application}', [ApplicationController::class, 'show'])
        ->name('applications.show');
    
    Route::get('/applications/{application}/edit', [ApplicationController::class, 'edit'])
        ->name('applications.edit');
    
    Route::put('/applications/{application}', [ApplicationController::class, 'update'])
        ->name('applications.update');
    
    Route::delete('/applications/{application}', [ApplicationController::class, 'destroy'])
        ->name('applications.destroy');



        Route::middleware(['auth:institution'])->group(function () {
            Route::get('/institution/{institution}/applications', [InstitutionApplicationsController::class, 'index'])->name('institution.applications.index');
            Route::put('/applications/{id}/status', [InstitutionApplicationsController::class, 'updateStatus'])->name('applications.updateStatus');
        });
        Route::get('/institution/dashboard', [InstitutionController::class, 'dashboard'])->middleware('auth:institution')->name('institution.dashboard');
   

        Route::get('/institutions/{institutionId}/applications', [InstitutionController::class, 'showApplications'])->name('institution.applications');
        

        Route::middleware(['auth:admin'])->group(function () {
            Route::get('/admin/courses/create', [CourseController::class, 'create'])->name('admin.courses.create');

            Route::get('/admin/profile', [AdminController::class, 'showProfile'])->name('admin.profile.show');
            Route::get('/admin/profile/edit', [AdminController::class, 'editProfile'])->name('admin.profile.edit');
            Route::post('/admin/profile/update', [AdminController::class, 'updateProfile'])->name('admin.profile.update');
        });

        Route::get('/search-institutions', [InstitutionController::class, 'search']);


        #student routes


        Route::get('/home', [StudentController::class, 'index'])->name('student.home');
        Route::get('/about', [StudentController::class, 'about'])->name('student.about');
        Route::get('/contact', [StudentController::class, 'contact'])->name('student.contact');
        
          


        

require __DIR__.'/auth.php';
require __DIR__.'/admin.auth.php';
require __DIR__.'/institution.auth.php';
