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
        session(['activeTab' => 'Proveedor']);


        return view('Proveedor.proveedorTabla', compact('Proveedor'));

    }

    public function vistaProveedor($id){
        $Proveedor = DB::table('inventario.proveedor as P')
        ->where('P.id_proveedor', $id)
        ->select('P.id_proveedor','P.logo','P.nombre_empresarial','P.telefono', DB::raw('P.[nombre de contacto] as contacto'),'P.direccion')
        ->first();

        session(['activeTab' => 'Proveedor']);


        //dump($Proveedor);

        return view('Proveedor.proveedorVista', compact('Proveedor'));
    }


    public function store(Request $request)
    {
        DB::table('inventario.proveedor')->insert([
            'nombre_empresarial' => $request->nombreProveedor,
            'direccion' => $request->direccion,
            'telefono' => $request->numeroTelefono,
            'nombre de contacto' => $request->nombreContacto,
            'logo' => $request->imagen_url,
        ]);

        session(['activeTab' => 'Proveedor']);

    
        return redirect()->route('tablaProvedor')->with('success', 'Proveedor creado correctamente.');;
    }


    public function show(string $id)
    {
        $Proveedor = DB::table('inventario.proveedor as P')
        ->where('P.id_proveedor', $id)
        ->select('P.id_proveedor','P.logo','P.nombre_empresarial','P.telefono', DB::raw('P.[nombre de contacto] as contacto'),'P.direccion')
        ->first();

        session(['activeTab' => 'Proveedor']);

        
        return view('Proveedor.proveedorActualizar', compact('Proveedor'));
    }


    public function update(Request $request, string $id)
    {
        //dump($request->all());
        DB::table('inventario.proveedor')
        ->where('id_proveedor', $id)
        ->update([
            'nombre_empresarial' => $request->nombreProveedor,
            'direccion' => $request->direccion,
            'telefono' => $request->numeroTelefono,
            'nombre de contacto' => $request->nombreContacto,
            'logo' => $request->imagen_url,
        ]);

        session(['activeTab' => 'Proveedor']);


        return redirect()->route('tablaProvedor')->with('success', 'Proveedor actualizado correctamente.');
    }


    public function destroy(string $id)
    {
        DB::table('inventario.proveedor')->where('id_proveedor', $id)->delete();

        session(['activeTab' => 'Proveedor']);

        return redirect()->route('tablaProvedor')->with('success', 'Proveedor eliminado correctamente.');
    }
}
