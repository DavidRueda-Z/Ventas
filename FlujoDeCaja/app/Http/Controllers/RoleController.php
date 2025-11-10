<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    // Mostrar lista de usuarios y roles
    public function index()
    {
        $users = User::with('roles')->get();
        $roles = Role::all();
        return view('roles.index', compact('users', 'roles'));
    }

    // Asignar rol a usuario
    public function assignRole(Request $request, $userId)
    {
        $user = User::findOrFail($userId);
        $user->syncRoles($request->role); // reemplaza roles anteriores por el nuevo
        return redirect()->back()->with('success', 'Rol asignado correctamente');
    }
}
