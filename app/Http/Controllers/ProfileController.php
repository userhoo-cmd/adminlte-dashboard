<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Show the edit profile page.
     */
    public function edit()
    {
        $user = Auth::user();  // Get the authenticated user
        return view('profile.edit', compact('user'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
{
    $user = auth()->user();

    // ✅ Validate input
    $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    // ✅ Assign updated data
    $user->first_name = $request->first_name;
    $user->last_name = $request->last_name;
    $user->email = $request->email;

    // ✅ Handle avatar upload
    if ($request->hasFile('avatar')) {
        $avatarPath = $request->file('avatar')->store('avatars', 'public');
        $user->avatar = $avatarPath;
    }

    // ✅ If password was given
    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    $user->save();

    return redirect()->route('profile.edit')
        ->with('success', 'Profile updated successfully!');
}

}
