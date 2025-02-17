<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Show all users
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Paginate users with optional search
        $users = User::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%")
                         ->orWhere('email', 'like', "%{$search}%");
        })
            ->paginate(10);  // Adjust number of items per page as needed

        return view('admin.users.index', compact('users'));
    }

    // Show the create user form
    public function create()
    {
        return view('admin.users.create');
    }

    // Store a new user
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,user',
        ]);

        // Create new user with hashed password
        $userData = $request->only(['name', 'email', 'role']);
        $userData['password'] = Hash::make($request->password);

        User::create($userData);

        // Redirect with SweetAlert success message
        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    // Show the edit user form
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    // Update an existing user
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|in:admin,user',
        ]);

        $user = User::findOrFail($id);

        $userData = $request->only(['name', 'email', 'role']);

        // Update password if provided
        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }

        $user->update($userData);

        // Redirect with SweetAlert success message
        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    // Delete a user
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Delete the user
        $user->delete();

        // Redirect with SweetAlert success message
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
}
