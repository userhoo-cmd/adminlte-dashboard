<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:superadmin']);
    }

    // 🧭 Show all users
    public function index()
    {
        $users = User::with('roles')->get();
        return view('admin.users.index', compact('users'));
    }

    // ✏️ Edit user roles
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    // 💾 Update user role
    public function update(Request $request, User $user)
    {
        $request->validate(['role' => 'required|string']);
        $user->syncRoles([$request->role]);

        return redirect()->route('admin.users.index')
            ->with('success', 'User role updated successfully.');
    }

    // 🗑️ Delete user
    public function destroy(User $user)
    {
        if ($user->hasRole('superadmin')) {
            return back()->with('error', 'Cannot delete Super Admin.');
        }

        $user->delete();
        return back()->with('success', 'User deleted successfully.');
    }
}
