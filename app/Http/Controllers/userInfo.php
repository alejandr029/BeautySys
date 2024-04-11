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
        $user = User::findOrFail($id);
    
        // Obtener el id del paciente
        $idPaciente = $user->id;
    
        // Crear la ruta de la carpeta del paciente
        $carpetaPaciente = "fotosPerfiles/paciente_{$idPaciente}";
    
        // Verificar si la carpeta del paciente existe
        if (!Storage::disk('public')->exists($carpetaPaciente)) {
            // Si no existe, crearla recursivamente
            Storage::disk('public')->makeDirectory($carpetaPaciente, 0755, true);
        }
    
        if ($request->hasFile('profile_image')) {
            // Obtener el archivo de imagen
            $imagen = $request->file('profile_image');
    
            // Generar un nombre único para la imagen
            $nombreImagen = uniqid() . '_' . $imagen->getClientOriginalName();
    
            // Guardar la imagen en la carpeta del paciente
            $rutaImagen = $imagen->storeAs($carpetaPaciente, $nombreImagen, 'public');
    
            // Actualizar los datos del usuario y la foto en la base de datos
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
    
            DB::table('usuario.paciente')
                ->where('id_cuenta', $id)
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
                    'foto' => $rutaImagen
                ]);

                DB::table('users')
                ->where('id', $id)
                ->update([
                    'profile_photo_path' => $rutaImagen,
                ]);
        }
    
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
