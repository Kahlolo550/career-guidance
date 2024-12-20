<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\RegisteredUserController;
use App\Models\Institution;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])->name('admin.register');
    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [LoginController::class, 'create'])->name('admin.login');
    Route::post('login', [LoginController::class, 'store']);

   
});

Route::prefix('admin')->middleware('auth:admin')->group(function () {
  
    Route::get('/dashboard', function () {
        $institutions=Institution::all();
        return view('admin.dashboard',compact('institutions'));
    })->name('admin.dashboard' );

    Route::get('logout', [LoginController::class, 'destroy'])->name('admin.logout');
});
