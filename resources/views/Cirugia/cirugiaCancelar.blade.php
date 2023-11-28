@php
    use Carbon\Carbon;
@endphp

@extends('layout.template')

@section('content')
    <div class="container">
        <div class="container-fluid py-4">
            <div class="card">
                <div class="card-body">
                    <h1 class="mb-4">Cancelar cirugia</h1>
                    <div class="row">
                        <div class="col-lg-6">
                            <p>¿Estás seguro de que deseas cancelar la consulta con ID <b>{{$cirugia->id_cirugia}}</b>?
                            </p>
                            <p>Esta acción no se puede deshacer.</p>
                            <br>
                            <table class="table align-items-center mb-0">
                                <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7"
                                        style="text-align: center;">ID Cirugia
                                    </th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7"
                                        style="text-align: center;">Nombre de cirugia
                                    </th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7"
                                        style="text-align: center;">Sala
                                    </th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7"
                                        style="text-align: center;">fecha
                                    </th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7"
                                        style="text-align: center;">Hora
                                    </th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7"
                                        style="text-align: center;">Paciente
                                    </th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7"
                                        style="text-align: center;">Personal Encargado
                                    </th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7"
                                        style="text-align: center;">Estatus
                                    </th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7"
                                        style="text-align: center;">ID Consulta
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td style="text-align: center">{{ $cirugia->id_cirugia }}</td>
                                    <td style="text-align: center">{{ $cirugia->nombreCirugia }}</td>
                                    <td style="text-align: center">{{ str_replace('_', ' ',  $cirugia->nombresala) }}</td>
                                    <td class="text-center">{{ Carbon::parse($cirugia->fecha_cirugia)->format('Y-m-d') }}</td>
                                    <td class="text-center">{{ Carbon::parse($cirugia->fecha_cirugia)->format('h:i A') }}</td>
                                    <td style="text-align: center">{{ $cirugia->nombrePaciente }}</td>
                                    <td style="text-align: center">{{ $cirugia->nombrePersonalAcargo }}</td>
                                    <td style="text-align: center">{{ $cirugia->estatusCirugia }}</td>
                                    <td style="text-align: center">{{ $cirugia->id_consulta }}</td>
                                </tr>
                                </tbody>
                            </table>

                            <br>

                            <form action="{{ route('CancelarCirugia', ['id' => $cirugia->id_cirugia]) }}" method="POST"
                                  onsubmit="mostrarLoader()">
                                @csrf
                                @method('put') {{-- Agregar este campo para indicar el método DELETE --}}
                                <button type="submit" class="btn btn-danger">Cancelar cirugia</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
