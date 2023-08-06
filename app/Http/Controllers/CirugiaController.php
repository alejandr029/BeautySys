<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class CirugiaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Cirugias = DB::table('estetico.Cirugia AS C')
        ->select(
            'c.id_cirugia',
            'c.fecha_cirugia',
            's.nombre as nombresala',
            'tc.nombre as nombreCirugia',
            DB::raw("CONCAT(p.primer_nombre,' ',p.primer_apellido,' ',p.segundo_nombre) as nombrePaciente"),
            'ec.nombre as estatusCirugia',
            DB::raw("CONCAT(pp.primer_nombre,' ',pp.primer_apellido,' ',pp.segundo_apellido) as nombrePersonalAcargo"),
            'c.id_consulta'
        )
        ->join('estetico.Estatus_cirugia AS EC', 'EC.id_estatus_cirugia', '=', 'C.id_estatus_cirugia')
        ->join('locacion.sala AS S', 'S.id_sala', '=', 'C.id_sala')
        ->join('estetico.tipo_cirugia as TC', 'TC.id_tipo_cirugia', '=', 'C.id_tipo_cirugia')
        ->join('usuario.paciente as P', 'p.id_paciente', '=', 'C.id_paciente')
        ->join('personal.personal as PP', 'pp.id_personal', '=', 'C.id_personal')
        ->orderByDesc('C.id_cirugia')
        ->Paginate(5); 

        session(['activeTab' => 'Cirugias']);

        return view('Cirugia.cirugiaTabla', compact('Cirugias'));

    }
    public function selectConsultas()
    {
        $SelectConsultas = DB::table('estetico.consulta AS C')
        ->select('C.id_consulta','C.id_paciente',DB::raw("CONCAT(p.primer_nombre,' ',p.primer_apellido,' ',p.segundo_nombre) as nombrePaciente"))
        ->join('usuario.paciente as P', 'P.id_paciente', '=', 'C.id_paciente')
        ->join('personal.personal as PP', 'PP.id_personal', '=', 'C.id_personal')
        ->leftJoin('estetico.cirugia AS CR', 'C.id_consulta', '=', 'CR.id_consulta')
        ->where('C.aprovacion_cirugia', 1)
        ->where('C.id_status_consulta', 3)
        ->whereNull('CR.id_consulta')
        ->get();

        $SelectPersonal = DB::table('personal.personal as P')
        ->join('personal.departamento as D', 'P.id_departamento', '=', 'D.id_departamento')
        ->select('P.id_personal', DB::raw("CONCAT(P.primer_nombre, ' ', P.primer_apellido, ' ', P.segundo_apellido) as nombrePersonalAcargo"), 'D.nombre as nombreDepartamento')    
        ->get();

        $SelectSalas = DB::table('locacion.sala')
        ->select('id_sala','nombre')
        ->where('id_estado_sala', '=', 1)
        ->get();

        $SelectCirugias = DB::table('estetico.tipo_cirugia')
        ->select('id_tipo_cirugia','nombre')
        ->get();

        $SelectEstatusCirugia = DB::table('estetico.Estatus_cirugia')
        ->select('id_estatus_cirugia','nombre')
        ->get();

        session(['activeTab' => 'Cirugias']);

        return view('Cirugia.cirugiaCrear', compact('SelectConsultas','SelectPersonal','SelectSalas','SelectCirugias','SelectEstatusCirugia'));

    }
    public function pacienteCirugia(int $id)
    {
        $datlospaciente = DB::table('estetico.consulta AS C')
        ->join('usuario.paciente AS P', 'P.id_paciente', '=', 'C.id_paciente')
        ->select('C.id_consulta','C.id_paciente', DB::raw("CONCAT(P.primer_nombre, ' ', P.primer_apellido, ' ', P.segundo_nombre) as nombrePaciente"), 'P.correo as correoPaciente', 'P.telefono as telefonoPaciente')
        ->where('C.id_consulta', $id)
        ->first();

        session(['activeTab' => 'Cirugias']);

        return response()->json($datlospaciente);

    }

    public function datosCirugia(int $id)
    {
        $datoscirugia = DB::table('estetico.tipo_cirugia')
            ->select('nombre', 'precio_unitario', 'tiempo_estimado_cirugia', 'tiempo_estimado_recuperacion')
            ->where('id_tipo_cirugia', $id)
            ->first();

        session(['activeTab' => 'Cirugias']);


        return response()->json($datoscirugia);

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
