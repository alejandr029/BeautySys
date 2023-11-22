@extends('layout.template')

@section('content')
    <div class="container">
        <div class="container-fluid py-4">
            <div class="card">
                <div class="card-body">
                    <h1 class="mb-4">Cancelar consulta</h1>
                    <div class="row">
                        <div class="col-lg-6">
                            <p>¿Estás seguro de que deseas cancelar la consulta con ID <b>{{$consulta->id}}</b> para el usuario <b>{{ $consulta->nombre_ps }}</b>?</p>
                            <p>Esta acción no se puede deshacer.</p>

                            <br>

                            <form action="{{ route('CancelarConsulta', ['id' => $consulta->id]) }}" method="POST" onsubmit="mostrarLoader()">
                                @csrf
                                @method('put') {{-- Agregar este campo para indicar el método DELETE --}}
                                <button type="submit" class="btn btn-danger">Cancelar consulta</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
