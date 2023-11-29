@php
    use Carbon\Carbon;
@endphp

<style>
    .mainContent {
        background-color: rgb(55, 55, 60);
        width: 40%;
        height: 70%;
        padding-block: 1%;
        align-content: center;
        align-items: center;
        margin: auto;
        flex-direction: column;
        text-align: center;
        align-self: center;
        border-radius: 15px;
        padding-left: 1%;
        padding-right: 1%;
    }

    #izqSev {
        width: 99%;
        height: 100%;
        background-color: #FFF;
        float: left;
        border-radius: 5px;
    }

    #derSev {
        width: 65%;
        height: 100%;
        background-color: rgb(173, 173, 173,0.5);
        float: right;
    }

    .FormBill {
        width: 100%;
        height: auto;
        flex-direction: row;
        font-size: 15px;
    }

    form input {
        border-radius: 15px;
        width: 60%;
        height: 8%;
        margin-top: 4.5%;
        border-color: rgb(228,48,111);
        border-width: 3px;
        color: rgb(123,128,154);
        font-size: 1.08em;
    }
    form select {
        border-radius: 15px;
        width: 60%;
        height: 8%;
        margin-top: 4.5%;
        border-color: rgb(228,48,111);
        border-width: 3px;
        color: rgb(123,128,154);
        font-size: 1.08em;
    }

    form select option{
        border-radius: 15px;
        width: 70%;
        height: 8%;
    }

    form label {
        font-size: 18px;
        margin-top: 5.%;
    }

    form button {
        width: 38%;
        height: 10%;
        border-radius: 15px;
        background-color: rgb(55, 55, 60);
        color: aliceblue;
        border-color: rgb(55, 55, 60);
        margin-top: -95%;
    }

    form button:hover {
        background-color: rgb(90, 90, 90);
        border-color: rgb(90, 90, 90);
        transition: background-color 0.3s ease;
    }

    form input:hover {
        background-color: #EAEAEA;
        transition: background-color 0.3s ease;
        border-color: rrgb(228,48,111,0.5);
    }

    form select:hover {
        background-color: #EAEAEA;
        transition: background-color 0.3s ease;
        border-color: rgb(228,48,111,0.5);
    }

    .encuad1 {
        background-color: rgb(228,48,111);
        height: 10%;
        width: 25%;
        margin-left: 7%;
        margin-top:-5%;
        position: absolute;
        border-radius: 5px;
        align-items: center;
        align-self: center;
        text-align: center;
    }

    .encuad2 {
        align-self: center;
        width: 90%;
        height: 50%;
        background-color: #fff;
        margin-top: 7%;
        margin-left: 5%;
        border-radius: 5px;
    }

    .encuad2 p {

        color:rgb(123,128,154);
        font-size: 23px;
        font-weight: bold;
        text-align:inherit;
        margin-top: 0%;
    }

    .labdis {
        background-color: #EAEAEA;
    }

    #hora {
            display:none;
            margin-left: 3%;
            margin-top: -1%;
            float: right;
        }

    #horal {
            display:none;
            margin-left: 7%;
            /* margin-top: 0%; */
    }

    #horas {
        display: flex;
        /* justify-content: center; */
        text-align:justify;
        flex-direction: row;
        /* background-color: aqua; */
        height: 100%;
    }


</style>

@extends('layout.template')

@section('content')

    <div class="mainContent">
        {{-- <section id="derSev">

            <h1>Calendario de Citas</h1>

            <div id="calendar"></div>

        </section> --}}


        <section id="izqSev">
            <section class="encuad1">
                <section class="encuad2">
                    <p>Agendar nueva cita</p>
                </section>
            </section>

            <form action="{{ route('crearUsCita.crear') }}" method="post" class="FormBill">
                <br><br>
                @csrf
                    <label for="nombre">Nombre:</label>
                    <input disabled value="{{ $usuarios[0]->primer_nombre}} {{$usuarios[0]->primer_apellido}}" type="text" name="nombre" class="labdis">
                    <br>
                    <label for="correo">Correo:</label>
                    <input disabled value="{{$usuarios[0]->correo}}" type="email" name="correo" class="labdis" required>
                    <br>
                    <label for="tipoCita">Tipo de cita:</label>
                    <select id="tipo" name="tipo" required>
                        <option value="0">Selecciona el tipo de cita</option>
                        @foreach($tipos as $tip)
                            <option value="{{$tip->id_tipo_cita}}">{{$tip->nombre}}-{{$tip->precio_unitario}}$ </option>
                        @endforeach
                    </select>
                    <br>
                    <label for="hora">Fecha cita:</label>
                    <input type="date" id="fecha_cita" name="fecha_cita" min="{{ date('Y-m-d') }}" onchange="validarHora()" required>
                    <br><br>
                    <section id="horas" >
                        <label id="horal" for="hora">Hora cita:</label>
                        <input type="time" id="hora" name="hora" required>
                    </section>

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
                            document.getElementById('hora').style.textAling='center';
                        }
                    </script>
                    <br>
                    <button type="submit">Agendar Cita</button>
            </form>
        </section>
    </div>

@include('layout.footer')
@endsection


