<?php

// app/Http/Controllers/CitasController.php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\EquipoMedico;
use App\Models\EstadoCita;
use App\Models\Insumos;
use App\Models\Paciente;
use App\Models\Personal;
use App\Models\Sala;
use App\Models\TipoCita;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CitasController extends Controller
{
    public function index()
    {
        $citas = Cita::all();
        session(['activeTab' => 'Citas']);
        return view('Citas.citas', compact('citas'));
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
        // $cita = new Cita();
        // $cita->hora_cita = '14:30:00';
        // $cita->fecha_cita = '2023-07-22';
        // $cita->id_paciente = 2; // ID del paciente relacionado
        // $cita->id_personal = 1; // ID del personal relacionado (p. ej., el médico)
        // $cita->id_estado_cita = 1; // ID del estado de la cita (p. ej., pendiente, confirmada, cancelada, etc.)
        // $cita->id_sala = 3; // ID de la sala donde se llevará a cabo la cita
        // $cita->id_tipo_cita = 5; // ID del tipo de cita (p. ej., consulta, procedimiento, seguimiento, etc.)
        // $cita->save();

        $citas = Cita::all();
        // dump($citas);
        session(['activeTab' => 'Citas']);
        // Redireccionar a la vista de citas con un mensaje de éxito
        // return redirect()->route('Citas.index')->with('success', 'Cita creada correctamente.');

        // $estadosCita = EstadoCita::all();
        // $tiposCita = TipoCita::all();
        return view('Citas.crearCita', compact('citas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'hora_cita' => 'required',
            'fecha_cita' => 'required',
            'id_paciente' => 'required',
            'id_personal' => 'required',
            'id_estado_cita' => 'required',
            'id_sala' => 'required',
            'id_tipo_cita' => 'required',
        ]);

        Cita::create($request->all());

        session(['activeTab' => 'Citas']);
        return redirect()->route('Citas.index')->with('success', 'Cita creada exitosamente.');
    }

    public function edit($id)
    {
        $cita = Cita::findOrFail($id);
        $cita->fecha_cita = Carbon::createFromFormat('Y-m-d H:i:s.u', $cita->fecha_cita)->format('Y-m-d');
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
            'hora_cita' => 'required|max:50',
            'fecha_cita' => 'required|date',
            'id_estado_cita' => 'required|integer',
            'id_sala' => 'required|integer',
            'id_tipo_cita' => 'required|integer',
            'id_personal' => 'required|integer',
            'id_insumos' => 'nullable|integer',
            'id_equipo' => 'nullable|integer'
        ]);

        try {
            $fechaFormat = Carbon::createFromFormat('Y-m-d', $request->fecha_cita)->format('Y-m-d H:i:s.u');
            $horaFormat = Carbon::parse($request->hora_cita)->format('H:i');

            $cita->update([
                'hora_cita' => $horaFormat,
                'fecha_cita' => $fechaFormat,
                'id_estado_cita' => $request->id_estado_cita,
                'id_sala' => $request->id_sala,
                'id_tipo_cita' => $request->id_tipo_cita,
                'id_personal' => $request->id_personal,
                'id_insumo' => $request->id_insumo,
                'id_equipo' => $request->id_equipo,
            ]);

            // dump($horaFormat, $fechaFormat);

            session(['activeTab' => 'Citas']);
            // Mostrar mensaje de éxito
            //dump($request);
            return redirect()->route('Citas.index')->with('success', 'Cita actualizada exitosamente.');

        } catch (\Exception $e) {
            // Mostrar mensaje de error
            return redirect()->route('Citas.index')->with('error', 'No se pudo actualizar la cita.');
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
        $cita = Cita::findOrFail($id);

        session(['activeTab' => 'Citas']);

        try {
            $cita->delete();
            return redirect()->route('Citas.index')->with('success', 'Cita eliminada correctamente.');

        } catch (\Exception $e) {
            // Mostrar mensaje de error
            return redirect()->route('Citas.index')->with('error', 'No se pudo eliminar la cita.');
        }
    }
}
