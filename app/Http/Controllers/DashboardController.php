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
        $Citas = DB::table('estetico.cita as C')
        ->select('P.primer_apellido','S.nombre','C.fecha_cita')
        ->join('usuario.paciente as P','P.id_paciente', '=', 'C.id_paciente')
        ->join('locacion.sala as S','S.id_sala', '=', 'C.id_sala')
        ->orderByDesc('C.id_cita')
        ->Paginate(5);
        
        
        session(['activeTab' => 'Dashboard']);

        return view('dashboard',compact('Citas'));
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
