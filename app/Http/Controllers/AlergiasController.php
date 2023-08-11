<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlergiasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $Alergias = DB::table('usuario.paciente as UP')
        ->select('UTA.id_tipo_alergia', 'UTA.descripcion', 'UTA.nombre')
        ->Join('usuario.alergia as UA', 'UP.id_paciente', '=', 'UA.id_paciente')
        ->Join('usuario.tipo_alergia as UTA', 'UTA.id_tipo_alergia', '=', 'UA.id_tipo_alergia')
        ->where('UP.id_cuenta', $id)
        ->get();

        $AlergiasModal = DB::table('usuario.tipo_alergia')
        ->select('id_tipo_alergia','nombre','descripcion')
        ->get();

        session(['activeTab' => 'Alergias']);

        return view('Alergia.alergiaTable', compact('Alergias','AlergiasModal'));

    }

    public function añadirAlergia(Request $request,$id){

        // dump($request->all());
        // dump($id);

        $datos = $request->input('elementos');
        // $idAlergia = $request->input('id_tipo_alergia');

        $idPaciente = DB::table('usuario.paciente')
        ->select('id_paciente')
        ->where('id_cuenta',$id)
        ->first();


        foreach ($datos as $idElemento => $elemento) {
            $idAlergia = $elemento['id'];
            $seleccionado = $elemento['seleccionado'];
            // dump($idAlergia);
            // dump($seleccionado);
            $Alergias = DB::table('usuario.paciente as UP')
            ->select('UA.id_alergia', 'UA.id_paciente', 'UA.id_tipo_alergia')
            ->Join('usuario.alergia as UA', 'UP.id_paciente', '=', 'UA.id_paciente')
            ->where('UP.id_cuenta', $id)
            ->where('UA.id_tipo_alergia', $idAlergia)
            ->get();

            // dump($Alergias);

            if($Alergias->isEmpty()){
                // dump($idAlergia);
                // dump($seleccionado);
                if($seleccionado == "1"){
                    DB::table('usuario.alergia')->insert([
                        'id_paciente' => $idPaciente->id_paciente, 
                        'id_tipo_alergia' => $idAlergia,
                    ]);
                }
            }else{
                if($seleccionado == "0" && !$Alergias->isEmpty()){
                    // dump($idAlergia);
                    // dump($seleccionado);
                    DB::table('usuario.alergia')->where('id_paciente', $idPaciente->id_paciente)->where('id_tipo_alergia', $idAlergia)->delete();
                }
            }
            
        }
        session(['activeTab' => 'Alergias']);

        return redirect()->route('alergiasTabla', ['id' => $id]);
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
