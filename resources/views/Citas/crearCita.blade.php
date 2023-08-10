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

.input-form input:focus ~ label, .input-form input:valid ~ label,
.input-form textarea:focus ~ label, .input-form textarea:valid ~ label,
.input-form select:focus ~ label, .input-form select:valid ~ label {
  transform: translateY(-95%) scale(0.9);
  padding: 0 .2em;
  color: #000000be;
  left: 10%;
  font-size: 14pt;
  visibility: visible!important;
}

.input-form input:hover, .input-form textarea:hover, .input-form select:hover {
  border: solid 1.9px #000002;
  transform: scale(1.03);
  box-shadow: 1px 1px 5px rgba(133, 133, 133, 0.523);
  transition: border-color 1s ease-in-out;
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
@if (session('success'))
        <div class="position-fixed top-0 end-0 p-3" style="z-index: 1051;">
            <div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
                <strong>{{ session('success') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="position-fixed top-0 end-0 p-3" style="z-index: 1051;">
            <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
                <strong>{{ session('error') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

    <script>
        // Mostrar la notificación lentamente
        setTimeout(function() {
            var notification = document.getElementById('notification');
            if (notification) {
                notification.classList.add('show');
                // Ocultar y eliminar la notificación después de 2 segundos
                setTimeout(function() {
                    notification.classList.remove('show');
                    setTimeout(function() {
                        notification.remove();
                    }, 500); // Esperar el tiempo de la transición (0.5s)
                }, 2000);
            }
        }, 100); // Agregar un pequeño retraso antes de mostrar la notificación (opcional)
    </script>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-11">
        <div class="card">
          <div class="card-header">
            <h2 class="card-title">Crear Nueva Cita</h2>
          </div>

          <div class="card-body">
            <div class="col-lg-11">
              <!-- Formulario para crear una nueva cita -->
              <form action="{{ route('Citas.store') }}" method="post" class="role-form">
                @csrf

                    <div class="mb-3 input-form">
                        <label for="id_paciente" class="form-label">Paciente:</label>
                        <select class="form-control" id="id_paciente" name="id_paciente" required>
                            @foreach($pacientes as $paciente)
                            <option value="{{ $paciente->id_paciente }}" data-paciente="{{ json_encode($paciente) }}">ID: {{ $paciente->id_paciente }} - Nombre: {{ $paciente->primer_nombre}} {{ $paciente->primer_apellido}} </option>
                            @endforeach
                        </select>
                    </div>

                <hr class="dark horizontal">

                <div class="row">
                    <div class="col-md-6 mb-3 input-form">
                        <label for="hora_cita" class="form-label">Hora de la cita:</label>
                        <input type="time" class="form-control input-form" id="hora_cita" name="hora_cita"
                            required min="09:00" max="17:00">
                    </div>

                  <div class="col-md-6 mb-3 input-form">
                    <label for="fecha_cita" class="form-label">Fecha de la cita:</label>
                    <input type="date" class="form-control" id="fecha_cita" name="fecha_cita" required>
                  </div>
                </div>

                <hr class="dark horizontal">

                <div class="row">
                    <div class="col-md-6 mb-3 input-form">
                        <label for="id_sala" class="form-label">Sala:</label>
                        <select class="form-control" id="id_sala" name="id_sala" onchange="updateEstadoSalaValue(this)" required>
                            @foreach($sala as $item)
                            <option value="{{ $item->id_sala }}" data-estado-sala="{{ $item->status }}">
                                {{ str_replace('_', ' ', $item->nombre) }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3 input-form">
                        <label for="estado_sala" class="form-label">Estado de la sala:</label>
                        <input class="form-control" id="estado_sala" name="estado_sala" value="" placeholder="Seleccione una sala" readonly>
                    </div>
                </div>
                <script>
                    function updateEstadoSalaValue(selectElement) {
                        var estadoSalaInput = document.getElementById('estado_sala');
                        var selectedOption = selectElement.options[selectElement.selectedIndex];
                        var estadoSalaValue = selectedOption.getAttribute('data-estado-sala');

                        estadoSalaInput.value = estadoSalaValue;
                    }
                </script>


                <br>
                <hr class="dark horizontal">

                <div class="row">
                    <div class="col-md-6 mb-3 input-form">
                        <label for="id_estado_cita" class="form-label">Estado de la cita:</label>
                        <select class="form-control" id="id_estado_cita" name="id_estado_cita" required>
                            @foreach($estadoCita as $estado)
                            <option value="{{ $estado->id_estado_cita }}">{{ $estado->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3 input-form">
                        <label for="id_tipo_cita" class="form-label">Tipo de cita:</label>
                        <select class="form-control" id="id_tipo_cita" name="id_tipo_cita" required>
                            @foreach($tipoCita as $tipo)
                            <option value="{{ $tipo->id_tipo_cita }}">{{ $tipo->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <hr class="dark horizontal">

                <div class="mb-3 input-form">
                  <label for="id_personal" class="form-label">Doctor que atenderá:</label>
                  <select class="form-control" id="id_personal" name="id_personal" required>
                    @foreach($personal as $p)
                    <option value="{{ $p->id_personal }}">{{ $p->primer_nombre }} {{ $p->primer_apellido }}</option>
                    @endforeach
                  </select>
                </div>
                <br>
                <hr class="dark horizontal">

                <div class="row">
                    <div class="col-md-6 mb-3 input-form">
                        <label for="id_insumo" class="form-label">Insumos para la consulta:</label>
                        <select class="form-control" id="id_insumo" name="id_insumo">
                            <option value="">Sin insumos asignados</option>
                            @foreach($insumos as $insumo)
                            <option value="{{ $insumo->id_insumo }}">{{ $insumo->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3 input-form">
                        <label for="id_equipo" class="form-label">Equipo para la consulta:</label>
                        <select class="form-control" id="id_equipo" name="id_equipo">
                            <option value="">Sin equipo asignado</option>
                            @foreach($equipo as $eq)
                            <option value="{{ $eq->id_equipo_medico }}">{{ $eq->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <br>

                <div class="row justify-content-center">
                    <div class="col-md-6 text-center">
                        <button type="submit" class="btn btn-primary">Crear Cita</button>
                    </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
        const idPacienteSelect = document.getElementById("id_paciente");
        const nombrePacienteInput = document.getElementById("nombre_paciente");

        idPacienteSelect.addEventListener("change", function() {
            // Obtener el nombre del paciente asociado al ID seleccionado
            const selectedOption = this.options[this.selectedIndex];
            const pacienteData = JSON.parse(selectedOption.getAttribute('data-paciente'));
            const nombrePaciente = pacienteData.primer_nombre + " " + pacienteData.primer_apellido;

            // Actualizar el valor del input de nombre del paciente
            nombrePacienteInput.value = nombrePaciente;
        });
    });
    </script>

  @include('layout.footer')
</main>
@endsection
