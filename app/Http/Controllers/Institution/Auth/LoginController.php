<?php

namespace App\Http\Controllers\Institution\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function create(): View
    {
        return view('institution.auth.login');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        $credentials = $request->only('email', 'password');
        
        if (Auth::guard('institution')->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('institution.home')
                             ->with('success', 'Logged in successfully!');
        }

        return back()->withErrors(['email' => 'Credentials do not match our records.']);
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('institution')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/institution/login');
    }
}
