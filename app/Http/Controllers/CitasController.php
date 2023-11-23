<?php

// app/Http/Controllers/CitasController.php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\CitaUsers;
use App\Models\EquipoMedico;
use App\Models\EstadoCita;
use App\Models\Insumos;
use App\Models\Paciente;
use App\Models\Personal;
use App\Models\Sala;
use App\Models\TipoCita;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class CitasController extends Controller
{
    public function index()
    {
        $citas = Cita::orderByDesc('id_cita')->paginate(5);
        session(['activeTab' => 'Citas']);
        return view('Citas.citas', compact('citas'));
    }

    public function citasUsuarios()
    {
        // $citaU = CitaUsers::orderByDesc('id_cita');
        return view('Citas.citaUser');
    }

    public function show($id)
    {
        $cita = Cita::findOrFail($id);
        session(['activeTab' => 'Citas']);
        //dump($cita);
        return view('Citas.vistaCita', compact('cita'));
    }

    public function create()
    {
        $citas = Cita::all();
        $pacientes = Paciente::all();
        $estadoCita = EstadoCita::all();
        // $sala = Sala::all();
        $sala = DB::table('locacion.sala as ls')
        ->select('ls.id_sala', 'ls.nombre', 'ls.capacidad','les.nombre as status')
        ->join('locacion.estado_sala as les','les.id_estado_sala', '=', 'ls.id_estado_sala')
        ->where('ls.nombre', 'like',"%Consultoria%")
        // ->where('les.nombre', 'like',"%Disponible%")
        ->get();
        $tipoCita = TipoCita::all();
        $personal = Personal::all();
        $insumos = Insumos::all();
        $equipo = EquipoMedico::all();

        // dump($citas);
        session(['activeTab' => 'Citas']);
        return view('Citas.crearCita', compact('citas', 'pacientes', 'estadoCita', 'sala', 'tipoCita', 'personal', 'insumos', 'equipo'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'id_paciente' => 'required|integer',
            'hora_cita' => 'required|string|max:50',
            'fecha_cita' => 'required|date',
            'id_estado_cita' => 'required|integer',
            'id_sala' => 'required|integer',
            'id_tipo_cita' => 'required|integer',
            'id_personal' => 'required|integer',
            'id_insumos' => 'nullable|integer',
            'id_equipo' => 'nullable|integer'
        ]);

        try {
            $cita = new Cita();
            $cita->hora_cita = $request->hora_cita;
            $cita->fecha_cita = $request->fecha_cita;
            $cita->id_paciente = $request->id_paciente;
            $cita->id_personal = $request->id_personal;
            $cita->id_estado_cita = $request->id_estado_cita;
            $cita->id_sala = $request->id_sala;
            $cita->id_tipo_cita = $request->id_tipo_cita;
            $cita->save();

            $sala = Sala::findOrFail($request->id_sala);
            // dump($sala);

            if ($sala->id_estado_sala != 1) {
                return redirect()->route('Citas.crear')->with('salaNotAvailable', true);
            }

            if($request->id_estado_cita == 4){
                $sala->id_estado_sala = '3';
                $sala->save();
            }

            if($request->id_estado_cita == 9){
                $sala->id_estado_sala = '2';
                $sala->save();
            }

            // if($request->id_estado_cita == 1 or 3 or 5 or 8){
            //     $sala->id_estado_sala = '10';
            //     $sala->save();
            // }

            // if($request->id_estado_cita == 2 or 6 or 7 or 10){
            //     $sala->update([
            //         'id_estado_sala' => '1',
            //     ]);
            // }
            session(['activeTab' => 'Citas']);
            return redirect()->route('Citas.index')->with('success', 'Cita creada exitosamente.');
        } catch (\Exception $e) {
            // return $e;
            return redirect()->route('Citas.index')->with('error', 'No se pudo crear la cita.');
        }
    }

    public function edit($id)
    {
        $cita = Cita::findOrFail($id);
        $cita->fecha_cita = Carbon::createFromFormat('Y-m-d H:i:s.u', $cita->fecha_cita)->format('Y-m-d');
        $cita->hora_cita = Carbon::parse($cita->hora_cita)->format('H:i');
        $estadoCita = EstadoCita::all();
        $sala = Sala::all();
        $tipoCita = TipoCita::all();
        $personal = Personal::all();
        $insumos = Insumos::all();
        $equipo = EquipoMedico::all();

        session(['activeTab' => 'Citas']);
        // dump($cita);
        return view('Citas.actualizarCita', compact('cita', 'estadoCita', 'sala', 'tipoCita', 'personal', 'insumos', 'equipo'));
    }

    public function update(Request $request, $id)
    {
        // dump($request->all());

        $cita = Cita::findOrFail($id);

        $request->validate([
            'hora' => 'required|string|max:50',
            'fecha' => 'required|date',
            'id_estado_cita' => 'required|integer',
            'id_sala' => 'required|integer',
            'id_tipo_cita' => 'required|integer',
            'id_personal' => 'required|integer',
            'id_insumos' => 'nullable|integer',
            'id_equipo' => 'nullable|integer'
        ]);

        try {
            // $fechaFormat = Carbon::createFromFormat('Y-m-d', $request->fecha_cita)->format('Y-m-d H:i:s.u');
            $horaFormat = Carbon::parse($request->hora)->format('H:i');

            $cita->update([
                'hora' => $horaFormat,
                'fecha' => $request->fecha,
                'id_estado_cita' => $request->id_estado_cita,
                'id_sala' => $request->id_sala,
                'id_tipo_cita' => $request->id_tipo_cita,
                'id_personal' => $request->id_personal,
                'id_insumo' => $request->id_insumo,
                'id_equipo' => $request->id_equipo,
            ]);

            //dump($request->all(),   $horaFormat, $fechaFormat);

            session(['activeTab' => 'Citas']);
            return redirect()->route('Citas.index')->with('success', 'Cita actualizada exitosamente.');

        } catch (\Exception $e) {
            return $e;
            // return redirect()->route('Citas.index')->with('error', 'No se pudo actualizar la cita.');
        }
    }

    public function destroyForm($id)
    {
        $cita = Cita::findOrFail($id);
        session(['activeTab' => 'Citas']);
        // dump($cita);
        return view('Citas.eliminarCita', compact('cita'));
    }

    public function destroy(Request $request, $id)
    {
        // dump($request);

        $cita = Cita::findOrFail($id);
        $sala = Sala::findOrFail($cita->id_sala);
        session(['activeTab' => 'Citas']);

        try {
            $cita->delete();

            $sala->id_estado_sala = '1'; // si eliminas la cita regresa la sala a disponible
            $sala->save();

            return redirect()->route('Citas.index')->with('success', 'Cita eliminada correctamente.');

        } catch (\Exception $e) {
            // Mostrar mensaje de error
            return redirect()->route('Citas.index')->with('error', 'No se pudo eliminar la cita.');
        }
    }
}
