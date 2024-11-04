<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InstitutionController;
use App\Http\Controllers\Institution\Auth\LoginController;
use App\Http\Controllers\Institution\Auth\RegisteredUserController;

Route::prefix('institution')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])->name('institution.register');
    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [LoginController::class, 'create'])->name('institution.login');
    Route::post('login', [LoginController::class, 'store']);


   
});

Route::prefix('institution')->middleware('auth:institution')->group(function () {
  
    Route::get('/dashboard', function () {
        return view('institution.show');
    })->name('institution.show');

    Route::get('logout', [LoginController::class, 'destroy'])->name('institution.logout');
});

Route::get('/institutions/{id}', [InstitutionController::class, 'show']);

