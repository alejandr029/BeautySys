@php
    use Carbon\Carbon;
@endphp

<style>
    .table td,
    .table th {
        white-space: normal !important;
    }

    .avatar-sm-new {
        width: 75px !important;
        height: 75px !important;
        font-size: 0.875rem;
    }

    .crear {
        border: 2px solid #24b4fb;
        background-color: #24b4fb;
        border-radius: 0.9em;
        padding: 0.8em 1.2em 0.8em 1em;
        transition: all ease-in-out 0.2s;
        font-size: 14px;
    }

    .crear span {
        display: flex;
        justify-content: center;
        align-items: center;
        color: #fff;
        font-weight: 600;
    }

    .crear:hover {
        background-color: #0071e2;
    }

    .notification {
        padding: 1rem;
        background-color: #28a745;
        color: #fff;
        border-radius: 5px;
        transition: opacity 0.5s, transform 0.5s;
        opacity: 0;
        transform: translateY(-20px);
    }

    .notification.show {
        /* Estilo para mostrar la notificación */
        opacity: 1;
        transform: translateY(0);
    }

    .radio-inputs {
        position: relative;
        display: flex;
        flex-wrap: wrap;
        border-radius: 0.5rem;
        background-color: #EC407A;
        box-sizing: border-box;
        box-shadow: 0 0 0px 1px rgba(0, 0, 0, 0.06);
        padding: 0.25rem;
        width: 300px;
        font-size: 14px;
        margin-bottom: 20px;
    }

    .radio-inputs .radio {
        flex: 1 1 auto;
        text-align: center;
    }

    .radio-inputs .radio input {
        display: none;
    }

    .radio-inputs .radio .name {
        display: flex;
        cursor: pointer;
        align-items: center;
        justify-content: center;
        border-radius: 0.5rem;
        border: none;
        padding: .5rem 0;
        color: #2d2d2d;
        transition: all .15s ease-in-out;
    }

    .radio-inputs .radio input:checked+.name {
        background-color: #fff;
        font-weight: 600;
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

    <div class="container-fluid py-4">
        <div id="citasTable" class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center">
                            <h6 class="text-white text-capitalize ps-3">Lista Consultas</h6>
                            <button class="crear" style="margin-right: 15px;"
                                onclick="window.location.href=">
                                <a>
                                    <span>Crear <i class="material-icons">add</i></span>
                                </a>
                            </button>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center text-secondary text-xs font-weight-bolder opacity-7">ID</th>
                                        <th class="text-center text-secondary text-xs font-weight-bolder opacity-7">Fecha</th>
                                        <th class="text-center text-secondary text-xs font-weight-bolder opacity-7">Hora</th>
                                        <th class="text-center text-secondary text-xs font-weight-bolder opacity-7">Estado</th>
                                        <th class="text-center text-secondary text-xs font-weight-bolder opacity-7">Sala</th>
                                        <th class="text-center text-secondary text-xs font-weight-bolder opacity-7">Paciente</th>
                                        <th class="text-center text-secondary text-xs font-weight-bolder opacity-7">Tipo de Cita</th>
                                        <th class="text-center text-secondary text-xs font-weight-bolder opacity-7">Doctor</th>
                                        <th class="text-center text-secondary text-xs font-weight-bolder opacity-7">Acciones</th>
                                    </tr>
                                </thead>
                                {{-- <tbody>
                                    @foreach ($citas as $cita)
                                        <tr>
                                            <td class="text-center">{{ $cita->id_cita }}</td>
                                            <td class="text-center">{{ Carbon::parse($cita->fecha_cita)->format('Y-m-d') }}</td>
                                            <td class="text-center">{{ Carbon::parse($cita->hora_cita)->format('h:i A') }}</td>
                                            <td class="text-center">{{ $cita->estadoCita->nombre }}</td>
                                            <td class="text-center">{{ $cita->id_sala }}</td>
                                            <!-- PARA MOSTRAR LOS DATOS, ES DE ESTA MANERA, LA VARIABLE DEL FOREACH, LUEGO SI ESTA EN LA TABLA PRINCIPAL SE COLOCA EL NOMBREM SINO SE USA EL NOMBRE DE LA FUNCION QUE TENGAS EN EL MODELO
                                            PARA ACCEDER A LA TABLA DE PACIENTE Y YA DENTRO DE ESTA COLOCAS EL NOMBRE QUE BUSCAS -->
                                            <td class="text-center">{{ $cita->paciente->primer_nombre }} {{ $cita->paciente->primer_apellido }}</td>
                                            <td class="text-center">{{ $cita->id_tipo_cita }}</td>
                                            <td class="text-center">{{ $cita->personal->primer_nombre }} {{ $cita->personal->primer_apellido }}</td>
                                            <td class="td-actions">
                                                <div role="group">
                                                    <button type="button" class="btn btn-info" style="margin:0rem 0.5rem 0.5rem 0rem; flex:none;" >
                                                        <i class="material-icons">visibility</i>
                                                    </button>
                                                    <button type="button" class="btn btn-warning" style="margin:0rem 0.5rem 0.5rem 0rem; flex:none;" >
                                                        <i class="material-icons">edit</i>
                                                    </button>
                                                    <form action="" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Eliminar cosulta</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody> --}}
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="my-custom-paginator" style="display: flex; justify-content: flex-end; margin-right: 25px;">
                <!-- Aquí el paginador para las citas -->
                <!-- Puedes usar el mismo paginador que se usó en la tabla de Insumos o Equipo Médico -->
            </div>
        </div>
        {{-- FIN DE TABLA DE CITAS --}}
    </div>
    @include('layout.footer')


@endsection