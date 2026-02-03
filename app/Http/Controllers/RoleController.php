<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:roles',
            'permissions' => 'nullable|array',
        ]);

        // If permissions not in request (all unchecked), set to empty array
        if (! $request->has('permissions')) {
            $validated['permissions'] = [];
        }

        Role::create($validated);

        return redirect()->route('users.index', ['tab' => 'roles'])->with('success', 'Role created successfully.');
    }

    public function update(Request $request, Role $role)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,'.$role->id,
            'permissions' => 'nullable|array',
        ]);

        // If permissions not in request (all unchecked), set to empty array
        if (! $request->has('permissions')) {
            $validated['permissions'] = [];
        }

        $role->update($validated);

        return redirect()->route('users.index', ['tab' => 'roles'])->with('success', 'Role updated successfully.');
    }

    public function destroy(Role $role)
    {
        if ($role->users()->exists()) {
            return redirect()->route('users.index', ['tab' => 'roles'])->with('error', 'Cannot delete role with assigned users.');
        }

        $role->delete();

        return redirect()->route('users.index', ['tab' => 'roles'])->with('success', 'Role deleted successfully.');
    }
}
