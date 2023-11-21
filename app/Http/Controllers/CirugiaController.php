<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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
                'ec.nombre as estatusCirugia', 'C.id_estatus_cirugia',
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
            ->select('C.id_consulta', 'C.id_paciente', DB::raw("CONCAT(p.primer_nombre,' ',p.primer_apellido,' ',p.segundo_nombre) as nombrePaciente"))
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
            ->select('id_sala', 'nombre')
            ->where('id_estado_sala', '=', 1)
            ->get();

        $SelectCirugias = DB::table('estetico.tipo_cirugia')
            ->select('id_tipo_cirugia', 'nombre')
            ->get();

        $SelectEstatusCirugia = DB::table('estetico.Estatus_cirugia')
            ->select('id_estatus_cirugia', 'nombre')
            ->get();

        session(['activeTab' => 'Cirugias']);

        return view('Cirugia.cirugiaCrear', compact('SelectConsultas', 'SelectPersonal', 'SelectSalas', 'SelectCirugias', 'SelectEstatusCirugia'));

    }

    public function pacienteCirugia(int $id)
    {
        $datlospaciente = DB::table('estetico.consulta AS C')
            ->join('usuario.paciente AS P', 'P.id_paciente', '=', 'C.id_paciente')
            ->select('C.id_consulta', 'C.id_paciente', DB::raw("CONCAT(P.primer_nombre, ' ', P.primer_apellido, ' ', P.segundo_nombre) as nombrePaciente"), 'P.correo as correoPaciente', 'P.telefono as telefonoPaciente')
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

    public function datosAlergiaEnfermedades(int $id)
    {
        $alergias = DB::table('usuario.paciente as P')
            ->join('usuario.alergia as A', 'A.id_paciente', '=', 'P.id_paciente')
            ->join('usuario.tipo_alergia as TA', 'TA.id_tipo_alergia', '=', 'A.id_tipo_alergia')
            ->select('TA.nombre')
            ->where('P.id_paciente', $id)
            ->get();

        $enfermedades = DB::table('usuario.paciente as P')
            ->join('usuario.enfermedad_cronica as EC', 'EC.id_paciente', '=', 'P.id_paciente')
            ->join('usuario.tipo_enfermedad_cronica as TEC', 'TEC.id_tipo_enfermedad_cronica', '=', 'EC.id_tipo_enfermedad_cronica')
            ->select('TEC.nombre')
            ->where('P.id_paciente', $id)
            ->get();

        session(['activeTab' => 'Cirugias']);

        return response()->json(['alergias' => $alergias, 'enfermedades' => $enfermedades]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::table('estetico.Cirugia')->insert([
            'fecha_cirugia' => date('Y-m-d H:i:s', strtotime($request->fecha . ' ' . $request->hora)),
            'id_sala' => $request->sala,
            'id_tipo_cirugia' => $request->cirugia,
            'id_paciente' => $request->idPaciente,
            'id_estatus_cirugia' => $request->estatusCirugia,
            'id_personal' => $request->personal,
            'id_consulta' => $request->consultas,
        ]);

        DB::table('locacion.sala')
            ->where('id_sala', $request->sala)
            ->update(['id_estado_sala' => 2]);

        //dump($request->all());

        // Obtener el ID de la cirugía recién insertada
        $idCirugia = DB::getPdo()->lastInsertId();
        session(['activeTab' => 'Cirugias']);

        // Redirigir a la vista de actualización con el ID de la cirugía como parámetro
        return redirect()->route('vistaActualizarCirugia', ['id' => $idCirugia]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $DatosCirugia = DB::table('estetico.Cirugia')
            ->select('id_cirugia', 'fecha_cirugia', 'id_sala', 'id_tipo_cirugia', 'id_paciente', 'id_estatus_cirugia', 'id_personal', 'id_consulta')
            ->where('id_cirugia', $id)
            ->first();

        $SelectConsultas = DB::table('estetico.consulta AS C')
            ->select('C.id_consulta', 'C.id_paciente', DB::raw("CONCAT(p.primer_nombre,' ',p.primer_apellido,' ',p.segundo_nombre) as nombrePaciente"))
            ->join('usuario.paciente as P', 'P.id_paciente', '=', 'C.id_paciente')
            ->join('personal.personal as PP', 'PP.id_personal', '=', 'C.id_personal')
            ->leftJoin('estetico.cirugia AS CR', 'C.id_consulta', '=', 'CR.id_consulta')
            ->where('C.aprovacion_cirugia', 1)
            ->where('C.id_status_consulta', 3)
            ->where('CR.id_consulta', (int)$DatosCirugia->id_consulta)
            ->get();

        $SelectPersonal = DB::table('personal.personal as P')
            ->join('personal.departamento as D', 'P.id_departamento', '=', 'D.id_departamento')
            ->select('P.id_personal', DB::raw("CONCAT(P.primer_nombre, ' ', P.primer_apellido, ' ', P.segundo_apellido) as nombrePersonalAcargo"), 'D.nombre as nombreDepartamento')
            ->get();

        $SelectSalas = DB::table('locacion.sala')
            ->select('id_sala', 'nombre')
            ->where('id_sala', (int)$DatosCirugia->id_sala)
            ->first();

        $SelectCirugias = DB::table('estetico.tipo_cirugia')
            ->select('id_tipo_cirugia', 'nombre')
            ->get();

        $SelectEstatusCirugia = DB::table('estetico.Estatus_cirugia')
            ->select('id_estatus_cirugia', 'nombre')
            ->get();

        $insumos = DB::table('inventario.insumos')
            ->select('id_insumos', 'imagen', 'nombre', 'cantidad')
            ->where('id_estatus_insumos', 1)
            ->get();

        $equiposMedicos = DB::table('inventario.equipo_medico')
            ->select('id_equipo_medico', 'imagen', 'nombre', 'cantidad')
            ->where('id_estado_equipo', 1)
            ->get();

        $EquipoUsado = DB::table('estetico.equipo_cirugia as EC')
            ->select('EC.id_equipo_medico', 'EM.nombre', 'EC.cantidad')
            ->join('inventario.equipo_medico as EM', 'EM.id_equipo_medico', '=', 'EC.id_equipo_medico')
            ->where('EC.id_cirugia', (int)$DatosCirugia->id_cirugia)
            ->get();

        $InsumoUsado = DB::table('estetico.insumos_cirugia as IC')
            ->select('IC.id_insumos_cirugia', 'I.nombre', 'IC.cantidad')
            ->join('inventario.insumos as I', 'IC.id_insumos', '=', 'I.id_insumos')
            ->where('IC.id_cirugia', (int)$DatosCirugia->id_cirugia)
            ->get();


        // dump($DatosCirugia);
        // dump($SelectSalas);
        session(['activeTab' => 'Cirugias']);

        return view('Cirugia.cirugiaActualizar', compact('SelectConsultas', 'SelectPersonal', 'SelectSalas', 'SelectCirugias', 'SelectEstatusCirugia', 'DatosCirugia', 'insumos', 'equiposMedicos', 'EquipoUsado', 'InsumoUsado'));

    }

    public function añadirInsumoEquipo(Request $request)
    {
        $datos = $request->input('elementos');
        $idCirugia = $request->input('IdCirugia');

        // dump($datos);
        // dump($idCirugia);

        // Recorre los datos para procesarlos
        foreach ($datos as $idElemento => $elemento) {
            // Identifica el tipo (insumo o equipo médico), el ID y la cantidad
            $tipo = $elemento['Tipo'];
            $id = $elemento['id'];
            $cantidad = $elemento['cantidad'] ?? 0;
            if ($tipo == 'insumo' && $cantidad > 0) {

                $resultInsumos = DB::table('estetico.insumos_cirugia')
                    ->where('id_cirugia', $idCirugia)
                    ->where('id_insumos', $id)
                    ->get();

                DB::table('inventario.insumos')
                    ->where('id_insumos', $id)
                    ->decrement('cantidad', $cantidad);

                if ($resultInsumos->isEmpty()) {
                    DB::table('estetico.insumos_cirugia')->insert([
                        'id_cirugia' => $idCirugia,
                        'id_insumos' => $id,
                        'cantidad' => $cantidad,
                    ]);
                } else {
                    DB::table('estetico.insumos_cirugia')
                        ->where('id_cirugia', $idCirugia)
                        ->where('id_insumos', $id)
                        ->update(['cantidad' => DB::raw("cantidad + $cantidad")]);
                }
            }
            if ($tipo == 'equipomedico' && $cantidad > 0) {

                $resultEquipo = DB::table('estetico.equipo_cirugia')
                    ->where('id_cirugia', $idCirugia)
                    ->where('id_equipo_medico', $id)
                    ->get();


                DB::table('inventario.equipo_medico')
                    ->where('id_equipo_medico', $id)
                    ->decrement('cantidad', $cantidad);

                if ($resultEquipo->isEmpty()) {
                    DB::table('estetico.equipo_cirugia')->insert([
                        'id_cirugia' => $idCirugia,
                        'id_equipo_medico' => $id,
                        'cantidad' => $cantidad,
                    ]);
                } else {
                    DB::table('estetico.equipo_cirugia')
                        ->where('id_cirugia', $idCirugia)
                        ->where('id_equipo_medico', $id)
                        ->update(['cantidad' => DB::raw("cantidad + $cantidad")]);
                }


            }
        }
        session(['activeTab' => 'Cirugias']);

        return redirect()->route('vistaActualizarCirugia', ['id' => $idCirugia]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            DB::table('estetico.Cirugia')
                ->where('id_cirugia', $id)
                ->update([
                    'fecha_cirugia' => date('Y-m-d H:i:s', strtotime($request->fecha . ' ' . $request->hora)),
                    'id_estatus_cirugia' => $request->estatusCirugia,
                    'id_personal' => $request->personal,
                ]);
            if ($request->estatusCirugia == 6 || $request->estatusCirugia == 7 || $request->estatusCirugia == 10) {
                $equipoUsados = DB::table('estetico.equipo_cirugia')
                    ->select('id_equipo_medico', 'cantidad')
                    ->where('id_cirugia', $id)
                    ->get();

                $insumosUsados = DB::table('estetico.insumos_cirugia')
                    ->select('id_insumos', 'cantidad')
                    ->where('id_cirugia', $id)
                    ->get();

                if (!$equipoUsados->isEmpty()) {
                    foreach ($equipoUsados as $idElemento) {
                        DB::table('inventario.equipo_medico')
                            ->where('id_equipo_medico', $idElemento->id_equipo_medico)
                            ->update(['cantidad' => DB::raw("cantidad + $idElemento->cantidad")]);
                    }

                    DB::table('estetico.equipo_cirugia')->where('id_cirugia', $id)->delete();
                }

                if (!$insumosUsados->isEmpty()) {
                    foreach ($insumosUsados as $idElemento) {
                        DB::table('inventario.insumos')
                            ->where('id_insumos', $idElemento->id_insumos)
                            ->update(['cantidad' => DB::raw("cantidad + $idElemento->cantidad")]);
                    }
                    DB::table('estetico.insumos_cirugia')->where('id_cirugia', $id)->delete();

                }

                $salaAcambiar = DB::table('estetico.Cirugia')
                    ->select('id_sala')
                    ->where('id_cirugia', $id)
                    ->first();

                DB::table('locacion.sala')
                    ->where('id_sala', $salaAcambiar->id_sala)
                    ->update(['id_estado_sala' => 1]);
            }
            if ($request->estatusCirugia == 5) {
                $equipoUsados = DB::table('estetico.equipo_cirugia')
                    ->select('id_equipo_medico', 'cantidad')
                    ->where('id_cirugia', $id)
                    ->get();

                $insumosUsados = DB::table('estetico.insumos_cirugia')
                    ->select('id_insumos', 'cantidad')
                    ->where('id_cirugia', $id)
                    ->get();

                if (!$equipoUsados->isEmpty()) {
                    foreach ($equipoUsados as $idElemento) {
                        $devolver = DB::table('inventario.equipo_medico')
                            ->select('id_equipo_medico', 'devolucion')
                            ->where('id_equipo_medico', $idElemento->id_equipo_medico)
                            ->first();

                        if ($devolver->devolucion == true) {
                            DB::table('inventario.equipo_medico')
                                ->where('id_equipo_medico', $idElemento->id_equipo_medico)
                                ->update(['cantidad' => DB::raw("cantidad + $idElemento->cantidad")]);
                        }
                    }
                }

                if (!$insumosUsados->isEmpty()) {
                    foreach ($insumosUsados as $idElemento) {
                        $devolver = DB::table('inventario.insumos')
                            ->select('id_insumos', 'devolucion')
                            ->where('id_insumos', $idElemento->id_insumos)
                            ->first();
                        if ($devolver->devolucion == true) {
                            DB::table('inventario.insumos')
                                ->where('id_insumos', $idElemento->id_insumos)
                                ->update(['cantidad' => DB::raw("cantidad + $idElemento->cantidad")]);
                        }
                    }
                }
                $salaAcambiar = DB::table('estetico.Cirugia')
                    ->select('id_sala')
                    ->where('id_cirugia', $id)
                    ->first();

                DB::table('locacion.sala')
                    ->where('id_sala', $salaAcambiar->id_sala)
                    ->update(['id_estado_sala' => 1]);
            }

            session(['activeTab' => 'Cirugias']);
            return redirect()->route('tablaCirugia')->with('success', 'Cirugía actualizada exitosamente');
        } catch (\Exception $e) {
            //dump($e);
            return redirect()->route('tablaCirugia')->with('error', 'Error al actualizar la cirugía');
        }


    }

    public function vistaCirugia(string $id)
    {

        $DatosCirugia = DB::table('estetico.Cirugia')
            ->select('id_cirugia', 'fecha_cirugia', 'id_sala', 'id_tipo_cirugia', 'id_paciente', 'id_estatus_cirugia', 'id_personal', 'id_consulta')
            ->where('id_cirugia', $id)
            ->first();

        $SelectConsultas = DB::table('estetico.consulta AS C')
            ->select('C.id_consulta', 'C.id_paciente', DB::raw("CONCAT(p.primer_nombre,' ',p.primer_apellido,' ',p.segundo_nombre) as nombrePaciente"))
            ->join('usuario.paciente as P', 'P.id_paciente', '=', 'C.id_paciente')
            ->join('personal.personal as PP', 'PP.id_personal', '=', 'C.id_personal')
            ->leftJoin('estetico.cirugia AS CR', 'C.id_consulta', '=', 'CR.id_consulta')
            ->where('C.aprovacion_cirugia', 1)
            ->where('C.id_status_consulta', 3)
            ->where('CR.id_consulta', (int)$DatosCirugia->id_consulta)
            ->get();

        $SelectPersonal = DB::table('personal.personal as P')
            ->join('personal.departamento as D', 'P.id_departamento', '=', 'D.id_departamento')
            ->select('P.id_personal', DB::raw("CONCAT(P.primer_nombre, ' ', P.primer_apellido, ' ', P.segundo_apellido) as nombrePersonalAcargo"), 'D.nombre as nombreDepartamento')
            ->get();

        $SelectSalas = DB::table('locacion.sala')
            ->select('id_sala', 'nombre')
            ->where('id_sala', (int)$DatosCirugia->id_sala)
            ->first();

        $SelectCirugias = DB::table('estetico.tipo_cirugia')
            ->select('id_tipo_cirugia', 'nombre')
            ->get();

        $SelectEstatusCirugia = DB::table('estetico.Estatus_cirugia')
            ->select('id_estatus_cirugia', 'nombre')
            ->get();

        $insumos = DB::table('inventario.insumos')
            ->select('id_insumos', 'imagen', 'nombre', 'cantidad')
            ->where('id_estatus_insumos', 1)
            ->get();

        $equiposMedicos = DB::table('inventario.equipo_medico')
            ->select('id_equipo_medico', 'imagen', 'nombre', 'cantidad')
            ->where('id_estado_equipo', 1)
            ->get();

        $EquipoUsado = DB::table('estetico.equipo_cirugia as EC')
            ->select('EC.id_equipo_medico', 'EM.nombre', 'EC.cantidad')
            ->join('inventario.equipo_medico as EM', 'EM.id_equipo_medico', '=', 'EC.id_equipo_medico')
            ->where('EC.id_cirugia', (int)$DatosCirugia->id_cirugia)
            ->get();

        $InsumoUsado = DB::table('estetico.insumos_cirugia as IC')
            ->select('IC.id_insumos_cirugia', 'I.nombre', 'IC.cantidad')
            ->join('inventario.insumos as I', 'IC.id_insumos', '=', 'I.id_insumos')
            ->where('IC.id_cirugia', (int)$DatosCirugia->id_cirugia)
            ->get();


        // dump($DatosCirugia);
        // dump($SelectSalas);
        session(['activeTab' => 'Cirugias']);

        return view('Cirugia.cirugiaVista', compact('SelectConsultas', 'SelectPersonal', 'SelectSalas', 'SelectCirugias', 'SelectEstatusCirugia', 'DatosCirugia', 'insumos', 'equiposMedicos', 'EquipoUsado', 'InsumoUsado'));

    }

    /**
     * Remove the specified resource from storage.
     */

    public function cancelarForm(string $id)
    {
        $cirugia = DB::table('estetico.Cirugia AS C')
            ->select(
                'c.id_cirugia',
                'c.fecha_cirugia',
                's.nombre as nombresala',
                'tc.nombre as nombreCirugia',
                DB::raw("CONCAT(p.primer_nombre,' ',p.primer_apellido,' ',p.segundo_nombre) as nombrePaciente"),
                'ec.nombre as estatusCirugia', 'C.id_estatus_cirugia',
                DB::raw("CONCAT(pp.primer_nombre,' ',pp.primer_apellido,' ',pp.segundo_apellido) as nombrePersonalAcargo"),
                'c.id_consulta'
            )
            ->join('estetico.Estatus_cirugia AS EC', 'EC.id_estatus_cirugia', '=', 'C.id_estatus_cirugia')
            ->join('locacion.sala AS S', 'S.id_sala', '=', 'C.id_sala')
            ->join('estetico.tipo_cirugia as TC', 'TC.id_tipo_cirugia', '=', 'C.id_tipo_cirugia')
            ->join('usuario.paciente as P', 'p.id_paciente', '=', 'C.id_paciente')
            ->join('personal.personal as PP', 'pp.id_personal', '=', 'C.id_personal')
            ->where('id_cirugia', $id)
            ->first();

        //dump($cirugia);
        session(['activeTab' => 'Cirugias']);
        return view('cirugia.cirugiaCancelar', compact('cirugia'));
    }

    public function cancelar(string $id)
    {
        try {
            DB::table('estetico.Cirugia')
                ->where('id_cirugia', $id)
                ->update([
                    'id_estatus_cirugia' => 7,
                ]);

            $equipoUsados = DB::table('estetico.equipo_cirugia')
                ->select('id_equipo_medico', 'cantidad')
                ->where('id_cirugia', $id)
                ->get();

            $insumosUsados = DB::table('estetico.insumos_cirugia')
                ->select('id_insumos', 'cantidad')
                ->where('id_cirugia', $id)
                ->get();

            if (!$equipoUsados->isEmpty()) {
                foreach ($equipoUsados as $idElemento) {
                    DB::table('inventario.equipo_medico')
                        ->where('id_equipo_medico', $idElemento->id_equipo_medico)
                        ->update(['cantidad' => DB::raw("cantidad + $idElemento->cantidad")]);
                }

                DB::table('estetico.equipo_cirugia')->where('id_cirugia', $id)->delete();
            }

            if (!$insumosUsados->isEmpty()) {
                foreach ($insumosUsados as $idElemento) {
                    DB::table('inventario.insumos')
                        ->where('id_insumos', $idElemento->id_insumos)
                        ->update(['cantidad' => DB::raw("cantidad + $idElemento->cantidad")]);
                }
                DB::table('estetico.insumos_cirugia')->where('id_cirugia', $id)->delete();

            }

            $salaAcambiar = DB::table('estetico.Cirugia')
                ->select('id_sala')
                ->where('id_cirugia', $id)
                ->first();

            DB::table('locacion.sala')
                ->where('id_sala', $salaAcambiar->id_sala)
                ->update(['id_estado_sala' => 1]);

            session(['activeTab' => 'Cirugias']);
            return redirect()->route('tablaCirugia')->with('success', 'Cirugía cancelada exitosamente');
        } catch (\Exception $e) {
            //dump($e);
            return redirect()->route('tablaCirugia')->with('error', 'Error al cancelar la cirugía');
        }
    }
}
