@php
    use Carbon\Carbon;
@endphp

<style>
    .mainContent {
        background-color: rgb(55, 55, 60);
        width: 99%;
        height: 90%;
        padding-block: 1%;
        align-content: center;
        align-items: center;
        flex-direction: column;
        text-align: center;
        border-radius: 15px;
        padding-left: 1%;
        padding-right: 1%;
    }

    #izqSev {
        width: 35%;
        height: 100%;
        background-color: #FFF;
        float: left;
        border-top-left-radius: 15px;
        border-bottom-left-radius: 15px;
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
        margin-top: 3%;
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


</style>

@extends('layout.template')

@section('content')

    <div class="mainContent">
        <section id="derSev">

            <h1>Calendario de Citas</h1>

            <div id="calendar"></div>

        </section>


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
                    <select required>
                        <option value="0">Selecciona el tipo de cita</option>
                        @foreach($tipos as $tip)
                            <option value="{{$tip->id_tipo_cita}}">{{$tip->nombre}}-{{$tip->precio_unitario}}$ </option>
                        @endforeach
                    </select>
                    <br>
                    <label for="fecha_cita">Fecha:</label>
                    <input type="date" name="fecha_cita" min="{{ date('Y-m-d') }}" required>
                    <br>
                    <label for="hora">Hora:</label>
                    <input type="time" id="hora" name="hora" min="{{ date('H:i') }}" required>
                    <br>
                    <button type="submit">Agendar Cita</button>
            </form>
        </section>
    </div>

@include('layout.footer')
@endsection


