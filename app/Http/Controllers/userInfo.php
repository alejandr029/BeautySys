<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Storage;



class userInfo extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        session(['activeTab' => 'Perfil']);

        $user = User::findOrFail($id);
        // $roles = Role::all();

        $paciente = DB::table('users as U')
        ->select('UP.primer_nombre','UP.segundo_nombre','UP.primer_apellido','UP.segundo_apellido','UP.fecha_nacimiento','UP.genero','UP.telefono','UP.dirreccion','UP.seguro_medico','foto','UP.correo','UP.id_cuenta')
        ->join('usuario.paciente as UP', 'UP.id_cuenta', '=', 'U.id')
        ->where('U.id',$id)
        ->first();

        // dump($user);
        // dump($paciente);
        // dump($roles);

        // session(['activeTab' => 'Cuentas']);
        return view('PerfilUsuario.perfil', compact('user','paciente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dump($request->all());
        // dump($id);


        //     Validar y almacenar la imagen
        // if ($request->hasFile('file')) {
        //     Crear la carpeta si no existe
        //     $carpetaUsuario = 'fotosPerfiles/' . $id;
        //     Storage::disk('fotosPerfiles')->makeDirectory($carpetaUsuario);

        //     Guardar la imagen
        //     $imagen = $request->file('file');
        //     $rutaImagen = $imagen->store($carpetaUsuario);

        //     dump($rutaImagen);
        // }

        $user = User::findOrFail($id);


        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

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

        return redirect()->route('userInfo', ['id' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
