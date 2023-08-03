<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class InventarioEquipoMedicoController extends Controller
{

    public function index()
    {

        
    }

    public function vistaEquipo($id)
    {
        $equipoMedico = DB::table('inventario.equipo_medico as EM')
        ->join('inventario.estatus_equipo as EE', 'EE.id_estatus_equipo', '=', 'EM.id_estado_equipo')
        ->join('inventario.proveedor as P', 'P.id_proveedor', '=', 'EM.id_proveedor')
        ->where('EM.id_equipo_medico', $id) 
        ->select('EM.id_equipo_medico', 'EM.imagen', 'EM.nombre', 'EM.modelo', 'EM.marca', 'EE.id_estatus_equipo', 'EM.cantidad', 'P.id_proveedor', 'EM.descripcion')
        ->first();

    
    
        $proveedores = DB::table('inventario.proveedor')
            ->select('id_proveedor', 'nombre_empresarial')
            ->orderBy('id_proveedor')
            ->get();
    
        $estatus = DB::table('inventario.estatus_equipo')
            ->select('id_estatus_equipo', 'nombre')
            ->orderBy('id_estatus_equipo')
            ->get();

            //dump($insumo);

            session(['activeTab' => 'Inventario']);

        return view('Inventario.EquipoMedico.vistaEquipoMedico', compact('equipoMedico', 'proveedores', 'estatus'));
    }


    public function store(Request $request)
    {
        DB::table('inventario.equipo_medico')->insert([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'modelo' => $request->modelo,
            'marca' => $request->marca,
            'cantidad' => $request->cantidad,
            'imagen' => $request->imagen_url,
            'id_estado_equipo' => $request->id_estatus_equipo,
            'id_proveedor' => $request->id_proveedor,
        ]);
    
        session(['activeTab' => 'Inventario']);
        
        return redirect()->route('Inventario.index')->with('success', 'Equipo medico creado correctamente.');;
    }


    public function show(string $id)
    {
        $equipoMedico = DB::table('inventario.equipo_medico as EM')
        ->join('inventario.estatus_equipo as EE', 'EE.id_estatus_equipo', '=', 'EM.id_estado_equipo')
        ->join('inventario.proveedor as P', 'P.id_proveedor', '=', 'EM.id_proveedor')
        ->where('EM.id_equipo_medico', $id) 
        ->select('EM.id_equipo_medico', 'EM.imagen', 'EM.nombre', 'EM.modelo', 'EM.marca', 'EE.id_estatus_equipo', 'EM.cantidad', 'P.id_proveedor', 'EM.descripcion')
        ->first();

      

        $proveedores = DB::table('inventario.proveedor')
            ->select('id_proveedor', 'nombre_empresarial')
            ->orderBy('id_proveedor')
            ->get();
    
        $estatus = DB::table('inventario.estatus_equipo')
            ->select('id_estatus_equipo', 'nombre')
            ->orderBy('id_estatus_equipo')
            ->get();


        //dump($insumo);

        session(['activeTab' => 'Inventario']);

        return view('Inventario.EquipoMedico.actualizarEquipoMedico', compact('equipoMedico', 'proveedores', 'estatus'));
    }


    public function update(Request $request, string $id)
    {

        //dump($request->all());

        DB::table('inventario.equipo_medico')
        ->where('id_equipo_medico', $id) 
        ->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'modelo' => $request->modelo,
            'marca' => $request->marca,
            'cantidad' => $request->cantidad,
            'imagen' => $request->imagen_url,
            'id_estado_equipo' => $request->id_estatus_equipo,
            'id_proveedor' => $request->id_proveedor,
        ]);

        session(['activeTab' => 'Inventario']);

        return redirect()->route('Inventario.index')->with('success', 'Equipo actualizado correctamente.');
    }

    public function crearEquipoMedico()
    {

        $proveedores = DB::table('inventario.proveedor')
            ->select('id_proveedor', 'nombre_empresarial')
            ->orderBy('id_proveedor')
            ->get();
    
        $estatus = DB::table('inventario.estatus_equipo')
            ->select('id_estatus_equipo', 'nombre')
            ->orderBy('id_estatus_equipo')
            ->get();

            session(['activeTab' => 'Inventario']);

        return view('Inventario.EquipoMedico.crearEquipoMedico', [
            'proveedores' => $proveedores,
            'estatus' => $estatus,
        ]);
    }


    public function destroy(string $id)
    {
        DB::table('inventario.equipo_medico')->where('id_equipo_medico', $id)->delete();
        session(['activeTab' => 'Inventario']);
        return redirect()->route('Inventario.index')->with('success', 'Equipo eliminado correctamente.');
    }
}
