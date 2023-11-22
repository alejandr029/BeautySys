<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

use App\Services\EmailService;



class ConsultasController extends Controller
{
    public function index()
    {
        $consultas = DB::table('estetico.consulta as ec')
        ->select(
            'ec.id_consulta as id',
            'ec.fecha_visita as fecha',
            DB::raw("concat(up.primer_apellido,' ', up.primer_nombre) as nombre_ps"),
            DB::raw("concat(pp.primer_apellido,' ', pp.primer_nombre) as nombre_pp"),
            'ec.aprovacion_cirugia as aprovacion',
            'esc.nombre as estatus',
            'ls.nombre as nombre_sala',
            'les.nombre as estado_sala',
            'ec.id_status_consulta'
        )
        ->join('usuario.paciente as up', 'up.id_paciente', '=', 'ec.id_paciente')
        ->join('personal.personal as pp', 'pp.id_personal', '=', 'ec.id_personal')
        ->join('estetico.status_consulta as esc', 'esc.id_status_consulta', '=', 'ec.id_status_consulta')
        ->join('locacion.sala as ls', 'ls.id_sala', '=', 'ec.id_sala')
        ->join('locacion.estado_sala as les', 'les.id_estado_sala', '=', 'ls.id_estado_sala')
        // ->where('ec.id_status_consulta','!=',3)
        // ->where('ec.id_status_consulta','!=',4)
        ->orderByDesc('ec.id_consulta ')
        ->Paginate(5);

        session(['activeTab' => 'Consultas']);
        return view('consultas.consultas',compact('consultas'));
    }

    public function crear_vista(){

        $SelectPersonal = DB::table('personal.personal as P')
        ->join('personal.departamento as D', 'P.id_departamento', '=', 'D.id_departamento')
        ->select('P.id_personal', DB::raw("CONCAT(P.primer_nombre, ' ', P.primer_apellido, ' ', P.segundo_apellido) as nombrePersonalAcargo"), 'D.nombre as nombreDepartamento')
        ->get();

        $sala = DB::table('locacion.sala as ls')
        ->select('ls.id_sala', 'ls.nombre', 'ls.capacidad','les.nombre as status')
        ->join('locacion.estado_sala as les','les.id_estado_sala', '=', 'ls.id_estado_sala')
        ->where('ls.nombre', 'like',"%Consultoria%")
        ->where('les.nombre', 'like',"%Disponible%")
        ->get();

        $status = DB::table('estetico.status_consulta')
        ->select('id_status_consulta', 'nombre')
        ->get();

        $paciente = DB::table('usuario.paciente')
        ->select('id_paciente','primer_nombre','segundo_nombre','primer_apellido','segundo_apellido')
        ->orderBy('primer_nombre')
        ->get();

        session(['activeTab' => 'Consultas']);
        return view('consultas.consultacrear',compact('SelectPersonal','sala','status','paciente'));
    }

    public function pacientesConsulta($id)
    {

        $datos_busqueda = json_decode(urldecode($id));

        $nombre = $datos_busqueda[0];
        $apellido = $datos_busqueda[1];

        $pacientes = DB::table('usuario.paciente')
        ->select('id_paciente', 'primer_nombre as paciente_nombre', 'primer_apellido as paciente_apellido')
        ->where('primer_apellido', 'like','%'.$apellido.'%')
        ->where('primer_nombre', 'like','%'.$nombre.'%')
        ->get();
        session(['activeTab' => 'Consultas']);

        return response()->json($pacientes);

    }
    public function pacienteConsulta($id)
    {

        $datlospaciente = DB::table('usuario.paciente')
        ->select('id_paciente', DB::raw("CONCAT(primer_nombre, ' ', primer_apellido, ' ', segundo_apellido) as nombrePaciente"), 'correo as correoPaciente', 'telefono as telefonoPaciente')
        ->where('id_paciente', $id)
        ->first();

        session(['activeTab' => 'Consultas']);

        return response()->json($datlospaciente);

    }

