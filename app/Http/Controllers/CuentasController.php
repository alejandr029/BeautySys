<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class CuentasController extends Controller
{
    public function index()
    {
        $users = User::orderByDesc('id')->paginate(5); //->Paginate(5);
        session(['activeTab' => 'Cuentas']);
        return view('Cuentas.cuentas', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();

        $departamento = DB::table('personal.departamento')
        ->select('id_departamento','nombre')
        ->orderByDesc('id_departamento')
        ->get();

        $horario = DB::table('personal.horario')
        ->select('id_horario','dias','hora_inicio','hora_final')
        ->orderByDesc('id_horario')
        ->get();
        



        session(['activeTab' => 'Cuentas']);
        return view('Cuentas.crearCuenta', compact('roles','departamento','horario'));
    }

    public function store(Request $request)
    {
        dump($request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users|max:255',
            'password' => 'required|string|min:8',
            'rol_id' => 'required|exists:roles,id'
        ]);

        try {
            // $user = User::create([
            //     'name' => $request->name,
            //     'email' => $request->email,
            //     'password' => bcrypt($request->password),
            // ]);
            
            $idUser = DB::getPdo()->lastInsertId();

            // $user->assignRole($request->rol_id);

            // if($request->rol_id == "3"){
            //     DB::table('usuario.paciente')->insert([
            //         'primer_nombre' => $request->name,
            //         'segundo_nombre' => $request->secondname,
            //         'primer_apellido' => $request->lastname,
            //         'segundo_apellido' => $request->secondlastname,
            //         'fecha_nacimiento' => $request->fecha, 
            //         'genero' => $request->genero,
            //         'telefono' => $request->numeroTelefono,
            //         'seguro_medico' => $request->seguroMedico,
            //         'dirreccion' => $request->direccion,
            //         'correo' => $request->email,
            //         'id_cuenta' => $idUser,
            //     ]);              
            // }
            // if($request->rol_id == "2"){
                // DB::table('personal.personal')->insert([
                //     'primer_nombre' => $request->name,
                //     'segundo_nombre' => $request->secondname,
                //     'primer_apellido' => $request->lastname,
                //     'segundo_apellido' => $request->secondlastname,
                //     'genero' => $request->genero,
                //     'fecha_nacmiento' => $request->fecha,
                //     'telefono' => $request->numeroTelefono,
                //     'correo' => $request->email,
                //     'dirreccion' => $request->direccion,
                //     'id_departamento' => $request->departamento,
                //     'id_horario' => $request->horario,
                //     'id_cuenta' => $idUser,
                // ]);
            // }

            session(['activeTab' => 'Cuentas']);
            // Mostrar mensaje de éxito
            // return redirect()->route('Cuentas.index')->with('success', 'Usuario creado correctamente.');

        } catch (\Exception $e) {
            // Mostrar mensaje de error
            // return redirect()->route('Cuentas.index')->with('error', 'No se pudo crear el usuario.');
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
        //dump($request::all());

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
