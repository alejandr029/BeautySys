<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;

class AsignarRolController extends Controller
{
    public function index()
    {
        $usuarios = User::all();
        $roles = Role::all();
        $usuariosConRoles = User::role(['staff', 'admin'])->get();
        $rolActual = null; // Variable para almacenar el rol actual del usuario seleccionado, inicialmente se establece como null

        return view('asignar-roles', compact('usuarios', 'roles', 'usuariosConRoles', 'rolActual'));
    }

    public function assign(Request $request)
    {
        try {
            $usuario = User::findOrFail($request->usuario_id);
            $rol = Role::findOrFail($request->rol_id);

            $usuario->syncRoles($rol);

            // Mostrar mensaje de éxito
            Session::flash('success', 'Rol asignado correctamente.');

        } catch (\Exception $e) {
            // Mostrar mensaje de error
            Session::flash('error', 'No se pudo asignar el rol al usuario.');
        }

        return redirect()->route('asignar-roles.index');
    }
}
