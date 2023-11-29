<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

//datasciens imports
use Phpml\Dataset\ArrayDataset;
use Phpml\CrossValidation\RandomSplit;

use Phpml\Classification\SVC;
use Phpml\SupportVectorMachine\Kernel;


use Illuminate\Support\Facades\Storage;


class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $id = Auth::user()->id;


        $today = Carbon::today()->format('Y-m-d');
        $hour = Carbon::now()->format('H:i');

        if(auth()->user()->hasRole(['admin', 'staff'])){
            // $tiempoInicio = microtime(true);


            $Citas = DB::table('estetico.cita as C')
            ->select('P.primer_apellido', 'S.nombre', 'C.fecha_cita', 'C.id_cita','C.hora_cita')
            ->join('usuario.paciente as P', 'P.id_paciente', '=', 'C.id_paciente')
            ->join('locacion.sala as S', 'S.id_sala', '=', 'C.id_sala')
            ->whereNotIn('C.id_estado_cita', [2, 4, 6, 7, 8, 10])
            ->whereDate('C.fecha_cita', $today)
            ->whereTime('C.hora_cita', '>',  $hour )
            ->orderBy('C.hora_cita')
            ->paginate(5);

            $Consultas = DB::table('estetico.consulta as C')
            ->select('P.primer_apellido','S.nombre','c.fecha_visita')
            ->join('usuario.paciente as P', 'P.id_paciente', '=', 'C.id_paciente')
            ->join('locacion.sala as S', 'S.id_sala', '=', 'C.id_sala')
            ->whereNotIn('C.id_status_consulta', [2, 3, 4])
            ->whereDate('C.fecha_visita', $today)
            ->whereTime('C.fecha_visita', '>',  $hour )
            ->orderBy('C.fecha_visita')
            ->paginate(5);

            $Cirugias = DB::table('estetico.Cirugia as C')
            ->select('P.primer_apellido','S.nombre','C.fecha_cirugia')
            ->join('usuario.paciente as P', 'P.id_paciente', '=', 'C.id_paciente')
            ->join('locacion.sala as S', 'S.id_sala', '=', 'C.id_sala')
            ->whereNotIn('C.id_estatus_cirugia', [5,6,7,9,10])
            ->whereDate('C.fecha_cirugia', $today)
            ->whereTime('C.fecha_cirugia', '>',  $hour )
            ->orderBy('C.fecha_cirugia')
            ->paginate(5);

            $labelAlergias = DB::table('usuario.tipo_alergia')
            ->select ( 'nombre')
            ->get();

            $labelEnfermedad= DB::table('usuario.tipo_enfermedad_cronica')
            ->select('nombre')
            ->get();


            $labelEnfermedaFinal = array_column($labelEnfermedad->toArray(), 'nombre');
            $labelAlergiFinal = array_column($labelAlergias->toArray(), 'nombre');


            $userArray = DB::select('EXEC GetPacientes');

            $arrkey = array_keys($userArray);

            $dataset = new ArrayDataset(
                array_map(function($sample) {
                    if ($sample->Alergias !== null) {
                        $sample->Alergias = explode('__', $sample->Alergias);
                    }

                    if ($sample->Enfermedades !== null) {
                        $sample->Enfermedades = explode('__', $sample->Enfermedades);
                    }

                    return $sample;
                }, $userArray),
                $arrkey,
                true
            );

            
            $samples = $dataset->getSamples();
            $labels =  $dataset->getTargets();

            $CountUser = count($samples);
            
            
            $enfermedadCount = $this->DataEnfermedad($samples);
            $alergiaCount = $this->DataAlergia($samples);
            $generoCounter = $this->DataGender($samples);
            $edadCounter = $this->DataEdad($samples);
            
            $DataSciens = $this->DataSciens($samples,$labelEnfermedaFinal,$labelAlergiFinal);
            // dd($DataSciens);

            function calcularPorcentajes($array) {
                $sumaTotal = array_sum($array);
            
                return array_map(
                    fn($value) => ($value / $sumaTotal) * 100,
                    $array
                );
            }

            $porcentajeAlergia = calcularPorcentajes($DataSciens[1][0]);
            $porcentajeEnfermedad = calcularPorcentajes($DataSciens[0][0]);
            
            
            session(['activeTab' => 'Dashboard']);

            return view('dashboard',compact('Citas','today','Consultas','Cirugias','alergiaCount','CountUser','enfermedadCount','generoCounter','labelEnfermedaFinal','labelAlergiFinal','edadCounter','porcentajeAlergia','porcentajeEnfermedad'));
        }
        if(auth()->user()->hasRole(['user'])){
            
            $paciente = DB::table('usuario.paciente')
            ->select('id_paciente','primer_nombre','segundo_nombre','primer_apellido','segundo_apellido','fecha_nacimiento','genero','telefono','seguro_medico','dirreccion','correo','foto','id_cuenta')
            ->where('id_cuenta', $id)
            ->first();


            $Citas = DB::table('estetico.cita as C')
            ->select('P.primer_apellido', 'S.nombre', 'C.fecha_cita', 'C.id_cita','C.hora_cita')
            ->join('usuario.paciente as P', 'P.id_paciente', '=', 'C.id_paciente')
            ->join('locacion.sala as S', 'S.id_sala', '=', 'C.id_sala')
            ->whereNotIn('C.id_estado_cita', [2, 4, 6, 7, 8, 10])
            ->whereDate('C.fecha_cita', $today)
            ->whereTime('C.hora_cita', '>',  $hour )
            ->where('C.id_paciente', $paciente->id_paciente)
            ->orderBy('C.hora_cita')
            ->paginate(5);

            $Consultas = DB::table('estetico.consulta as C')
            ->select('P.primer_apellido','S.nombre','c.fecha_visita')
            ->join('usuario.paciente as P', 'P.id_paciente', '=', 'C.id_paciente')
            ->join('locacion.sala as S', 'S.id_sala', '=', 'C.id_sala')
            ->whereNotIn('C.id_status_consulta', [2, 3, 4])
            ->whereDate('C.fecha_visita', $today)
            ->whereTime('C.fecha_visita', '>',  $hour )
            ->where('C.id_paciente', $paciente->id_paciente)
            ->orderBy('C.fecha_visita')
            ->paginate(5);

            $Cirugias = DB::table('estetico.Cirugia as C')
            ->select('P.primer_apellido','S.nombre','C.fecha_cirugia')
            ->join('usuario.paciente as P', 'P.id_paciente', '=', 'C.id_paciente')
            ->join('locacion.sala as S', 'S.id_sala', '=', 'C.id_sala')
            ->whereNotIn('C.id_estatus_cirugia', [5,6,7,9,10])
            ->whereDate('C.fecha_cirugia', $today)
            ->whereTime('C.fecha_cirugia', '>',  $hour )
            ->where('C.id_paciente', $paciente->id_paciente)
            ->orderBy('C.fecha_cirugia')
            ->paginate(5);

            session(['activeTab' => 'Dashboard']);
            return view('dashboard',compact('Citas','today','Consultas','Cirugias'));

        }

        
    }

    public function DataSciens (array $samples, array $labelEnfermedaFinal, array $labelAlergiFinal ){
        // $tiempoInicio = microtime(true);

        $DiccionarioEnfermedad = array_flip($labelEnfermedaFinal);
        $DiccionarioAlergia = array_flip($labelAlergiFinal);

        $transformedSamplesEnfermedades = array_map(function ($sample)use ($DiccionarioEnfermedad,$DiccionarioAlergia) {
            return [
                // Agregar otras características aquí
                // Agregar características para enfermedades y alergias numéricas
                is_array($sample->Enfermedades)
                ?array_map(function ($enfermedad) use ($DiccionarioEnfermedad) {
                    return $DiccionarioEnfermedad[$enfermedad]  ?? [];
                }, $sample->Enfermedades) : []
            ];
        }, $samples);

        $transformedSamplesAlergias = array_map(function ($sample)use ($DiccionarioEnfermedad,$DiccionarioAlergia) {
            return [
                // Agregar otras características aquí
                // Agregar características para enfermedades y alergias numéricas
                is_array($sample->Alergias)
                ?array_map(function ($alergia) use($DiccionarioAlergia){
                    return $DiccionarioAlergia[$alergia]  ?? [];
                },$sample->Alergias) : [],

            ];
        }, $samples);

        // dd(array_merge(...$transformedSamplesEnfermedades),array_merge(...$transformedSamplesAlergias));

        $arrkey = array_map( function($sample){
            return intval($sample->Edad);
        }, $samples);

        //creacion del dataset
        function predict ($transformedSamples,$arrkey){
            $dataset = new ArrayDataset($transformedSamples,$arrkey,true);
            //division del dataset en train y test
            $datatest = new RandomSplit($dataset, 0.2,156);
    
            $classifier = new SVC(
                Kernel::LINEAR, // $kernel
                1.0,            // $cost
                3,              // $degree
                null,           // $gamma
                0.0,            // $coef0
                0.001,          // $tolerance
                100,            // $cacheSize
                true,           // $shrinking
                true            // $probabilityEstimates, set to true
            );
    
            $classifier->train($datatest->getTrainSamples(), $datatest->getTrainLabels());
    
            // Realizar predicciones en el conjunto de prueba
            $predictions = $classifier->predictProbability($datatest->getTestSamples());
    
            return $predictions;
        }

        $EnfermedadProbavilidad = predict(array_merge(...$transformedSamplesEnfermedades),$arrkey);
        
        $AlergiaProbavilidad = predict(array_merge(...$transformedSamplesAlergias),$arrkey);
        

        // dd($EnfermedadProbavilidad, $AlergiaProbavilidad);
        
        // $tiempoFin = microtime(true);
        // $tiempoEjecucion = $tiempoFin - $tiempoInicio;
        // dd($tiempoEjecucion);
        
        return [$EnfermedadProbavilidad , $AlergiaProbavilidad];
    }
    
    public function DataEnfermedad (array $samples)
    {
        $dataEnfermedadFiltrado = array_filter(array_map(function ($sample) {
            return $sample->Enfermedades;
        }, $samples), function ($Enfermedades) {
            return $Enfermedades !== null;
        });
        
        $PersonasEnfermedad = array_merge(...$dataEnfermedadFiltrado);
        
        
        return array_count_values($PersonasEnfermedad);
    }

    public function DataAlergia (array $samples)
    {
        $dataAlergiasFiltrado = array_filter(array_map(function ($sample) {
            return $sample->Alergias;
        }, $samples), function ($alergias) {
            return $alergias !== null;
        });

        $PersonasAlergia = array_merge(...$dataAlergiasFiltrado);
        return array_count_values($PersonasAlergia);
    }

    public function DataGender (array $samples)
    {
        $Genero = array_map(function ($sample) {
            return  $sample->Genero == null ? "Neutro" : $sample->Genero ; 
            }, $samples);

        return array_count_values($Genero);

    }

    public function DataEdad (array $samples)
    {
        $DataEdad = array_map(function ($sample) {
            return  $sample->Edad; 
            }, $samples);

        return array_count_values($DataEdad);

    }

    public function index_user (string $id)
    {
        
        $today = Carbon::today()->format('Y-m-d');
        $hour = Carbon::now()->format('H:i');
        
        $paciente = DB::table('usuario.paciente')
        ->select('id_paciente','primer_nombre','segundo_nombre','primer_apellido','segundo_apellido','fecha_nacimiento','genero','telefono','seguro_medico','dirreccion','correo','foto','id_cuenta')
        ->where('id_cuenta', $id)
        ->first();


        $Citas_user = DB::table('estetico.cita as C')
            ->select('P.primer_apellido', 'S.nombre', 'C.fecha_cita', 'C.id_cita','C.hora_cita')
            ->join('usuario.paciente as P', 'P.id_paciente', '=', 'C.id_paciente')
            ->join('locacion.sala as S', 'S.id_sala', '=', 'C.id_sala')
            ->whereNotIn('C.id_estado_cita', [2, 4, 6, 7, 8, 10])
            ->whereDate('C.fecha_cita', $today)
            ->whereTime('C.hora_cita', '>',  $hour )
            ->where('C.id_paciente', $paciente->id_paciente)
            ->orderBy('C.hora_cita')
            ->paginate(5);

            $Consultas_user = DB::table('estetico.consulta as C')
            ->select('P.primer_apellido','S.nombre','c.fecha_visita')
            ->join('usuario.paciente as P', 'P.id_paciente', '=', 'C.id_paciente')
            ->join('locacion.sala as S', 'S.id_sala', '=', 'C.id_sala')
            ->whereNotIn('C.id_status_consulta', [2, 3, 4])
            ->whereDate('C.fecha_visita', $today)
            ->whereTime('C.fecha_visita', '>',  $hour )
            ->where('C.id_paciente', $paciente->id_paciente)
            ->orderBy('C.fecha_visita')
            ->paginate(5);

            $Cirugias_user = DB::table('estetico.Cirugia as C')
            ->select('P.primer_apellido','S.nombre','C.fecha_cirugia')
            ->join('usuario.paciente as P', 'P.id_paciente', '=', 'C.id_paciente')
            ->join('locacion.sala as S', 'S.id_sala', '=', 'C.id_sala')
            ->whereNotIn('C.id_estatus_cirugia', [5,6,7,9,10])
            ->whereDate('C.fecha_cirugia', $today)
            ->whereTime('C.fecha_cirugia', '>',  $hour )
            ->where('C.id_paciente', $paciente->id_paciente)
            ->orderBy('C.fecha_cirugia')
            ->paginate(5);
            dump($Citas_user);
            dump($Consultas_user);
            
            dump($Cirugias_user);
        session(['activeTab' => 'Dashboard']);

        // return view('dashboarduser',compact('Citas_user','today','Consultas_user','Cirugias_user'));
        
        // return view('dashboard',['id'=> $id, 'paciente_user' => $paciente_user , 'Citas_user'=>$Citas_user,'Consultas_user'=>$Consultas_user,'Cirugias_user'=>$Cirugias_user, 'today' => $today]);

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
