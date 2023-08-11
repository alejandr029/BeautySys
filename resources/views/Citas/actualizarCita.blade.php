@php
    use Carbon\Carbon;
@endphp

@extends('layout.template')
<main>
    <style>
        /* Estilos de la clase input-form */
        .input-form {
            position: relative;
            font-family: Arial, Helvetica, sans-serif;
        }

        .input-form input,
        .input-form textarea,
        .input-form select {
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

        .input-form input:focus,
        .input-form input:valid,
        .input-form textarea:focus,
        .input-form textarea:valid,
        .input-form select:focus,
        .input-form select:valid {
            outline: none;
            box-shadow: 1px 2px 5px rgba(133, 133, 133, 0.523);
            background-image: linear-gradient(to top, rgba(182, 182, 182, 0.199), rgba(252, 252, 252, 0));
            transition: background 4s ease-in-out;
        }

    .input-form input:focus ~ label,
    .input-form input:valid ~ label,
    .input-form textarea:focus ~ label,
    .input-form textarea:valid ~ label,
    .input-form select:focus ~ label,
    .input-form select:valid ~ label {
            transform: translateY(-95%) scale(0.9);
            padding: 0 .2em;
            color: #000000be;
            left: 10%;
            font-size: 14pt;
      visibility: visible!important;
        }

        .input-form input:hover,
        .input-form textarea:hover,
        .input-form select:hover {
            border: solid 1.9px #000002;
            transform: scale(1.03);
            box-shadow: 1px 1px 5px rgba(133, 133, 133, 0.523);
            transition: border-color 1s ease-in-out;
        }

        /* Estilos personalizados para la clase container2 */
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
            width: 150px;
            /* Ajusta el ancho según lo que necesites */
            height: 150px;
            /* Ajusta la altura según lo que necesites */
            border: 1px solid #ccc;
            /* Agrega un borde para que sea visible */
        }
    </style>

    @section('content')

    
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-11">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">Actualizar Cita con ID: {{ $cita->id_cita }}</h2>
                        </div>

                        <div class="card-body">
                            <div class="col-lg-11">
                                <!-- Formulario para actualizar la cita -->
                                <form action="{{ route('Citas.update', ['id' => $cita->id_cita]) }}" method="post"
                                    class="role-form">
                                    @csrf
                                    @method('PUT')

                                    <div class="mb-3 input-form">
                                        <label for="paciente" class="form-label">Paciente:</label>
                                        <input type="text" class="form-control input-form" id="paciente" name="paciente"
                                            value="{{ $cita->paciente->primer_nombre }} {{ $cita->paciente->primer_apellido }}"
                                            readonly>
                                    </div>

                                    <hr class="dark horizontal">

                                    <div class="row">
                                        <div class="col-md-6 mb-3 input-form">
                                            <label for="fecha_cita" class="form-label">Fecha de la cita:</label>
                                            <input type="date" id="fecha" name="fecha" required  value="{{$cita->fecha_cita }}" >

                                        </div>

                                        <div class="col-md-6 mb-3 input-form">
                                            <label for="hora_cita" class="form-label">Hora de la cita:</label>
                                            <input type="time" id="hora" name="hora" required  value="{{ $cita->hora_cita }}">
                                        </div>
                                        
                                    </div>

                                    <hr class="dark horizontal">

                                    <div class="mb-3 input-form">
                                        <label for="id_sala" class="form-label">Sala:</label>
                                        <select class="form-control" id="id_sala" name="id_sala">
                                            @foreach ($sala as $sala)
                                                <option value="{{ $sala->id_sala }}"
                                                    {{ $sala->id_sala == $cita->id_sala ? 'selected' : '' }}>
                                                    {{ str_replace('_', ' ', $sala->nombre) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <hr class="dark horizontal">

                                    <div class="row">
                                        <div class="col-md-6 mb-3 input-form">
                                            <label for="id_estado_cita" class="form-label">Estado de la cita:</label>
                                            <select class="form-control" id="id_estado_cita" name="id_estado_cita">
                                                @foreach ($estadoCita as $estado)
                                                    <option value="{{ $estado->id_estado_cita }}"
                                                        {{ $estado->id_estado_cita == $cita->id_estado_cita ? 'selected' : '' }}>
                                                        {{ $estado->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-6 mb-3 input-form">
                                            <label for="id_tipo_cita" class="form-label">Tipo de cita:</label>
                                            <select class="form-control" id="id_tipo_cita" name="id_tipo_cita">
                                                @foreach ($tipoCita as $tipo)
                                                    <option value="{{ $tipo->id_tipo_cita }}"
                                                        {{ $tipo->id_tipo_cita == $cita->id_tipo_cita ? 'selected' : '' }}>
                                                        {{ $tipo->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <hr class="dark horizontal">

                                    <div class="mb-3 input-form">
                                        <label for="id_personal" class="form-label">Doctor que atenderá:</label>
                                        <select class="form-control" id="id_personal" name="id_personal">
                                            @foreach ($personal as $person)
                                                <option value="{{ $person->id_personal }}"
                                                    {{ $person->id_personal == $cita->id_personal ? 'selected' : '' }}>
                                                    {{ $person->primer_nombre }} {{ $person->primer_apellido }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <hr class="dark horizontal">

                                    <div class="row">
                                        <div class="col-md-6 mb-3 input-form">
                                            <label for="id_insumo" class="form-label">Insumos para la consulta:</label>
                                            <select class="form-control" id="id_insumo" name="id_insumo">
                                                <option value="">Sin insumos asignados</option>
                                                @foreach ($insumos as $insumo)
                                                    <option value="{{ $insumo->id_insumo }}"
                                                        {{ $cita->insumos && $cita->insumos->id_insumo == $insumo->id_insumo ? 'selected' : '' }}>
                                                        {{ $insumo->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-6 mb-3 input-form">
                                            <label for="id_equipo" class="form-label">Equipo para la consulta:</label>
                                            <select class="form-control" id="id_equipo" name="id_equipo">
                                                <option value="">Sin equipo asignado</option>
                                                @foreach ($equipo as $equipoMedico)
                                                    <option value="{{ $equipoMedico->id_equipo_medico }}"
                                                        {{ $cita->equipoMedico && $cita->equipoMedico->id_equipo_medico == $equipoMedico->id_equipo_medico ? 'selected' : '' }}>
                                                        {{ $equipoMedico->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <br>

                                    <div class="row justify-content-center">
                                        <div class="col-md-6 text-center">
                                            <button type="submit" class="btn btn-primary">Actualizar Cita</button>
                                        </div>
                                    </div>

                                    <script>
                                        document.addEventListener("DOMContentLoaded", function (){
                                          const fechaInput = document.getElementById('fecha');
                                          const horaInput = document.getElementById('hora');
                                          
                                          const fechaHoraActual = new Date();
                                          const año = fechaHoraActual.getFullYear();
                                          const mes = fechaHoraActual.getMonth() + 1;
                                          const dia = fechaHoraActual.getDate();
                            
                                          const fecha_actual = new Date(año, mes - 1, dia); // Creamos un objeto Date con la fecha actual
                                          console.log(fecha_actual);
                                          fechaInput.min = fecha_actual.toISOString().split('T')[0];
                            
                                          const fecha = fechaInput.min;
                                           
                                          fechaInput.addEventListener('input', function() {
                                            
                                              horaInput.min = this.value === fechaInput.min ? '{{ now()->format("H:i") }}' : '00:00';
                                          });
                                        });
                                      </script>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('layout.footer')
    </main>
@endsection