    public function crear(Request $request){
        try{
            DB::table('estetico.consulta')->insert([
                'fecha_visita' => date('Y-m-d H:i:s', strtotime($request->fecha . ' ' . $request->hora)),
                'id_paciente' => $request->id_Paciente,
                'id_personal' => $request->personal,
                'datos_consulta' => $request->datos_consultas,
                'id_status_consulta' => $request->estatus_consultas,
                'id_sala' => $request->consulta_sala,
              ]);

            if($request->estatus_consultas == 1 or 2){
                DB::table('locacion.sala')
                    ->where('nombre', $request->consulta_sala)
                    ->update([
                        'id_estado_sala' => 3
                    ]);
            }

            if($request->estatus_consultas == 3 or 4 or 5){
                DB::table('locacion.sala')
                    ->where('nombre', $request->consulta_sala)
                    ->update([
                        'id_estado_sala' => 1
                    ]);
            }


                $Usuario = DB::table('usuario.paciente')
                ->select('primer_nombre', 'primer_apellido', 'correo')
                ->where('id_paciente', (int)$request->id_Paciente)
                ->first(); 
                $sala = DB::table('locacion.sala')
                ->select('nombre')
                ->where('id_sala', (int)$request->consulta_sala)
                ->first();

                $estatus = DB::table('estetico.status_consulta')
                ->select('nombre')
                ->where('id_status_consulta', (int)$request->estatus_consultas)
                ->first(); 

                $fecha_carbon = Carbon::parse($request->fecha);
                $fecha_formateada = $fecha_carbon->translatedFormat('l j \d\e F \d\e\l Y');
                $hora_carbon = Carbon::createFromFormat('H:i', $request->hora);
                $hora_formateada = $hora_carbon->format('h:i A');
                $emailService = new EmailService();
                $to = $Usuario->correo;
                $from = 'beautysys.2023@gmail.com';
                $subject = 'Seguimiento de la consulta';
                $data = [
                    'first_name' => $Usuario->primer_nombre,
                    'last_name' => $Usuario->primer_apellido,
                    'asunto' => 'Consulta',
                    'estatus' => $estatus->nombre,
                    'dia' => $fecha_formateada,
                    'hora' => $hora_formateada,
                    'whatsapp' => '664 359 9935',
                    'sala' => $sala->nombre
                ];
                $response = $emailService->sendEmail($to, $from, $subject, $data);



            session(['activeTab' => 'Consultas']);
            return redirect()->route('consultas.index')->with('success', 'Consulta creada correctamente.');
        } catch (\Exception $e) {
            // Mostrar mensaje de error
            return redirect()->route('consultas.index')->with('error', 'No se pudo crear la consulta.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $consultas = DB::table('estetico.consulta as ec')
        ->select(
            'id_consulta',
            'fecha_visita',
            'id_paciente',
            'id_personal',
            'datos_consulta',
            'aprovacion_cirugia',
            'id_status_consulta',
            'id_sala'

        )
        ->where('ec.id_consulta' , $id )
        ->first();


        $paciente = DB::table('usuario.paciente')
        ->select(
            'id_paciente',
            DB::raw("CONCAT(primer_nombre, ' ', primer_apellido, ' ', segundo_apellido) as nombrePaciente"),
            'fecha_nacimiento',
            'telefono',
            'correo'
        )
        ->where('id_paciente',(int)$consultas->id_paciente)
        ->first();

        $SelectPersonal = DB::table('personal.personal as P')
        ->join('personal.departamento as D', 'P.id_departamento', '=', 'D.id_departamento')
        ->select('P.id_personal', DB::raw("CONCAT(P.primer_nombre, ' ', P.primer_apellido, ' ', P.segundo_apellido) as nombrePersonalAcargo"), 'D.nombre as nombreDepartamento')
        ->where('P.id_personal', (int)$consultas->id_personal)
        ->get();

        $sala = DB::table('locacion.sala as ls')
        ->select('ls.id_sala', 'ls.nombre', 'ls.capacidad','les.nombre as status')
        ->join('locacion.estado_sala as les','les.id_estado_sala', '=', 'ls.id_estado_sala')
        ->where('ls.nombre', 'like',"%Consultoria%")
        ->where('les.nombre', 'like',"%Disponible%")
        ->get();

        $status = DB::table('estetico.status_consulta')
        ->select('id_status_consulta', 'nombre')
        ->get();

        $analisis = DB::table('estetico.analisis')
        ->select(
            'id_analisis',
            'nombre',
            'ruta',
            'notas',
            'id_consulta',
        )
        ->where('id_consulta',(int)$consultas->id_consulta)
        ->get(); 

        session(['activeTab' => 'Consultas']);
        return view('consultas.consultavista',compact('consultas','SelectPersonal','sala','status','paciente', 'analisis'));
    }

    public function showActualizar(string $id)
    {
        $consultas = DB::table('estetico.consulta as ec')
        ->select(
            'id_consulta',
            'fecha_visita',
            'id_paciente',
            'id_personal',
            'datos_consulta',
            'aprovacion_cirugia',
            'id_status_consulta',
            'id_sala'

        )
        ->where('ec.id_consulta' , $id )
        ->first();


        $paciente = DB::table('usuario.paciente')
        ->select(
            'id_paciente',
            DB::raw("CONCAT(primer_nombre, ' ', primer_apellido, ' ', segundo_apellido) as nombrePaciente"),
            'fecha_nacimiento',
            'telefono',
            'correo'
        )
        ->where('id_paciente',$consultas->id_paciente)
        ->first();

        $SelectPersonal = DB::table('personal.personal as P')
        ->join('personal.departamento as D', 'P.id_departamento', '=', 'D.id_departamento')
        ->select('P.id_personal', DB::raw("CONCAT(P.primer_nombre, ' ', P.primer_apellido, ' ', P.segundo_apellido) as nombrePersonalAcargo"), 'D.nombre as nombreDepartamento')
        ->where('P.id_personal', (int)$consultas->id_personal)
        ->get();

        $sala = DB::table('locacion.sala as ls')
        ->select('ls.id_sala', 'ls.nombre', 'ls.capacidad','les.nombre as status')
        ->join('locacion.estado_sala as les','les.id_estado_sala', '=', 'ls.id_estado_sala')
        ->where('ls.nombre', 'like',"%Consultoria%")
        ->get();

        $status = DB::table('estetico.status_consulta')
        ->select('id_status_consulta', 'nombre')
        ->get();

        $analisis = DB::table('estetico.analisis')
        ->select(
            'id_analisis',
            'nombre',
            'ruta',
            'notas',
            'id_consulta',
        )
        ->where('id_consulta',(int)$consultas->id_consulta)
        ->get();



        session(['activeTab' => 'Consultas']);
        return view('consultas.consultaactualizar',compact('consultas','SelectPersonal','sala','status','paciente','analisis'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function actualizarConsulta(Request $request, string $id)
    {
        try {
          DB::table('estetico.consulta')
          ->where('id_consulta', $id)
          ->update([
              'fecha_visita' => date('Y-m-d H:i:s', strtotime($request->fecha . ' ' . $request->hora)),
              'id_personal' => $request->personal,
              'datos_consulta' => $request->datos_consultas,
              'id_status_consulta' => $request->estatus_consultas,
              'id_sala' => $request->consulta_sala,
              'aprovacion_cirugia' =>$request->Aprovacion_cirugia,
          ]);

            if ($request->estatus_consultas == 2) {
                DB::table('locacion.sala')
                ->where('id_sala', $request->consulta_sala)
                ->update([
                    'id_estado_sala' => 3
                ]);
            } else {
                DB::table('locacion.sala')
                ->where('id_sala', $request->consulta_sala)
                ->update([
                    'id_estado_sala' => 1
                ]);
            }


            $Usuario = DB::table('usuario.paciente')
              ->select('primer_nombre', 'primer_apellido', 'correo')
              ->where('id_paciente', (int)$request->id_paciente)
              ->first(); 
              $sala = DB::table('locacion.sala')
              ->select('nombre')
              ->where('id_sala', (int)$request->consulta_sala)
              ->first();
              $estatus = DB::table('estetico.status_consulta')
                ->select('nombre')
                ->where('id_status_consulta', (int)$request->estatus_consultas)
                ->first(); 

              $fecha_carbon = Carbon::parse($request->fecha);
              $fecha_formateada = $fecha_carbon->translatedFormat('l j \d\e F \d\e\l Y');
              $hora_carbon = Carbon::createFromFormat('H:i', $request->hora);
              $hora_formateada = $hora_carbon->format('h:i A');
              $emailService = new EmailService();
              $to = $Usuario->correo;
              $from = 'beautysys.2023@gmail.com';
              $subject = 'Seguimiento de la consulta';
              $data = [
                  'first_name' => $Usuario->primer_nombre,
                  'last_name' => $Usuario->primer_apellido,
                  'asunto' => 'Consulta',
                  'estatus' => $estatus->nombre,
                  'dia' => $fecha_formateada,
                  'hora' => $hora_formateada,
                  'whatsapp' => '664 359 9935',
                  'sala' => $sala->nombre
              ];
              $response = $emailService->sendEmail($to, $from, $subject, $data);

            session(['activeTab' => 'Consultas']);
            return redirect()->route('consultas.index')->with('success', 'Consulta actualizada correctamente.');
        } catch (\Exception $e) {
            // Mostrar mensaje de error
            return redirect()->route('consultas.index')->with('error', 'No se pudo actualizar la consulta.');
        }
    }

    public function crear_analisis(Request $request, string $id){
        try {
            DB::table('estetico.analisis')->insert([
                'nombre'=> $request->nombre_paciente_modal,
                'resultados' => $request->estatus_analisis,
                'notas' => $request->paciente_nota,
                'diagnostico' => $request->paceinte_diagnostico,
                'id_consulta' => $id,
            ]);

            // dump($request->all());
            // dump($id);

            $idPaciente = $request->input('id_paciente_modal');

            // Obtener la fecha actual en formato 'Ymd'
            $fechaActual = now()->format('Ymd');

            // Crear la estructura de carpetas si no existe
            $carpetaPaciente = "analisis/paciente_{$idPaciente}/{$fechaActual}";

            if (!Storage::disk('archivosAnalisis')->exists($carpetaPaciente)) {
                Storage::disk('archivosAnalisis')->makeDirectory($carpetaPaciente, 0755, true);
            }

            if ($request->hasFile('pdf_file')) {
                $file = $request->file('pdf_file');

                // Nombre del archivo basado en la fecha actual y el nombre original
                $nombreArchivo =$file->getClientOriginalName();

                // Guardar el archivo en la carpeta del paciente
                $rutaArchivo = "{$carpetaPaciente}/{$nombreArchivo}";

                // Usar Storage para almacenar el archivo en la carpeta del paciente
                Storage::disk('archivosAnalisis')->put("{$carpetaPaciente}/{$nombreArchivo}", file_get_contents($file));
            }

            DB::table('estetico.analisis')->insert([
                'nombre'=> $request->nombre_paciente_modal,
                'ruta' => $rutaArchivo,
                'notas' => $request->paciente_nota,
                'id_consulta' => $id,
            ]);            

            session(['activeTab' => 'Consultas']);
            return redirect()->route('ConsultaActualizarVista', ['id'=> $id])->with('success', 'Analisis creado correctamente.');
        } catch (\Exception $e) {
            // Mostrar mensaje de error
            return redirect()->route('ConsultaActualizarVista')->with('error', 'No se pudo crear el analisis.');
        }
    }

    public function actualizarAnalisis(Request $request ,string $id){

        DB::table('estetico.analisis')
        ->where('id_analisis', $id)
        ->update([

            'nombre'=> $request->nombre_paciente_modal,
            'resultados'=> $request->estatus_analisis,
            'notas'=> $request->nota_analisis,
            'diagnostico'=> $request->dianostico_analisis,
        ]);


        session(['activeTab' => 'Consultas']);
        return redirect()->route('ConsultaActualizarVista', ['id'=> $request->consulta])->with('success', 'analisis creado correctamente.');

    }

    public function cancelarForm(string $id)
    {
        $consulta = DB::table('estetico.consulta as ec')
            ->select(
                'ec.id_consulta as id',
                'ec.fecha_visita as fecha',
                DB::raw("concat(up.primer_apellido,' ', up.primer_nombre) as nombre_ps"),
                DB::raw("concat(pp.primer_apellido,' ', pp.primer_nombre) as nombre_pp"),
                'ec.aprovacion_cirugia as aprovacion',
                'esc.nombre as estatus',
                'ls.nombre as nombre_sala',
                'les.nombre as estado_sala',
                'ec.id_status_consulta'
            )
            ->join('usuario.paciente as up', 'up.id_paciente', '=', 'ec.id_paciente')
            ->join('personal.personal as pp', 'pp.id_personal', '=', 'ec.id_personal')
            ->join('estetico.status_consulta as esc', 'esc.id_status_consulta', '=', 'ec.id_status_consulta')
            ->join('locacion.sala as ls', 'ls.id_sala', '=', 'ec.id_sala')
            ->join('locacion.estado_sala as les', 'les.id_estado_sala', '=', 'ls.id_estado_sala')
            ->where('id_consulta' , $id )
            ->first();

        session(['activeTab' => 'Consultas']);

        //dump($consulta);
        return view('consultas.consultasCancelar', compact('consulta'));
    }

    public function cancelar(string $id)
    {
        $consultas = DB::table('estetico.consulta')
        ->select(
            'id_consulta',
            'id_status_consulta',
            'id_sala'
        )
        ->where('id_consulta' , $id )
        ->first();

        try{
            if( $consultas->id_status_consulta == 2){
                DB::table('locacion.sala')
                    ->where('id_sala', $consultas->id_sala)
                    ->update([
                        'id_estado_sala' => 1
                    ]);
            }

            DB::table('estetico.consulta')
                ->where('id_consulta', $id)
                ->update([
                    'id_status_consulta' => 4,
                ]);

            session(['activeTab' => 'Consultas']);

            return redirect()->route('consultas.index')->with('success', 'Consulta cancelada');
        } catch (\Exception $e) {
            // Mostrar mensaje de error
            return redirect()->route('consultas.index')->with('error', 'No se pudo cancelar la consulta.');
        }
    }

  public function mostrarPDF($id) {
        $analisis = DB::table('estetico.analisis')
            ->where('id_analisis', $id)
            ->value('ruta');
    
        $rutaCompleta = Storage::disk('archivosAnalisis')->path($analisis);
    
        $contenidoPDF = file_get_contents($rutaCompleta);
    
        return response($contenidoPDF)
            ->header('Content-Type', 'application/pdf');
    }


    public function eliminarPDF($id) {
        // Obtener la ruta del archivo desde la base de datos
        $analisis = DB::table('estetico.analisis')
            ->where('id_analisis', $id)
            ->value('ruta');
    
        // Ruta completa del archivo
        $rutaCompleta = Storage::disk('archivosAnalisis')->path($analisis);
    
        // Verificar si el archivo existe antes de eliminarlo
        if (Storage::disk('archivosAnalisis')->exists($analisis)) {
            // Eliminar el archivo físico
            Storage::disk('archivosAnalisis')->delete($analisis);
        }
    
        // Eliminar la entrada en la base de datos
        DB::table('estetico.analisis')->where('id_analisis', $id)->delete();
    
        // Redirigir de vuelta a la vista anterior
        return redirect()->back();
    }
}
