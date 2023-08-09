<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;



class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        $today = Carbon::today()->format('Y-m-d');
        $hour = Carbon::now()->format('H:i');

        $Citas = DB::table('estetico.cita as C')
            ->select('P.primer_apellido', 'S.nombre', 'C.fecha_cita', 'C.id_cita','C.hora_cita')
            ->join('usuario.paciente as P', 'P.id_paciente', '=', 'C.id_paciente')
            ->join('locacion.sala as S', 'S.id_sala', '=', 'C.id_sala')
            ->whereNotIn('C.id_estado_cita', [2, 4, 6, 7, 8, 10])
            ->whereDate('C.fecha_cita', $today)
            ->whereTime('C.hora_cita', '>',  $hour )
            ->orderByDesc('C.hora_cita')
            ->paginate(5);

            $Consultas = DB::table('estetico.consulta as C')
            ->select('P.primer_apellido','S.nombre','c.fecha_visita')
            ->join('usuario.paciente as P', 'P.id_paciente', '=', 'C.id_paciente')
            ->join('locacion.sala as S', 'S.id_sala', '=', 'C.id_sala')
            ->whereNotIn('C.id_status_consulta', [2, 3, 4])
            ->whereDate('C.fecha_visita', $today)
            ->whereTime('C.fecha_visita', '>',  $hour )
            ->orderByDesc('C.fecha_visita')
            ->paginate(5);

            $Cirugias = DB::table('estetico.Cirugia as C')
            ->select('P.primer_apellido','S.nombre','C.fecha_cirugia')
            ->join('usuario.paciente as P', 'P.id_paciente', '=', 'C.id_paciente')
            ->join('locacion.sala as S', 'S.id_sala', '=', 'C.id_sala')
            ->whereNotIn('C.id_estatus_cirugia', [5,6,7,9,10])
            ->whereDate('C.fecha_cirugia', $today)
            ->whereTime('C.fecha_cirugia', '>',  $hour )
            ->orderByDesc('C.fecha_cirugia')
            ->paginate(5);


          //dump($hour);  
            
            session(['activeTab' => 'Dashboard']);
            
        return view('dashboard',compact('Citas','today','Consultas','Cirugias'));
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
