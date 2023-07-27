<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Role;

class RoleAssignmentController extends Controller
{
    public function index()
    {
        $usuarios = User::all();
        $roles = Role::all();
        $usuariosConRoles = User::role(['staff', 'admin'])->get();
        $rolActual = null; // Variable para almacenar el rol actual del usuario seleccionado, inicialmente se establece como null

        return view('assign-roles.index', compact('usuarios', 'roles', 'usuariosConRoles', 'rolActual'));
    }

    public function assign(Request $request)
    {
        $usuario = User::findOrFail($request->usuario_id);
        $rol = Role::findOrFail($request->rol_id);

        $usuario->syncRoles($rol);

        return redirect()->route('assign-roles.index')->with('success', 'Rol asignado correctamente.');
    }
}
