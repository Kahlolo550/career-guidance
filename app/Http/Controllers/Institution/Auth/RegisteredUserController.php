<?php

namespace App\Http\Controllers\Institution\Auth;

use App\Http\Controllers\Controller;
use App\Models\Institution;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('institution.auth.register');
    }

    

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
   
     public function store(Request $request): RedirectResponse
{
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.Institution::class],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
    ]);

    
    $institution = Institution::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    event(new Registered($institution));

    
    Auth::guard('institution')->login($institution);

    
    return redirect()->route('institution.home', $institution->id)
                     ->with('success', 'Institution registered successfully!');
}

}
