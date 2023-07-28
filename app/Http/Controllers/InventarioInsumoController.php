<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class InventarioInsumoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Insumos = DB::table('insumos as I')
        ->select('I.id_insumos', 'I.imagen', 'I.nombre', 'I.descripcion', 'I.fecha_adquisicion', 'I.fecha_vencimiento', 'I.cantidad', 'EI.nombre as nombre_estatus', 'P.nombre_empresarial')
        ->join('estatus_insumos as EI', 'EI.id_estatus_insumos', '=', 'I.id_estatus_insumos')
        ->join('proveedor as P', 'P.id_proveedor', '=', 'I.id_proveedor')
        ->orderByDesc('I.id_insumos')
        ->Paginate(5); 
    
        return view('Inventario.inventario', ['InventarioInsumos' => $Insumos]);

    }

    public function crearInsumo()
    {
        $proveedores = DB::table('proveedor')
            ->select('id_proveedor', 'nombre_empresarial')
            ->orderBy('id_proveedor')
            ->get();

        $estatus = DB::table('estatus_insumos')
            ->select('id_estatus_insumos', 'nombre')
            ->orderBy('id_estatus_insumos')
            ->get();

        return view('Inventario.crearInsumo', [
            'proveedores' => $proveedores,
            'estatus' => $estatus,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dump($request->all());
        DB::table('insumos')->insert([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'fecha_adquisicion' => $request->fechaAdquisicion,
            'fecha_vencimiento' => $request->fechaVencimiento,
            'imagen' => $request->imagen_url,
            'id_estatus_insumos' => $request->id_estatus_insumos,
            'id_proveedor' => $request->id_proveedor,
            'cantidad' => $request->cantidad,
        ]);
    
        return redirect()->route('Inventario.index');
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
