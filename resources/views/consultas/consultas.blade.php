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

    {{-- NOTIFICAICON --}}
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
    {{-- FIN DE NOTIFICACION --}}

    <div class="container-fluid py-4">
        <div id="citasTable" class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center">
                            <h6 class="text-white text-capitalize ps-3">Lista Consultas</h6>
                            <button class="crear" style="margin-right: 15px;background-color: #F2F2F2; border-color:#F2F2F2; "
                                onclick="window.location.href='{{ route('crearConsulta')}}'; mostrarLoader();">
                                <a>
                                    <span style="color: #0D0D0D;">Crear <i class="material-icons">add</i></span>
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
                                        <th class="text-center text-secondary text-xs font-weight-bolder opacity-7">FECHA</th>
                                        <th class="text-center text-secondary text-xs font-weight-bolder opacity-7">HORA</th>
                                        <th class="text-center text-secondary text-xs font-weight-bolder opacity-7">PACIENTE</th>
                                        <th class="text-center text-secondary text-xs font-weight-bolder opacity-7">PERSONAL ENCARGADO</th>
                                        <th class="text-center text-secondary text-xs font-weight-bolder opacity-7">ESTATUS</th>
                                        <th class="text-center text-secondary text-xs font-weight-bolder opacity-7">NOMBRE DE LA SALA</th>
                                        <th class="text-center text-secondary text-xs font-weight-bolder opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($consultas as $consulta)
                                        <tr>
                                            <td class="text-center">{{ $consulta->id }}</td>
                                            <td class="text-center">{{ Carbon::parse($consulta->fecha)->format('Y-m-d') }}</td>
                                            <td class="text-center">{{ Carbon::parse($consulta->fecha)->format('h:i A') }}</td>
                                            <td class="text-center">{{ $consulta->nombre_ps}}</td>
                                            <td class="text-center">{{ $consulta->nombre_pp }}</td>
                                            <td class="text-center">{{ $consulta->estatus }}</td>
                                            <td class="text-center">{{ str_replace('_', ' ', $consulta->nombre_sala) }}</td>

                                            <td class="td-actions">
                                                <div role="group">

                                                    <button type="button" class="btn btn-info"
                                                    style="margin:0rem 0.5rem 0.5rem 0rem; flex:none;" onclick="window.location.href='{{ route('consultavista', ['id'=> $consulta->id]) }}'; mostrarLoader();"><i class="material-icons">visibility</i></button>

                                                    <button type="button" class="btn btn-warning" style="margin:0rem 0.5rem 0.5rem 0rem; flex:none;" onclick="window.location.href='{{ route('ConsultaActualizarVista', ['id'=> $consulta->id]) }}'; mostrarLoader();">
                                                        <i class="material-icons">edit</i>
                                                    </button>

                                                    <form method="POST" action="{{ route('CancelarConsultaForm', ['id' => $consulta->id]) }}" @if($consulta->id_status_consulta == '3'||  $consulta->id_status_consulta == '4') @style('display:none;') @endif onsubmit="mostrarLoader()">
                                                        @csrf
                                                        @method('get')
                                                        <button type="submit" class="btn btn-danger" style="margin:0rem 0.5rem 0.5rem 0rem; flex:none;">
                                                            <i class="material-icons">block</i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="my-custom-paginator" style="display: flex; justify-content: flex-end; margin-right: 25px;">
                <!-- Agrega aquí tus estilos personalizados para el paginador -->
                <ul class="pagination">
                    <li class="page-item {{ $consultas->currentPage() === 1 ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $consultas->url(1) }}" aria-label="First" onclick="mostrarLoader()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8.354 1.646a.5.5 0 0 1 0 .708L2.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                                <path fill-rule="evenodd" d="M12.354 1.646a.5.5 0 0 1 0 .708L6.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                              </svg>
                        </a>
                    </li>
                    <li class="page-item {{ $consultas->previousPageUrl() ? '' : 'disabled' }}">
                        <a class="page-link" href="{{ $consultas->previousPageUrl() }}" aria-label="Previous" onclick="mostrarLoader()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                            </svg>
                        </a>
                    </li>

                    <!-- Aquí puedes iterar sobre las páginas disponibles -->
                    @php
                        // Calcular el rango de páginas a mostrar
                        $currentPage = $consultas->currentPage();
                        $startPage = max($currentPage - 1, 1);
                        $endPage = min($currentPage + 1, $consultas->lastPage());
                    @endphp

                    @for ($i = $startPage; $i <= $endPage; $i++)
                        <li class="page-item {{ $i == $consultas->currentPage() ? 'active' : '' }}">
                            <a class="page-link" href="{{ $consultas->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor

                    <li class="page-item {{ $consultas->nextPageUrl() ? '' : 'disabled' }}">
                        <a class="page-link" href="{{ $consultas->nextPageUrl() }}" aria-label="Next" onclick="mostrarLoader()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                            </svg>
                        </a>
                    </li>
                    <li class="page-item {{ $consultas->currentPage() === $consultas->lastPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $consultas->url($consultas->lastPage()) }}" aria-label="Last" onclick="mostrarLoader()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z"/>
                                <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z"/>
                            </svg>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        {{-- FIN DE TABLA DE CITAS --}}
    </div>
    @include('layout.footer')


@endsection
