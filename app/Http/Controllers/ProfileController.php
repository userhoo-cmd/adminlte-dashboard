<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Show the Edit Profile page.
     */
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    /**
     * Update the authenticated user's profile.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        // ✅ Validate input
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email|max:255|unique:users,email,' . $user->id,
            'bio'        => 'nullable|string|max:1000',
            'avatar'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'password'   => 'nullable|string|min:8|confirmed',
        ]);

        // ✅ Update basic fields
        $user->fill([
            'first_name' => $validated['first_name'],
            'last_name'  => $validated['last_name'],
            'email'      => $validated['email'],
            'bio'        => $validated['bio'] ?? $user->bio,
        ]);

        // ✅ Handle avatar upload
        if ($request->hasFile('avatar')) {
            // Delete old avatar if exists
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }

            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $avatarPath;
        }

        // ✅ Handle password update
        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        // ✅ Flash success message
        return redirect()->route('profile.edit')->with('success', '✅ Profile updated successfully!');
    }
}
