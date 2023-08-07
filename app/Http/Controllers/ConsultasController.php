<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConsultasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $consultas = DB::table('estetico.consulta as ec')
        ->select(
            'ec.id_consulta as id',
            'ec.fecha_visita as fecha',
            DB::raw("concat(up.primer_apellido,' ', up.primer_nombre) as nombre_ps"),
            DB::raw("concat(pp.primer_apellido,' ', pp.primer_nombre) as nombre_pp"),
            'ec.aprovacion_cirugia as aprovacion',
            'esc.nombre as estatus',
            'ls.nombre as nombre_sala',
            'les.nombre as estado_sala'
        )
        ->join('usuario.paciente as up', 'up.id_paciente', '=', 'ec.id_paciente')
        ->join('personal.personal as pp', 'pp.id_personal', '=', 'ec.id_personal')
        ->join('estetico.status_consulta as esc', 'esc.id_status_consulta', '=', 'ec.id_status_consulta')
        ->join('locacion.sala as ls', 'ls.id_sala', '=', 'ec.id_sala')
        ->join('locacion.estado_sala as les', 'les.id_estado_sala', '=', 'ls.id_estado_sala')
        ->orderByDesc('ec.id_consulta ')

        ->Paginate(5); 
        
        session(['activeTab' => 'Consultas']);
        return view('consultas.consultas',compact('consultas'));
    }

    public function crear(){

        $SelectPersonal = DB::table('personal.personal as P')
        ->join('personal.departamento as D', 'P.id_departamento', '=', 'D.id_departamento')
        ->select('P.id_personal', DB::raw("CONCAT(P.primer_nombre, ' ', P.primer_apellido, ' ', P.segundo_apellido) as nombrePersonalAcargo"), 'D.nombre as nombreDepartamento')    
        ->get();

        $sala = DB::table('locacion.sala as ls')
        ->select('ls.id_sala', 'ls.nombre', 'ls.capacidad','les.nombre as status')
        ->join('locacion.estado_sala as les','les.id_estado_sala', '=', 'ls.id_estado_sala')
        ->where('ls.nombre', 'like',"%Consultoria%")
        ->where('les.nombre', 'like',"%Disponible%")
        ->get();

        $status = DB::table('estetico.status_consulta')
        ->select('id_status_consulta', 'nombre')
        ->get();


        
        session(['activeTab' => 'Consultas']);
        return view('consultas.consultacrear',compact('SelectPersonal','sala','status'));
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
