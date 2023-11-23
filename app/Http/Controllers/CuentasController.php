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
        //dump($request->all());
//        $request->validate([
//            'name' => 'required|string|max:255',
//            'email' => 'required|string|email|unique:users|max:255',
//            'password' => 'required|string|min:8',
//            'rol_id' => 'required'
//        ]);

        try {
            if ($request->rol_id == "1"){
                $user = User::create([
                    'name' => $request->nameadmin,
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                ]);
            } else {
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                ]);
            }

            $idUser = DB::getPdo()->lastInsertId();

            $user->assignRole($request->rol_id);

            if($request->rol_id == "3"){
                DB::table('usuario.paciente')->insert([
                    'primer_nombre' => $request->name,
                    'segundo_nombre' => $request->secondname,
                    'primer_apellido' => $request->lastname,
                    'segundo_apellido' => $request->secondlastname,
                    'fecha_nacimiento' => $request->fecha,
                    'genero' => $request->genero,
                    'telefono' => $request->numeroTelefono,
                    'seguro_medico' => $request->seguroMedico,
                    'dirreccion' => $request->direccion,
                    'correo' => $request->email,
                    'id_cuenta' => $idUser,
                ]);
            }
            if($request->rol_id == "2"){
                DB::table('personal.personal')->insert([
                    'primer_nombre' => $request->name,
                    'segundo_nombre' => $request->secondname,
                    'primer_apellido' => $request->lastname,
                    'segundo_apellido' => $request->secondlastname,
                    'genero' => $request->genero,
                    'fecha_nacmiento' => $request->fecha,
                    'telefono' => $request->numeroTelefono,
                    'correo' => $request->email,
                    'dirreccion' => $request->direccion,
                    'id_departamento' => $request->departamento,
                    'id_horario' => $request->horario,
                    'id_cuenta' => $idUser,
                ]);
            }


            session(['activeTab' => 'Cuentas']);
            return redirect()->route('Cuentas.index')->with('success', 'Usuario creado correctamente.');

        } catch (\Exception $e) {
            //dd($e->getMessage());
            return redirect()->route('Cuentas.index')->with('error', 'No se pudo crear el usuario.');
        }
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();


        $paciente = DB::table('users as U')
        ->select('UP.primer_nombre','UP.segundo_nombre','UP.primer_apellido','UP.segundo_apellido','UP.fecha_nacimiento','UP.genero','UP.telefono','UP.dirreccion','UP.seguro_medico')
        ->join('usuario.paciente as UP', 'UP.id_cuenta', '=', 'U.id')
        ->where('U.id',$id)
        ->first();

        $personal = DB::table('users as U')
        ->select('PP.primer_nombre','PP.segundo_nombre','PP.primer_apellido','PP.segundo_apellido','PP.fecha_nacmiento','PP.genero','PP.telefono','PP.dirreccion','PP.id_departamento','PP.id_horario')
        ->join('personal.personal as PP','PP.id_cuenta', '=','U.id')
        ->where('U.id',$id)
        ->first();

        $departamento = DB::table('personal.departamento')
        ->select('id_departamento','nombre')
        ->orderByDesc('id_departamento')
        ->get();

        $horario = DB::table('personal.horario')
        ->select('id_horario','dias','hora_inicio','hora_final')
        ->orderByDesc('id_horario')
        ->get();

        session(['activeTab' => 'Cuentas']);
        return view('Cuentas.vistaCuentas', compact('user','roles','departamento','horario','paciente','personal'));

        // dump($user);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();


        $paciente = DB::table('users as U')
        ->select('UP.primer_nombre','UP.segundo_nombre','UP.primer_apellido','UP.segundo_apellido','UP.fecha_nacimiento','UP.genero','UP.telefono','UP.dirreccion','UP.seguro_medico')
        ->join('usuario.paciente as UP', 'UP.id_cuenta', '=', 'U.id')
        ->where('U.id',$id)
        ->first();

        $personal = DB::table('users as U')
        ->select('PP.primer_nombre','PP.segundo_nombre','PP.primer_apellido','PP.segundo_apellido','PP.fecha_nacmiento','PP.genero','PP.telefono','PP.dirreccion','PP.id_departamento','PP.id_horario')
        ->join('personal.personal as PP','PP.id_cuenta', '=','U.id')
        ->where('U.id',$id)
        ->first();

        $departamento = DB::table('personal.departamento')
        ->select('id_departamento','nombre')
        ->orderByDesc('id_departamento')
        ->get();

        $horario = DB::table('personal.horario')
        ->select('id_horario','dias','hora_inicio','hora_final')
        ->orderByDesc('id_horario')
        ->get();

        // dump($paciente);
        // dump($personal);

        session(['activeTab' => 'Cuentas']);
        return view('Cuentas.actualizarCuenta', compact('user', 'roles','departamento','horario','paciente','personal'));
    }

    public function update(Request $request, $id)
    {
        // dump($request->all());
        // dump($request->rol_id);

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

        $paciente = DB::table('users as U')
        ->select('UP.primer_nombre','UP.segundo_nombre','UP.primer_apellido','UP.segundo_apellido','UP.fecha_nacimiento','UP.genero','UP.telefono','UP.dirreccion','UP.seguro_medico')
        ->join('usuario.paciente as UP', 'UP.id_cuenta', '=', 'U.id')
        ->where('U.id',$id)
        ->first();

        $personal = DB::table('users as U')
        ->select('PP.primer_nombre','PP.segundo_nombre','PP.primer_apellido','PP.segundo_apellido','PP.fecha_nacmiento','PP.genero','PP.telefono','PP.dirreccion','PP.id_departamento','PP.id_horario')
        ->join('personal.personal as PP','PP.id_cuenta', '=','U.id')
        ->where('U.id',$id)
        ->first();

        if($paciente != null){
            DB::table('usuario.paciente')
            ->where('id_cuenta',$id)
            ->update([
                'primer_nombre' => $request->name,
                'segundo_nombre' => $request->secondname,
                'primer_apellido' => $request->lastname,
                'segundo_apellido' => $request->secondlastname,
                'fecha_nacimiento' => $request->fecha,
                'genero' => $request->genero,
                'telefono' => $request->numeroTelefono,
                'seguro_medico' => $request->seguroMedico,
                'dirreccion' => $request->direccion,
                'correo' => $request->email,
            ]);
        }
        if($personal != null){
            DB::table('personal.personal')
            ->where('id_cuenta',$id)
            ->update([
                'primer_nombre' => $request->name,
                'segundo_nombre' => $request->secondname,
                'primer_apellido' => $request->lastname,
                'segundo_apellido' => $request->secondlastname,
                'genero' => $request->genero,
                'fecha_nacmiento' => $request->fecha,
                'telefono' => $request->numeroTelefono,
                'correo' => $request->email,
                'dirreccion' => $request->direccion,
                'id_departamento' => $request->departamento,
                'id_horario' => $request->horario,
            ]);
        }


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

            $paciente = DB::table('users as U')
            ->select('UP.primer_nombre','UP.segundo_nombre','UP.primer_apellido','UP.segundo_apellido','UP.fecha_nacimiento','UP.genero','UP.telefono','UP.dirreccion','UP.seguro_medico')
            ->join('usuario.paciente as UP', 'UP.id_cuenta', '=', 'U.id')
            ->where('U.id',$id)
            ->first();

            $personal = DB::table('users as U')
            ->select('PP.primer_nombre','PP.segundo_nombre','PP.primer_apellido','PP.segundo_apellido','PP.fecha_nacmiento','PP.genero','PP.telefono','PP.dirreccion','PP.id_departamento','PP.id_horario')
            ->join('personal.personal as PP','PP.id_cuenta', '=','U.id')
            ->where('U.id',$id)
            ->first();


            // dump($paciente);
            // dump($personal);



            if($paciente != null){
                DB::table('usuario.paciente')
                ->where('id_cuenta', $id)
                ->delete();
            }
            if($personal != null){
                DB::table('personal.personal')
                ->where('id_cuenta', $id)
                ->delete();
            }
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
