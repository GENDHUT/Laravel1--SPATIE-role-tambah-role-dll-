<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
// use Spatie\Permission\Tests\TestModels\User;
use Illuminate\Routing\Controller;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    public function editRole($id)
{
    // Fetch the user by their ID
    $user = User::findOrFail($id);

    // Fetch all roles from the database
    $roles = Role::all();

    // Pass both the user and roles to the view
    return view('RoleEdit', compact('user', 'roles'));
}

public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|in:admin,owner,waiter,kasir,pelanggan',
        ]);

        // Update user name
        $user->name = $request->input('name');
        $user->save();

        // Update user role
        $user->syncRoles($request->input('role'));

        return redirect()->route('dashboard')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
{
    // You can optionally check again here if the user has any reserved tables
    if ($user->mejas->isEmpty()) {
        $user->delete();
        return redirect()->route('dashboard')->with('success', 'User deleted successfully.');
    } else {
        return redirect()->route('dashboard')->with('error', 'Cannot delete user with reserved tables.');
    }
}


}
