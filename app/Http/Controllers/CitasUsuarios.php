<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\CitasUsuario;
use App\Models\Personal;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class CitasUsuarios extends Controller
{
    public function index() {
        //consulta de citas por usuario
        $citas = DB::table('estetico.cita')
        ->select('id_cita','hora_cita','fecha_cita','id_personal','id_estado_cita','id_sala')
        //->where('id_paciente' = $id_cliente )
        ->get();

        $user = Auth::id();

        $usuarios = DB::table('usuario.paciente')
        ->select('id_paciente','primer_nombre','primer_apellido','correo')
        ->where('id_cuenta', $user)
        ->get();

        $tipos = DB::table('estetico.tipo_cita')
        ->select('id_tipo_cita','nombre','precio_unitario')
        ->get();

        // dump($usuarios);
        session(['activeTab' => 'CitasUsuarios']);
        return view('CitasUsuarios.CitasUsuarios', compact('citas','usuarios','tipos'));
    }

    public function crear(Request $request){

        //Obtener id del paciente
        $user = Auth::id();
        $usuarios = DB::table('usuario.paciente')
        ->select('id_paciente','primer_nombre','primer_apellido','correo')
        ->where('id_cuenta', $user)
        ->get();

        // Obtener los datos del formulario
        $idPaciente = $usuarios[0]->id_paciente;
        $nombre = $request->input('nombre');
        $correo = $request->input('correo');
        $fechaCita = $request->input('fecha_cita');
        $hora = $request->input('hora');
        $tipo_cita = $request->input('tipo');

        try {
            DB::table('estetico.cita')->insert([
                'hora_cita'=>$hora,
                'fecha_cita'=>$fechaCita,
                'id_paciente'=>$idPaciente,
               'id_personal' => null,
               'id_estado_cita' => 8,
               'id_sala' => null,
               'id_tipo_cita' => $tipo_cita,
               'id_insumos' => null,
               'id_equipo' => null,
            ]);


            session(['activeTab' => 'CitasUsuarios']);
            // return view('CitasUsuarios.CitasUsuarios');
            echo "<script>
            alert(La cita se aagendado correctamente');
            window.location='/CitaUssuarios';
            </script>";
        } catch (\Throwable $th) {
            //throw $th;
            session(['activeTab' => 'CitasUsuarios']);
            return view('CitasUsuarios.CitasUsuarios');
            echo "<script>
            alert(El sistema se encuentra temporalmente fuera de servicio');
            window.location='/CitaUssuarios';
            </script>";
        }

        // dd('Aqui ando UwU');


    }

    /*public function crear(Request $request){
        $request->validate([
            'fecha_cita' => 'required|date',
            'hora' => 'required',
            'tipo'=>'required',
        ]);

        //Obtener id del paciente
        $user = Auth::id();
        dd($user);
        $usuarios = DB::table('usuario.paciente')
        ->select('id_paciente','primer_nombre','primer_apellido','correo')
        ->where('id_cuenta', $user)
        ->get();

        // Obtener los datos del formulario
        $idPaciente = $usuarios->id_paciente;
        $nombre = $request->input('nombre');
        $correo = $request->input('correo');
        $fechaCita = $request->input('fecha_cita');
        $hora = $request->input('hora');
        $tipo_cita = $request->input('tipo');

        try {
            DB::table('estetico.cita')->insert([
                'hora_cita'=>$hora,
                'fecha_cita'=>$fechaCita,
                'id_paciente'=>$idPaciente,
               'id_personal' => null,
               'id_estado_cita' => 8,
               'id_sala' => null,
               'id_tipo_cita' => $tipo_cita,
               'id_insumos' => null,
               'id_equipo' => null,
            ]);


            session(['activeTab' => 'CitasUsuarios']);
            return view('CitasUsuarios.CitasUsuarios');
            // echo "<script>
            // alert(La cita se aagendado correctamente');
            // window.location='/CitaUssuarios';
            // </script>";
        } catch (\Throwable $th) {
            //throw $th;
            session(['activeTab' => 'CitasUsuarios']);
            return view('CitasUsuarios.CitasUsuarios');
            // echo "<script>
            // alert(El sistema se encuentra temporalmente fuera de servicio');
            // window.location='/CitaUssuarios';
            // </script>";
        }

    }*/
}
