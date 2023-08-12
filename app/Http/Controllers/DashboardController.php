<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;



class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $id = Auth::user()->id;


        $today = Carbon::today()->format('Y-m-d');
        $hour = Carbon::now()->format('H:i');

        if(auth()->user()->hasRole(['admin', 'staff'])){
            $Citas = DB::table('estetico.cita as C')
                ->select('P.primer_apellido', 'S.nombre', 'C.fecha_cita', 'C.id_cita','C.hora_cita')
                ->join('usuario.paciente as P', 'P.id_paciente', '=', 'C.id_paciente')
                ->join('locacion.sala as S', 'S.id_sala', '=', 'C.id_sala')
                ->whereNotIn('C.id_estado_cita', [2, 4, 6, 7, 8, 10])
                ->whereDate('C.fecha_cita', $today)
                ->whereTime('C.hora_cita', '>',  $hour )
                ->orderBy('C.hora_cita')
                ->paginate(5);

                $Consultas = DB::table('estetico.consulta as C')
                ->select('P.primer_apellido','S.nombre','c.fecha_visita')
                ->join('usuario.paciente as P', 'P.id_paciente', '=', 'C.id_paciente')
                ->join('locacion.sala as S', 'S.id_sala', '=', 'C.id_sala')
                ->whereNotIn('C.id_status_consulta', [2, 3, 4])
                ->whereDate('C.fecha_visita', $today)
                ->whereTime('C.fecha_visita', '>',  $hour )
                ->orderBy('C.fecha_visita')
                ->paginate(5);

                $Cirugias = DB::table('estetico.Cirugia as C')
                ->select('P.primer_apellido','S.nombre','C.fecha_cirugia')
                ->join('usuario.paciente as P', 'P.id_paciente', '=', 'C.id_paciente')
                ->join('locacion.sala as S', 'S.id_sala', '=', 'C.id_sala')
                ->whereNotIn('C.id_estatus_cirugia', [5,6,7,9,10])
                ->whereDate('C.fecha_cirugia', $today)
                ->whereTime('C.fecha_cirugia', '>',  $hour )
                ->orderBy('C.fecha_cirugia')
                ->paginate(5);
            session(['activeTab' => 'Dashboard']);
        }
        if(auth()->user()->hasRole(['user'])){
            
            $paciente = DB::table('usuario.paciente')
            ->select('id_paciente','primer_nombre','segundo_nombre','primer_apellido','segundo_apellido','fecha_nacimiento','genero','telefono','seguro_medico','dirreccion','correo','foto','id_cuenta')
            ->where('id_cuenta', $id)
            ->first();


            $Citas = DB::table('estetico.cita as C')
            ->select('P.primer_apellido', 'S.nombre', 'C.fecha_cita', 'C.id_cita','C.hora_cita')
            ->join('usuario.paciente as P', 'P.id_paciente', '=', 'C.id_paciente')
            ->join('locacion.sala as S', 'S.id_sala', '=', 'C.id_sala')
            ->whereNotIn('C.id_estado_cita', [2, 4, 6, 7, 8, 10])
            ->whereDate('C.fecha_cita', $today)
            ->whereTime('C.hora_cita', '>',  $hour )
            ->where('C.id_paciente', $paciente->id_paciente)
            ->orderBy('C.hora_cita')
            ->paginate(5);

            $Consultas = DB::table('estetico.consulta as C')
            ->select('P.primer_apellido','S.nombre','c.fecha_visita')
            ->join('usuario.paciente as P', 'P.id_paciente', '=', 'C.id_paciente')
            ->join('locacion.sala as S', 'S.id_sala', '=', 'C.id_sala')
            ->whereNotIn('C.id_status_consulta', [2, 3, 4])
            ->whereDate('C.fecha_visita', $today)
            ->whereTime('C.fecha_visita', '>',  $hour )
            ->where('C.id_paciente', $paciente->id_paciente)
            ->orderBy('C.fecha_visita')
            ->paginate(5);

            $Cirugias = DB::table('estetico.Cirugia as C')
            ->select('P.primer_apellido','S.nombre','C.fecha_cirugia')
            ->join('usuario.paciente as P', 'P.id_paciente', '=', 'C.id_paciente')
            ->join('locacion.sala as S', 'S.id_sala', '=', 'C.id_sala')
            ->whereNotIn('C.id_estatus_cirugia', [5,6,7,9,10])
            ->whereDate('C.fecha_cirugia', $today)
            ->whereTime('C.fecha_cirugia', '>',  $hour )
            ->where('C.id_paciente', $paciente->id_paciente)
            ->orderBy('C.fecha_cirugia')
            ->paginate(5);

            session(['activeTab' => 'Dashboard']);

        }
        
        return view('dashboard',compact('Citas','today','Consultas','Cirugias'));
    }


    public function index_user (string $id)
    {
        
        $today = Carbon::today()->format('Y-m-d');
        $hour = Carbon::now()->format('H:i');
        
        $paciente = DB::table('usuario.paciente')
        ->select('id_paciente','primer_nombre','segundo_nombre','primer_apellido','segundo_apellido','fecha_nacimiento','genero','telefono','seguro_medico','dirreccion','correo','foto','id_cuenta')
        ->where('id_cuenta', $id)
        ->first();


        $Citas_user = DB::table('estetico.cita as C')
            ->select('P.primer_apellido', 'S.nombre', 'C.fecha_cita', 'C.id_cita','C.hora_cita')
            ->join('usuario.paciente as P', 'P.id_paciente', '=', 'C.id_paciente')
            ->join('locacion.sala as S', 'S.id_sala', '=', 'C.id_sala')
            ->whereNotIn('C.id_estado_cita', [2, 4, 6, 7, 8, 10])
            ->whereDate('C.fecha_cita', $today)
            ->whereTime('C.hora_cita', '>',  $hour )
            ->where('C.id_paciente', $paciente->id_paciente)
            ->orderBy('C.hora_cita')
            ->paginate(5);

            $Consultas_user = DB::table('estetico.consulta as C')
            ->select('P.primer_apellido','S.nombre','c.fecha_visita')
            ->join('usuario.paciente as P', 'P.id_paciente', '=', 'C.id_paciente')
            ->join('locacion.sala as S', 'S.id_sala', '=', 'C.id_sala')
            ->whereNotIn('C.id_status_consulta', [2, 3, 4])
            ->whereDate('C.fecha_visita', $today)
            ->whereTime('C.fecha_visita', '>',  $hour )
            ->where('C.id_paciente', $paciente->id_paciente)
            ->orderBy('C.fecha_visita')
            ->paginate(5);

            $Cirugias_user = DB::table('estetico.Cirugia as C')
            ->select('P.primer_apellido','S.nombre','C.fecha_cirugia')
            ->join('usuario.paciente as P', 'P.id_paciente', '=', 'C.id_paciente')
            ->join('locacion.sala as S', 'S.id_sala', '=', 'C.id_sala')
            ->whereNotIn('C.id_estatus_cirugia', [5,6,7,9,10])
            ->whereDate('C.fecha_cirugia', $today)
            ->whereTime('C.fecha_cirugia', '>',  $hour )
            ->where('C.id_paciente', $paciente->id_paciente)
            ->orderBy('C.fecha_cirugia')
            ->paginate(5);
            dump($Citas_user);
            dump($Consultas_user);
            
            dump($Cirugias_user);
        session(['activeTab' => 'Dashboard']);

        // return view('dashboarduser',compact('Citas_user','today','Consultas_user','Cirugias_user'));
        
        // return view('dashboard',['id'=> $id, 'paciente_user' => $paciente_user , 'Citas_user'=>$Citas_user,'Consultas_user'=>$Consultas_user,'Cirugias_user'=>$Cirugias_user, 'today' => $today]);

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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
