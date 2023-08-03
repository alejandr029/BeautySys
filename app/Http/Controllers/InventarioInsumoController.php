<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class InventarioInsumoController extends Controller
{
    public function index()
    {
        $Insumos = DB::table('inventario.insumos as I')
        ->select('I.id_insumos', 'I.imagen', 'I.nombre', 'I.fecha_adquisicion', 'I.fecha_vencimiento', 'I.cantidad', 'EI.nombre as nombre_estatus')
        ->join('inventario.estatus_insumos as EI', 'EI.id_estatus_insumos', '=', 'I.id_estatus_insumos')
        ->join('inventario.proveedor as P', 'P.id_proveedor', '=', 'I.id_proveedor')
        ->orderByDesc('I.id_insumos')
        ->Paginate(5); 

        $equipoMedico = DB::table('inventario.equipo_medico as EM')
        ->select('EM.id_equipo_medico', 'EM.imagen', 'EM.nombre', 'EE.nombre as estatus', 'EM.cantidad')
        ->join('inventario.estatus_equipo as EE', 'EE.id_estatus_equipo', '=', 'EM.id_estado_equipo')
        ->join('inventario.proveedor as P', 'P.id_proveedor', '=', 'EM.id_proveedor')
        ->orderByDesc('EM.id_equipo_medico')
        ->Paginate(5); 

         session(['activeTab' => 'Inventario']);
    
        return view('Inventario.inventario', compact('Insumos', 'equipoMedico'));

    }

    public function crearInsumo()
    {
        $proveedores = DB::table('inventario.proveedor')
            ->select('id_proveedor', 'nombre_empresarial')
            ->orderBy('id_proveedor')
            ->get();

        $estatus = DB::table('inventario.estatus_insumos')
            ->select('id_estatus_insumos', 'nombre')
            ->orderBy('id_estatus_insumos')
            ->get();

             session(['activeTab' => 'Inventario']);

        return view('Inventario.crearInsumo', [
            'proveedores' => $proveedores,
            'estatus' => $estatus,
        ]);
    }


    public function store(Request $request)
    {
        //dump($request->all());
        DB::table('inventario.insumos')->insert([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'fecha_adquisicion' => $request->fechaAdquisicion,
            'fecha_vencimiento' => $request->fechaVencimiento,
            'imagen' => $request->imagen_url,
            'id_estatus_insumos' => $request->id_estatus_insumos,
            'id_proveedor' => $request->id_proveedor,
            'cantidad' => $request->cantidad,
        ]);

         session(['activeTab' => 'Inventario']);
    
        return redirect()->route('Inventario.index')->with('success', 'Insumo creado correctamente.');;
    }


    public function vistaInsumo($id)
    {
        $insumo = DB::table('inventario.insumos as I')
            ->join('inventario.estatus_insumos as EI', 'EI.id_estatus_insumos', '=', 'I.id_estatus_insumos')
            ->join('inventario.proveedor as P', 'P.id_proveedor', '=', 'I.id_proveedor')
            ->where('I.id_insumos', $id)
            ->select('I.id_insumos','I.nombre', 'I.fecha_adquisicion', 'I.fecha_vencimiento', 'I.cantidad', 'EI.id_estatus_insumos', 'P.id_proveedor', 'I.imagen', 'I.descripcion')
            ->first();

            $insumo->fecha_adquisicion = Carbon::createFromFormat('Y-m-d H:i:s.u', $insumo->fecha_adquisicion)->format('Y-m-d');
            $insumo->fecha_vencimiento = Carbon::createFromFormat('Y-m-d H:i:s.u', $insumo->fecha_vencimiento)->format('Y-m-d');
    
        $proveedores = DB::table('inventario.proveedor')
            ->select('id_proveedor', 'nombre_empresarial')
            ->orderBy('id_proveedor')
            ->get();
    
        $estatus = DB::table('inventario.estatus_insumos')
            ->select('id_estatus_insumos', 'nombre')
            ->orderBy('id_estatus_insumos')
            ->get();

            // dump($id);
            // dump($insumo);
            // dump($proveedores);
            // dump($estatus);

             session(['activeTab' => 'Inventario']);
    
        return view('Inventario.vistaInsumo', compact('insumo', 'proveedores', 'estatus'));
    }

    public function show($id)
    {
        $insumo = DB::table('inventario.insumos as I')
            ->join('inventario.estatus_insumos as EI', 'EI.id_estatus_insumos', '=', 'I.id_estatus_insumos')
            ->join('inventario.proveedor as P', 'P.id_proveedor', '=', 'I.id_proveedor')
            ->where('I.id_insumos', $id)
            ->select('I.id_insumos','I.nombre', 'I.fecha_adquisicion', 'I.fecha_vencimiento', 'I.cantidad', 'EI.id_estatus_insumos', 'P.id_proveedor', 'I.imagen', 'I.descripcion')
            ->first();

            $insumo->fecha_adquisicion = Carbon::createFromFormat('Y-m-d H:i:s.u', $insumo->fecha_adquisicion)->format('Y-m-d');
            $insumo->fecha_vencimiento = Carbon::createFromFormat('Y-m-d H:i:s.u', $insumo->fecha_vencimiento)->format('Y-m-d');
    
        $proveedores = DB::table('inventario.proveedor')
            ->select('id_proveedor', 'nombre_empresarial')
            ->orderBy('id_proveedor')
            ->get();
    
        $estatus = DB::table('inventario.estatus_insumos')
            ->select('id_estatus_insumos', 'nombre')
            ->orderBy('id_estatus_insumos')
            ->get();

            //dump($insumo);

             session(['activeTab' => 'Inventario']);
    
        return view('Inventario.actualizarInsumo', compact('insumo', 'proveedores', 'estatus'));
    }

    public function update(Request $request, string $id)
    {

        //dump($request->all());

        DB::table('inventario.insumos')
        ->where('id_insumos', $id)
        ->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'fecha_adquisicion' => $request->fechaAdquisicion,
            'fecha_vencimiento' => $request->fechaVencimiento,
            'imagen' => $request->imagen_url,
            'id_estatus_insumos' => $request->id_estatus_insumos,
            'id_proveedor' => $request->id_proveedor,
            'cantidad' => $request->cantidad,
        ]);

         session(['activeTab' => 'Inventario']);

        return redirect()->route('Inventario.index')->with('success', 'Insumo actualizado correctamente.');
    }


    public function destroy(string $id)
    {
        DB::table('inventario.insumos')->where('id_insumos', $id)->delete();

        session(['activeTab' => 'Inventario']);

        return redirect()->route('Inventario.index')->with('success', 'Insumo eliminado correctamente.');

    }
}
