<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProveedorController extends Controller
{

    public function index()
    {
        $Proveedor = DB::table('inventario.proveedor as P')
        ->select('P.id_proveedor','P.logo','P.nombre_empresarial','P.telefono', DB::raw('P.[nombre de contacto] as contacto'),'P.direccion', 'E.estatus')
            ->leftJoin('inventario.estatus_proveedor as E', 'P.id_estatus_proveedor', '=', 'E.id_estatus_proveedor')
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
        // Valida los datos de entrada
        $request->validate([
            'nombreProveedor' => 'required|string|max:20',
            'direccion' => 'required|string|max:50',
            'numeroTelefono' => 'required|string|min:10|max:50',
            'nombreContacto' => 'required|string|max:50',
            'imagen_url' => 'nullable|string|max:500'
        ]);

        try {
            // Inicia la consulta de insercción a la BD
            DB::table('inventario.proveedor')->insert([
                'nombre_empresarial' => $request->nombreProveedor,
                'direccion' => $request->direccion,
                'telefono' => $request->numeroTelefono,
                'nombre de contacto' => $request->nombreContacto,
                'logo' => $request->imagen_url,
            ]);

            session(['activeTab' => 'Proveedor']);
            // Guarda el mensaje en memoria para usarlo despues de redireccionamiento
            session()->flash('showModal', true);
            return redirect()->route('tablaProvedor')->with('success', 'Proveedor creado exitosamente.');

        } catch (\Exception $e) {
            // Guarda el mensaje de error en memoria para usarlo despues de redireccionamiento
            session()->flash('showModal', true);
            return redirect()->route('vistaCrearProveedor')->with('error', 'Error al crear el proveedor.');
        }
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
        // Valida los datos de entrada
        $request->validate([
            'nombreProveedor' => 'required|string|max:20',
            'direccion' => 'required|string|max:50',
            'numeroTelefono' => 'required|string|min:10|max:50',
            'nombreContacto' => 'required|string|max:50',
            'imagen_url' => 'nullable|string|max:500'
        ]);
        try {
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

            session()->flash('showModal', true);

            return redirect()->route('tablaProvedor')->with('success', 'Proveedor actualizado correctamente.');
        } catch (Exception $e) {
            session()->flash('showModal', true);
            return redirect()->route('actualizarProveedor')->with('error', 'Error al crear el proveedor.');
        }

    }

    public function cambiarEstado($id)
    {
        $proveedor = DB::table('inventario.proveedor')->where('id_proveedor', $id)->first();

        session(['activeTab' => 'Proveedor']);

        //dump($proveedor, $insumos);
        return view('Proveedor.proveedorEstado', compact('proveedor'));
    }

    public function deshabilitarProveedor(string $id)
    {
        try{

            $insumos = DB::table('inventario.insumos')->where('id_proveedor', $id)->first();
            $equipo_medico = DB::table('inventario.equipo_medico')->where('id_proveedor', $id)->first();

            //dump($insumosCount);

            if ($insumos !== null) {
                // Cambia el id_estado_insumos a "1" para los insumos relacionados al proveedor
                DB::table('inventario.insumos')->where('id_proveedor', $id)->update(['id_estatus_insumos' => 4]);
            }

            if ($equipo_medico != null) {
                DB::table('inventario.equipo_medico')->where('id_proveedor', $id)->update(['id_estado_equipo' => 4]);
            }

            DB::table('inventario.proveedor')->where('id_proveedor', $id)->update(['id_estatus_proveedor' => 2]);

            session(['activeTab' => 'Proveedor']);

            return redirect()->route('tablaProvedor')->with('success', 'Proveedor deshabilitado correctamente.');
        } catch (Exception $e) {
            //return dump($e);
            session()->flash('showModal', true);
            return redirect()->route('tablaProvedor')->with('error', 'Error al deshabilitar el proveedor.');
        }
    }

    public function habilitarProveedor(string $id)
    {
        try{

            $insumos = DB::table('inventario.insumos')->where('id_proveedor', $id)->first();
            $equipo_medico = DB::table('inventario.equipo_medico')->where('id_proveedor', $id)->first();

            //dump($insumosCount);

            if ($insumos !== null) {
                // Cambia el id_estado_insumos a "1" para los insumos relacionados al proveedor
                DB::table('inventario.insumos')->where('id_proveedor', $id)->update(['id_estatus_insumos' => 1]);
            }

            if ($equipo_medico != null) {
                DB::table('inventario.equipo_medico')->where('id_proveedor', $id)->update(['id_estado_equipo' => 1]);
            }

            DB::table('inventario.proveedor')->where('id_proveedor', $id)->update(['id_estatus_proveedor' => 1]);

            session(['activeTab' => 'Proveedor']);

            return redirect()->route('tablaProvedor')->with('success', 'Proveedor habilitado correctamente.');
        } catch (Exception $e) {
            //return dump($e);
            session()->flash('showModal', true);
            return redirect()->route('tablaProvedor')->with('error', 'Error al habilitar el proveedor.');
        }
    }
}
