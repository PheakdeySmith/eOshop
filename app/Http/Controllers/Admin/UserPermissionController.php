<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserPermissionController extends Controller
{
    public function __construct()
    {
        // Using middleware for role-based access control
        $this->middleware('role:admin');
    }

    public function editPermissions($userId)
    {
        $user = User::findOrFail($userId);
        $roles = Role::all();  // Get all roles
        $permissions = Permission::all(); // Get all permissions

        // Get the user's current roles and permissions
        $userPermissions = $user->getAllPermissions()->pluck('id')->toArray();
        $userRoles = $user->roles->pluck('id')->toArray();

        return view('admin.users.edit_permissions', compact('user', 'roles', 'permissions', 'userPermissions', 'userRoles'));
    }

    public function updatePermissions(Request $request, $userId)
    {
        $user = User::findOrFail($userId);

        // Sync roles for the user
        $user->syncRoles($request->roles);

        // Sync permissions for the user
        $user->syncPermissions($request->permissions);

        return redirect()->route('admin.users.editPermissions', $userId)
                         ->with('success', 'Permissions updated successfully!');
    }
}
