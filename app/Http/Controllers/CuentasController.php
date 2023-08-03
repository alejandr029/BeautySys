<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class CuentasController extends Controller
{
    public function index()
    {
        $users = User::all(); //->Paginate(5);
        session(['activeTab' => 'Cuentas']);
        return view('Cuentas.cuentas', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        session(['activeTab' => 'Cuentas']);
        return view('Cuentas.crearCuenta', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users|max:255',
            'password' => 'required|string|min:8',
            'rol_id' => 'required|exists:roles,id'
        ]);

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);

            $user->assignRole($request->rol_id);
            session(['activeTab' => 'Cuentas']);
            // Mostrar mensaje de éxito
            return redirect()->route('Cuentas.index')->with('success', 'Usuario creado correctamente.');

        } catch (\Exception $e) {
            // Mostrar mensaje de error
            return redirect()->route('Cuentas.index')->with('error', 'No se pudo crear el usuario.');
        }
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        session(['activeTab' => 'Cuentas']);
        return view('Cuentas.vistaCuentas', compact('user'));

        // dump($user);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        session(['activeTab' => 'Cuentas']);
        return view('Cuentas.actualizarCuenta', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email,' . $id,
            'rol_id' => 'required|exists:roles,id'
        ]);

        try {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            $user->syncRoles([$request->rol_id]);
            session(['activeTab' => 'Cuentas']);
            // Mostrar mensaje de éxito
            return redirect()->route('Cuentas.index')->with('success', 'Usuario actualizado correctamente.');

        } catch (\Exception $e) {
            // Mostrar mensaje de error
            return redirect()->route('Cuentas.index')->with('error', 'No se pudo actualizar el usuario.');
        }
    }

    public function destroyForm($id)
    {
        $user = User::findOrFail($id);
        session(['activeTab' => 'Cuentas']);
        return view('Cuentas.eliminarCuenta', compact('user'));
    }

    public function destroy(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Verificar si el usuario actual intenta eliminar su propia cuenta
        if ($user->id === Auth::id()) {
            // Redirigir con un mensaje de error si el usuario intenta eliminar su propia cuenta
            return redirect()->route('Cuentas.index')->with('error', 'No puedes eliminar tu propia cuenta.');
        }

        try {
            $user->delete();
            session(['activeTab' => 'Cuentas']);
            // Mostrar mensaje de éxito
            return redirect()->route('Cuentas.index')->with('success', 'Usuario eliminado correctamente.');

        } catch (\Exception $e) {
            // Mostrar mensaje de error
            return redirect()->route('Cuentas.index')->with('error', 'No se pudo eliminar el usuario.');
        }
    }
}
