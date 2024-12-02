<?php

namespace App\Http\Controllers\Buildings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function showAssignRoleForm()
    {
        // $this->authorize('director');

        $users = User::whereDoesntHave('roles', function ($query) {
            $query->where('name', 'director');
        })->get();

        $roles = Role::where('name', '!=', 'director')->pluck('name')->toArray();

        return view('buildings.assign_roles', compact('users', 'roles'));
    }

    public function assignRole(Request $request)
    {
        // Validate the request data
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role' => 'required|exists:roles,name',
        ]);

        $user = User::find($request->user_id);
        $role = $request->role;

        // Remove any current role the user has
        $user->syncRoles([$role]);

        return redirect()->route('assign.roles.form')->with('success', 'Role assigned successfully.');
    }
}
