<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Illuminate\Contracts\Auth\StatefulGuard;
use Laravel\Fortify\Contracts\LogoutResponse;
use Illuminate\Support\Facades\Log;


class RestauracionController extends Controller
{
    /**
     * The guard implementation.
     *
     * @var \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected $guard;

    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        try{
            $result = DB::select("exec select_diff");
        }
        catch (\Exception $e) {
            session(['activeTab' => 'Restauracion']);
            return view('restauracion.mantenimiento-restauracion');
        }

        session(['activeTab' => 'Restauracion']);
        return view('restauracion.restauracion', compact('result'));

    }

    public function guardar_datos()
    {
        $result = DB::select("exec backup_diferrencial");

        session(['activeTab' => 'Restauracion']);
    }

     /**
     * Remove the specified resource from storage.
     * \Laravel\Fortify\Contracts\LogoutResponse LogoutResponse
     */
    public function backup_diferencial()
    {
        DB::setDefaultConnection('sqlsrv2');

        $sql = "EXEC backup_diff";

        $query = DB::connection('sqlsrv2')->getPdo()->prepare($sql);

        // // Obtenemos el query completo con los parámetros
        // $fullQuery = vsprintf(str_replace(['%', '?'], ['%%', "'%s'"], $sql), $bindings);

        try {

            $query->execute();

            sleep(15);

            // DB::unprepared($fullQuery);


        } catch (\Exception $e)
        {
            log::error('error en el sistema');

        } finally {
            DB::setDefaultConnection('sqlsrv');

            session(['activeTab' => 'Restauracion']);
            return redirect()->route('restauracion.index')->with('succesfull', 'esta perron uwu');
        }

    }

     /**
     * Remove the specified resource from storage.
     * \Laravel\Fortify\Contracts\LogoutResponse
     */
    public function Restorage_principal()
    {

        DB::disconnect('sqlsrv');
        DB::setDefaultConnection('sqlsrv2');
        try{

            $sql = "exec Restorage_principal";
            $query = DB::connection('sqlsrv2')->getPdo()->prepare($sql);
            $query->execute();

            sleep(60);
            Log::info('Job ejecutado correctamente.');

        } catch (\Exception $e)
        {
            DB::connection('sqlsrv2')->rollback();
            Log::error('error en el sistema'. $e);
            DB::setDefaultConnection('sqlsrv');
        }
        finally {

            DB::setDefaultConnection('sqlsrv');
            session(['activeTab' => 'Restauracion']);
            return redirect()->route('restauracion.index')->with('succesfull', 'esta perron uwu');
        }
    }

    public function Restorage_differencial($file)
    {
        DB::disconnect('sqlsrv');
        DB::setDefaultConnection('sqlsrv2');

        $sql = "exec Restorage_diferencial @file = ?";
        $bindings = [$file];
        try{

            $query = DB::connection('sqlsrv2')->getPdo()->prepare($sql);
            $query->execute($bindings);

            sleep(60);
            Log::info('Job ejecutado correctamente.');

        } catch (\Exception $e)
        {
            DB::connection('sqlsrv2')->rollback();
            Log::error('error en el sistema'. $e);
            DB::setDefaultConnection('sqlsrv');
        }
        finally {

            DB::setDefaultConnection('sqlsrv');
            session(['activeTab' => 'Restauracion']);
            return redirect()->route('restauracion.index')->with('succesfull', 'esta perron uwu');
        }

    }

    // public function Restorage_principal(Request $request): LogoutResponse
    // {
    //     try {
    //         Auth::guard('web')->logout();
    //         $request->session()->invalidate();
    //         $request->session()->regenerateToken();



    //     } catch (\Exception $e)
    //     {
    //         log::error('error en el sistema');

    //     } finally {
    //         try {
    //             DB::setDefaultConnection('sqlsrv2');
    //             DB::disconnect('sqlsrv');
    //             $sql = "exec Restorage_principal";
    //             $query = DB::connection('sqlsrv2')->getPdo()->prepare($sql);
    //             dump($query);
    //             $query->execute();
    //             $query->execute();
    //             dump($query);

    //         } catch (\Exception $e)
    //         {
    //             log::error('error en el sistema');

    //         } finally {

    //             DB::setDefaultConnection('sqlsrv');
    //             return app(LogoutResponse::class);
    //             // return app(LogoutResponse::class);
    //         }
    //     }


    // }



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


}

// @return \Laravel\Fortify\Contracts\LogoutResponse
// */
// public function destroy(Request $request): LogoutResponse
// {
//    $this->guard->logout();

//    $request->session()->invalidate();

//    $request->session()->regenerateToken();

//    return app(LogoutResponse::class);
// }
// }
