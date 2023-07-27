<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class InventarioController extends Controller
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
        ->orderBy('I.id_insumos')
        ->Paginate(5); 
    
        return view('Inventario.inventario', ['InventarioInsumos' => $Insumos]);

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
