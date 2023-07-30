<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;


class CreateNewUserController extends Controller
{
    public function create()
    {
        $roles = Role::all();
        return view('create-user', compact('roles'));
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

            // Mostrar mensaje de éxito
            Session::flash('success', 'Usuario creado correctamente.');

        } catch (\Exception $e) {
            // Mostrar mensaje de error
            Session::flash('error', 'No se pudo crear el usuario.');
        }

        return redirect()->route('user.create');
    }
}
