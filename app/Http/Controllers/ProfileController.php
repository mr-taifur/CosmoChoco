<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Show profile edit page
     */
    public function edit()
    {
        $user = Auth::user(); // returns User model
        return view('profile.edit', compact('user'));
    }

    /**
     * Update profile
     */
    public function update(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user(); // ensures IDE knows it's a User model

        // Validation rules
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        // Update only the fields defined in $fillable
        $user->update($request->only(['name', 'email']));

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}
