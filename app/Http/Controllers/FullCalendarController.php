<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;



class FullCalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        session(['activeTab' => 'Calendario']);

        return view('Calendario.calendario');
    }

    public function getEvents($Id)
    {

        //$userId = Auth::id();

        $userId = DB::table('usuario.paciente')
            ->select('id_paciente')
            ->where('id_cuenta', $Id)
            ->first();


        //dd($userId);


        $datosCitas = DB::table('estetico.cita as ec')
            ->select('ec.id_cita as id', 'ec.fecha_cita as fecha', 'ec.hora_cita as hora', 'estado.nombre as estado', 'tc.nombre as descripcion')
            ->join('estetico.tipo_cita as tc', 'tc.id_tipo_cita', '=', 'ec.id_tipo_cita')
            ->join('estetico.estado_cita as estado', 'estado.id_estado_cita', '=', 'ec.id_estado_cita')
            ->where('ec.id_paciente', $userId->id_paciente)
            ->whereDate('ec.fecha_cita', '>=', Carbon::today())
            ->get();


        $datosConsulta = DB::table('estetico.consulta as ec')
            ->select(
                'ec.id_consulta as id',
                DB::raw('CAST(ec.fecha_visita AS DATE) AS fecha'),
                DB::raw('CAST(ec.fecha_visita AS TIME) AS hora'),
                'datos_consulta as descripcion',
                'estado.nombre as estado'
            )
            ->join('estetico.status_consulta as estado', 'ec.id_status_consulta', '=', 'estado.id_status_consulta')
            ->where('ec.id_paciente', $userId->id_paciente)
            ->whereDate('ec.fecha_visita', '>=', Carbon::today())
            ->get();

        $datosCirugia = DB::table('estetico.Cirugia as ec')
            ->select(
                'ec.id_cirugia as id',
                DB::raw('CAST(ec.fecha_cirugia AS DATE) AS fecha'),
                DB::raw('CAST(ec.fecha_cirugia AS TIME) AS hora'),
                'tc.nombre as descripcion',
                'estado.nombre as estado'
            )
            ->join('estetico.tipo_cirugia as tc', 'tc.id_tipo_cirugia', '=', 'ec.id_tipo_cirugia')
            ->join('estetico.Estatus_cirugia as estado', 'estado.id_estatus_cirugia', '=', 'ec.id_estatus_cirugia')
            ->where('ec.id_paciente', $userId->id_paciente)
            ->whereDate('ec.fecha_cirugia', '>=', Carbon::today())
            ->get();

        $eventsFormatted = [];

        // Datos de citas
        foreach ($datosCitas as $event) {
            $formattedDate = Carbon::parse($event->fecha)->format('Y-m-d');
            $eventsFormatted[] = [
                'id' => 'cita_' . $event->id, // Agregar prefijo 'cita_' al ID de la cita
                'title' => 'Cita', // Título para citas
                'start_date' => $formattedDate,
                'time' => $event->hora,
                'description' => $event->descripcion,
                'estatus' => $event->estado,
            ];
        }

        // Datos de consulta
        foreach ($datosConsulta as $event) {
            $formattedDate = Carbon::parse($event->fecha)->format('Y-m-d');
            $eventsFormatted[] = [
                'id' => 'consulta_' . $event->id, // Agregar prefijo 'consulta_' al ID de la consulta
                'title' => 'Consulta', // Título para consultas
                'start_date' => $formattedDate,
                'time' => $event->hora,
                'description' => $event->descripcion,
                'estatus' => $event->estado,
            ];
        }

        // Datos de cirugía
        foreach ($datosCirugia as $event) {
            $formattedDate = Carbon::parse($event->fecha)->format('Y-m-d');
            $eventsFormatted[] = [
                'id' => 'cirugia_' . $event->id, // Agregar prefijo 'cirugia_' al ID de la cirugía
                'title' => 'Cirugía', // Título para cirugías
                'start_date' => $formattedDate,
                'time' => $event->hora,
                'description' => $event->descripcion,
                'estatus' => $event->estado,
            ];
        }

        // Retornar los eventos como respuesta JSON
        return response()->json($eventsFormatted);
    }


}