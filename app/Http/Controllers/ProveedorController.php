<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProveedorController extends Controller
{

    public function index()
    {
        $Proveedor = DB::table('inventario.proveedor as P')
        ->select('P.id_proveedor','P.logo','P.nombre_empresarial','P.telefono', DB::raw('P.[nombre de contacto] as contacto'),'P.direccion')
        ->orderByDesc('P.id_proveedor')
        ->Paginate(5); 

        //dump($Proveedor);

        return view('Proveedor.proveedorTabla', compact('Proveedor'));

    }

    public function vistaProveedor($id){
        $Proveedor = DB::table('inventario.proveedor as P')
        ->where('P.id_proveedor', $id)
        ->select('P.id_proveedor','P.logo','P.nombre_empresarial','P.telefono', DB::raw('P.[nombre de contacto] as contacto'),'P.direccion')
        ->first();

        

        //dump($Proveedor);

        return view('Proveedor.proveedorVista', compact('Proveedor'));
    }


    public function store(Request $request)
    {
        //
    }


    public function show(string $id)
    {
        //
    }


    public function update(Request $request, string $id)
    {
        //
    }


    public function destroy(string $id)
    {
        //
    }
}
