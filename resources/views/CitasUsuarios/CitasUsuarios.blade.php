@php
use Carbon\Carbon;
@endphp

<style>
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

  .input-form input:focus~label,
  .input-form input:valid~label,
  .input-form textarea:focus~label,
  .input-form textarea:valid~label,
  .input-form select:focus~label,
  .input-form select:valid~label {
    transform: translateY(-95%) scale(0.9);
    padding: 0 .2em;
    color: #000000be;
    left: 10%;
    font-size: 14pt;
    visibility: visible !important;
  }

  .input-form input:hover,
  .input-form textarea:hover,
  .input-form select:hover {
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
    width: 150px;
    /* Ajusta el ancho según lo que necesites */
    height: 150px;
    /* Ajusta la altura según lo que necesites */
    border: 1px solid #ccc;
    /* Agrega un borde para que sea visible */

  }
</style>

@extends('layout.template')

@section('content')
@if(session('success'))
        <div id="notification" class="position-fixed top-0 end-0 p-3" style="z-index: 5">
            <div class="alert alert-success text-white" role="alert">
                <strong>{{ session('success') }}</strong>
            </div>
        </div>
        <script>
            setTimeout(function () {
                var notification = document.getElementById('notification');
                if (notification) {
                    notification.classList.add('show');
                    setTimeout(function () {
                        notification.classList.remove('show');
                        setTimeout(function () {
                            notification.remove();
                        }, 500);
                    }, 2000);
                }
            }, 100);
        </script>
    @endif

    @if (session('error'))
        <div id="error" class="position-fixed top-0 end-0 p-3" style="z-index: 1051;">
            <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
                <strong>{{ session('error') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
        <script>
            setTimeout(function () {
                var notification = document.getElementById('error');
                if (notification) {
                    notification.classList.add('show');
                    setTimeout(function () {
                        notification.classList.remove('show');
                        setTimeout(function () {
                            notification.remove();
                        }, 500);
                    }, 2000);
                }
            }, 100);
        </script>
    @endif


<div class="container">
  <div class="row justify-content-center">
    <div class="col-lg-11">
      <div class="card">
        <div class="card-header">
          <h2 class="card-title">Agendar Nueva Cita</h2>
        </div>

        <div class="card-body">
          <div class="col-lg-11">
            <!-- Formulario para crear una nueva cita -->

            <form action="{{ route('crearUsCita.crear') }}" method="post" class="role-form" onsubmit="mostrarLoader()">
              @csrf
              <div class="mb-3 input-form">
                <label for="nombre" class="form-label">Paciente:</label>
                <input disabled value="{{ $usuarios[0]->primer_nombre}} {{$usuarios[0]->primer_apellido}}" type="text"
                  name="nombre">
              </div>

              <hr class="dark horizontal">

              <div class="mb-3 input-form">
                <label for="correo" class="form-label">Correo:</label>
                <input disabled value="{{$usuarios[0]->correo}}" type="email" name="correo" required>
              </div>

              <hr class="dark horizontal">

              <div class="mb-3 input-form">
                <label for="tipo" class="form-label">Tipo de cita:</label>
                <select class="form-control" id="tipo" name="tipo" required>
                  <option value="" disabled selected>Seleccione el tipo de cita</option>
                  @foreach($tipos as $tip)
                  <option value="{{$tip->id_tipo_cita}}">{{$tip->nombre}}-{{$tip->precio_unitario}}$ </option>
                  @endforeach
                </select>
              </div>

              <hr class="dark horizontal">

              <div class="row">
                <div class="col-md-6 mb-3 input-form">
                  <label for="fecha_cita" class="form-label">Fecha de la cita:</label>
                  <input type="date" class="form-control" id="fecha_cita" name="fecha_cita" min="{{ date('Y-m-d') }}"
                    onchange="()" required>
                </div>

                <div class="col-md-6 mb-3 input-form">
                  <section id="horas">
                    <label id="horal" for="hora" class="form-label">Hora de la cita:</label>
                    <input type="time" class="form-control input-form" id="hora" name="hora" required>
                </div>
              </div>

              <script>
                function validarHora() {
                  var fechaSeleccionada = new Date(document.getElementById('fecha_cita').value);
                  var fechaHoy = new Date();

                  // Establecer la hora actual con al menos una hora de diferencia
                  fechaHoy.setHours(fechaHoy.getHours() + 1);

                  var horaInput = document.getElementById('hora');

                  if (fechaSeleccionada.toDateString() === fechaHoy.toDateString()) {
                    // La fecha seleccionada es hoy, aplicar restricción de hora
                    if (horaInput.value < fechaHoy.toTimeString().substring(0, 5)) {
                      // Restringir la hora si es anterior a la hora actual
                      alert("No puedes seleccionar una hora anterior a la actual del día de hoy.");
                      horaInput.value = ''; // Limpiar el campo de hora
                    }
                  }

                  // Muestra el campo de hora cuando se selecciona una fecha
                  document.getElementById('hora').style.display = 'block';
                  document.getElementById('horal').style.display = 'block';
                  document.getElementById('hora').style.textAling = 'center';
                }
              </script>
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
<br>
@include('layout.footer')
@endsection