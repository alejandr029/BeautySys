<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\CitasUsuario;
use App\Models\Personal;
use Illuminate\Support\Facades\DB;


class CitasUsuarios extends Controller
{
    public function index() {
        //consulta de citas por usuario
        $citas = DB::table('estetico.cita')
        ->select('id_cita','hora_cita','fecha_cita','id_personal','id_estado_cita','id_sala')
        //->where('id_paciente' = $id_cliente )
        ->get();
        //

        session(['activeTab' => 'CitasUsuarios']);
        return view('CitasUsuarios.CitasUsuarios', compact('citas'));
    }

    public function datasSets () {

    }
}
