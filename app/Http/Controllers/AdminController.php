<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // View Admin Profile
    public function showProfile()
    {
        $admin = Auth::user();
        return view('admin.profile.show', compact('admin'));
    }

    // Edit Admin Profile
    public function editProfile()
    {
        $admin = Auth::user();
        return view('admin.profile.edit', compact('admin'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'phone' => 'nullable|string|max:20',
            'current_password' => 'required|string|min:8',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $admin = Auth::user();

    
        if (!Hash::check($request->current_password, $admin->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        $admin->name = $request->name;
        $admin->email = $request->email;
       

        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }

   

        $admin->save();

        return redirect()->route('admin.profile.show')->with('success', 'Profile updated successfully.');
    }
}


