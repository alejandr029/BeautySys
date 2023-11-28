@php
    use Carbon\Carbon;
@endphp

<style>
    p {
        font-size: 1.2rem;
        font-weight: 600;
        color: #2d2d2d;
        margin-bottom: 1rem;
    }

    .table td,
    .table th {
        white-space: normal!important;
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
        background-color: #EC407A ;
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

    .radio-inputs .radio input:checked + .name {
        background-color: #fff;
        font-weight: 600;
    }
</style>

@extends('layout.template')

@section('content')
    <div class="container">
        <div class="container-fluid py-4">
            @php
                $texto = ($insumo->id_estatus_insumos == 1) ? 'Deshabilitar' : 'Habilitar';
                $texto2 = ($insumo->id_estatus_insumos == 1) ? 'deshabilitará' : 'habilitará';
                $route = ($insumo->id_estatus_insumos == 1) ? 'insumos.deshabilitar' : 'insumos.habilitar';
            @endphp

            <div class="card">
                <div class="card-body">
                    <h1 class="mb-4"> {{ $texto }} Insumo con ID: <b>{{ $insumo->id_insumos }}</b></h1>
                    <div class="row">
                        <div class="col-lg-6">
                            <p>Esta acción {{ $texto2 }} el insumo registrado como: <b>{{$insumo->nombre}}</b>.</p>
                        </div>
                    </div>

                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7" style="text-align: center;">ID</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7" style="text-align: center;">Imagen</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7" style="text-align: center;">Nombre</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7" style="text-align: center;">Fecha Adquisición</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7" style="text-align: center;">Fecha Vencimiento</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7" style="text-align: center;">Cantidad</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td style="text-align: center">{{ $insumo->id_insumos }}</td>
                                    <td><img src="{{ $insumo->imagen }}" class="avatar-sm-new me-3 border-radius-lg" alt="{{ $insumo->nombre }}" style="margin: auto;"></td>
                                    <td style="text-align: center; width: 200px">{{ $insumo->nombre }}</td>
                                    <td style="text-align: center; width: 200px">{{ Carbon::parse($insumo->fecha_adquisicion)->format('Y-m-d') }}</td>
                                    <td style="text-align: center; width: 200px">{{ Carbon::parse($insumo->fecha_vencimiento)->format('Y-m-d') }}</td>
                                    <td style="text-align: center; width: 100px">{{ $insumo->cantidad }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <br>
                    <br>

                    <div class="row justify-content-center align-items-center">
                        <div class="col-lg-6 text-center">
                            <form action="{{ route($route, ['id' => $insumo->id_insumos]) }}" method="POST" onsubmit="mostrarLoader()">
                                @csrf
                                @method('post') {{-- Agregar este campo para indicar el método DELETE --}}
                                <button type="submit" class="btn btn-danger">{{ $texto }} Insumo</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection
