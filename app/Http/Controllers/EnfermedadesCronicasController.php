<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EnfermedadesCronicasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $EnfermedadesCronicas = DB::table('usuario.paciente as UP')
        ->select('TEC.id_tipo_enfermedad_cronica','TEC.nombre','TEC.descripcion')
        ->Join('usuario.enfermedad_cronica as EC', 'UP.id_paciente', '=', 'EC.id_paciente')
        ->Join('usuario.tipo_enfermedad_cronica as TEC', 'EC.id_tipo_enfermedad_cronica', '=', 'TEC.id_tipo_enfermedad_cronica')
        ->where('UP.id_cuenta', $id)
        ->orderByDesc('TEC.id_tipo_enfermedad_cronica')
        ->get();

        $EnfermedadesCronicasModal = DB::table('usuario.tipo_enfermedad_cronica')
        ->select('id_tipo_enfermedad_cronica','nombre','descripcion')
        ->get();

        session(['activeTab' => 'Enfermedad Cronicas']);

        return view('EnfermedadesCronicas.enfermedadesCronicasTable', compact('EnfermedadesCronicas','EnfermedadesCronicasModal'));
    }

    public function añadirEnfermedadCronica(Request $request,$id){

        // dump($request->all());
        // dump($id);

        $datos = $request->input('elementos');
        // $idAlergia = $request->input('id_tipo_alergia');

        $idPaciente = DB::table('usuario.paciente')
        ->select('id_paciente')
        ->where('id_cuenta',$id)
        ->first();


        foreach ($datos as $idElemento => $elemento) {
            $idEnfermedadCronica = $elemento['id'];
            $seleccionado = $elemento['seleccionado'];
            // dump($idAlergia);
            // dump($seleccionado);
            $EnfermedadCronica = DB::table('usuario.paciente as UP')
            ->select('EC.id_enfermedad_cronica','EC.id_paciente','EC.id_tipo_enfermedad_cronica')
            ->Join('usuario.enfermedad_cronica as EC', 'UP.id_paciente', '=', 'EC.id_paciente')
            ->where('UP.id_cuenta', $id)
            ->where('EC.id_tipo_enfermedad_cronica', $idEnfermedadCronica)
            ->get();

            // dump($Alergias);

            if($EnfermedadCronica->isEmpty()){
                // dump($idAlergia);
                // dump($seleccionado);
                if($seleccionado == "1"){
                    DB::table('usuario.enfermedad_cronica')->insert([
                        'id_paciente' => $idPaciente->id_paciente, 
                        'id_tipo_enfermedad_cronica' => $idEnfermedadCronica,
                    ]);
                }
            }else{
                if($seleccionado == "0" && !$EnfermedadCronica->isEmpty()){
                    // dump($idAlergia);
                    // dump($seleccionado);
                    DB::table('usuario.enfermedad_cronica')->where('id_paciente', $idPaciente->id_paciente)->where('id_tipo_enfermedad_cronica', $idEnfermedadCronica)->delete();
                }
            }
            
        }
        session(['activeTab' => 'Enfermedad Cronicas']);

        return redirect()->route('enfermedadesCronicasTabla', ['id' => $id]);
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
