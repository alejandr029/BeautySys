<style>
    p {
        font-size: 1.2rem;
        font-weight: 600;
        color: #2d2d2d;
        margin-bottom: 1rem;
    }
</style>

@extends('layout.template')

@section('content')
    <div class="container">
        <div class="container-fluid py-4">
            @php
                $texto = ($proveedor->id_estatus_proveedor == 1) ? 'Deshabilitar' : 'Habilitar';
                $texto2 = ($proveedor->id_estatus_proveedor == 1) ? 'deshabilitará' : 'habilitará';
                $route = ($proveedor->id_estatus_proveedor == 1) ? 'deshabilitarProveedor' : 'habilitarProveedor';
            @endphp

            <div class="card">
                <div class="card-body">
                    <h1 class="mb-4"> {{ $texto }} Proveedor con ID: <b>{{ $proveedor->id_proveedor }}</b></h1>
                    <div class="row">
                        <div class="col-lg-6">
                            <p>Esta acci&oacute;n {{ $texto2 }} el proveedor registrado como: <b>{{$proveedor->nombre_empresarial}}</b>, con direcci&oacute;n en: <b> {{$proveedor->direccion}}</b>.</p>

                            <p>Esto {{ $texto2 }} los insumos relacionados al Proveedor.</p>
                            <form action="{{ route($route, ['id' => $proveedor->id_proveedor]) }}" method="POST" onsubmit="mostrarLoader()">
                                @csrf
                                @method('post') {{-- Agregar este campo para indicar el método DELETE --}}
                                <button type="submit" class="btn btn-danger">{{ $texto }} Proveedor</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
