@php
    use Carbon\Carbon;
@endphp

<style>
    .input-form {
      position: relative;
      font-family: Arial, Helvetica, sans-serif;
    }

    .input-form input, .input-form textarea, .input-form select {
      border: solid 1.9px #9e9e9e;
      border-radius: 1.3rem;
      background: none;
      padding: 1rem;
      font-size: 1rem;
      color: #000000;
      transition: border 150ms cubic-bezier(0.4, 0, 0.2, 1);
      width: 100%;
    }

    .textUser {
      position: absolute;
      left: 15px;
      color: #666666;
      pointer-events: none;
      transform: translateY(1rem);
      transition: 150ms cubic-bezier(0.4, 0, 0.2, 1);
    }

    .input-form input:focus, .input-form input:valid, .input-form textarea:focus, .input-form textarea:valid,
    .input-form select:focus, .input-form select:valid {
      outline: none;
      box-shadow: 1px 2px 5px rgba(133, 133, 133, 0.523);
      background-image: linear-gradient(to top, rgba(182, 182, 182, 0.199), rgba(252, 252, 252, 0));
      transition: background 4s ease-in-out;
    }

    input:disabled ~ label.fixed-label, textarea:disabled ~ label.fixed-label,  select:disabled ~ .fixed-label {
    transform: translateY(-95%) scale(0.9);
    padding: 0 .2em;
    color: #000000be;
    left: 10%;
    font-size: 14pt;
    visibility: visible!important;
    }



    .container2 {
      height: 300px;
      width: 300px;
      border-radius: 10px;
      box-shadow: 4px 4px 30px rgba(0, 0, 0, .2);
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: space-between;
      padding: 10px;
      gap: 5px;
      background-color: rgba(0, 110, 255, 0.041);
    }

    .header {
      flex: 1;
      width: 100%;
      border: 2px dashed royalblue;
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction: column;
      background-size: contain;
      background-position: center;
      background-repeat: no-repeat;
    }

    .header svg {
      height: 100px;
    }

    .header p {
      text-align: center;
      color: black;
    }

    .footer {
      background-color: rgba(0, 110, 255, 0.075);
      width: 100%;
      height: 40px;
      padding: 8px;
      border-radius: 10px;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: flex-end;
      color: black;
      border: none;
    }

    .footer svg {
      height: 130%;
      fill: royalblue;
      background-color: rgba(70, 66, 66, 0.103);
      border-radius: 50%;
      padding: 2px;
      cursor: pointer;
      box-shadow: 0 2px 30px rgba(0, 0, 0, 0.205);
    }

    .footer p {
      flex: 1;
      text-align: center;
    }

    #file {
      display: none;
    }

    .label-container {
            display: inline-block;
            width: 150px; /* Ajusta el ancho según lo que necesites */
            height: 150px; /* Ajusta la altura según lo que necesites */
            border: 1px solid #ccc; /* Agrega un borde para que sea visible */

        }

    </style>

@extends('layout.template')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card shadow">
                <div class="card-header">
                    <h4 class="card-title">Detalles de la Cita con ID: {{ $cita->id_cita }}</h4>
                </div>
                <div class="card-body">
                    <div class="row mb-5">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre del paciente:</label>
                            <input type="text" class="form-control input-form" id="name" value="{{ $cita->paciente->primer_nombre }} {{ $cita->paciente->primer_apellido }}" disabled>
                        </div>

                        <div class="mb-3">
                            <label for="date" class="form-label">Fecha y hora de la cita:</label>
                            <input type="text" class="form-control input-form" id="date" value="{{ Carbon::parse($cita->hora_cita)->format('h:i A') }} el d&iacute;a {{ Carbon::parse($cita->fecha_cita)->format('d-m-Y') }}" disabled>
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Estado de la cita:</label>
                            <input type="text" class="form-control input-form" id="status" value="{{ $cita->estadoCita->nombre }}" disabled>
                        </div>

                        <div class="mb-3">
                            <label for="sala" class="form-label">Sala:</label>
                            <input type="text" class="form-control input-form" id="sala" value="{{ str_replace('_', ' ', $cita->sala->nombre) }}" disabled>
                        </div>

                        <div class="mb-3">
                            <label for="tipoCirugia" class="form-label">Tipo de cita:</label>
                            <input type="text" class="form-control input-form" id="tipoCirugia" value="{{ $cita->tipoCita->nombre }}" disabled>
                        </div>

                        <div class="mb-3">
                            <label for="doctor" class="form-label">Doctor que antender&aacute;:</label>
                            <input type="text" class="form-control input-form" id="doctor" value="{{ $cita->personal->primer_nombre }} {{ $cita->personal->primer_apellido }}" disabled>
                        </div>

                        <div class="mb-3">
                            <label for="insumos" class="form-label">Insumos para la consulta:</label>
                            <input type="text" class="form-control input-form" id="insumos" value="{{ $cita->insumos ? $cita->insumos->nombre : 'Sin insumos asignados' }}" disabled>
                        </div>

                        <div class="mb-3">
                            <label for="equipoMedico" class="form-label">Equipo para la consulta:</label>
                            <input type="text" class="form-control input-form" id="equipoMedico" value="{{ $cita->equipoMedico ? $cita->equipoMedico->nombre : 'Sin equipo asignado' }}" disabled>
                        </div>



                        <div class="text-center mt-4">
                            <a href="{{ route('Citas.index') }}" class="btn btn-primary">Volver</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layout.footer')
@endsection
