<?php

// app/Http/Controllers/CitasController.php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\EstadoCita;
use App\Models\Paciente;
use App\Models\Personal;
use App\Models\Sala;
use App\Models\TipoCita;
use Illuminate\Http\Request;

class CitasController extends Controller
{
    public function index()
    {
        $citas = Cita::all();
        session(['activeTab' => 'Citas']);
        return view('citas.citas', compact('citas'));
    }

    public function show($id)
    {
        $cita = Cita::findOrFail($id);
        session(['activeTab' => 'Citas']);
        return view('citas.verCita', compact('citas'));
    }

    public function create()
    {
        $cita = new Cita();
        $cita->hora_cita = '14:30:00';
        $cita->fecha_cita = '2023-07-22';
        $cita->id_paciente = 1; // ID del paciente relacionado
        $cita->id_personal = 1; // ID del personal relacionado (p. ej., el médico)
        $cita->id_estado_cita = 1; // ID del estado de la cita (p. ej., pendiente, confirmada, cancelada, etc.)
        $cita->id_sala = 3; // ID de la sala donde se llevará a cabo la cita
        $cita->id_tipo_cita = 5; // ID del tipo de cita (p. ej., consulta, procedimiento, seguimiento, etc.)
        $cita->save();

        session(['activeTab' => 'Citas']);
        // Redireccionar a la vista de citas con un mensaje de éxito
        // return redirect()->route('Citas.index')->with('success', 'Cita creada correctamente.');

        // $estadosCita = EstadoCita::all();
        // $tiposCita = TipoCita::all();
        return view('citas.crearCita', compact('cita'));
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
        return redirect()->route('citas.index')->with('success', 'Cita creada exitosamente.');
    }

    public function edit($id)
    {
        $pacientes = Paciente::all();
        $personales = Personal::all();
        $estadosCita = EstadoCita::all();
        $salas = Sala::all();
        $tiposCita = TipoCita::all();

        session(['activeTab' => 'Citas']);
        return view('citas.edit', compact('cita', 'pacientes', 'personales', 'estadosCita', 'salas', 'tiposCita'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'hora_cita' => 'required',
            'fecha_cita' => 'required|date',
            'id_paciente' => 'required|integer',
            'id_personal' => 'required|integer',
            'id_estado_cita' => 'required|integer',
            'id_sala' => 'required|integer',
            'id_tipo_cita' => 'required|integer',
        ]);

        $cita = Cita::findOrFail($id);
        $cita->update($request->all());

        $cita->update($request->all());

        session(['activeTab' => 'Citas']);
        return redirect()->route('citas.index')->with('success', 'Cita actualizada exitosamente.');
    }

    public function destroy($id)
    {
        $cita = Cita::findOrFail($id);
        $cita->delete();

        session(['activeTab' => 'Citas']);
        return redirect()->route('citas.index')
            ->with('success', 'La cita ha sido eliminada exitosamente.');
    }
}
