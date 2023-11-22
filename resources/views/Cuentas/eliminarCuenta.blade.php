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
        <div class="card">
            <div class="card-body">
                <h1 class="mb-4">Eliminar Cuenta con ID: <b>{{ $user->id }}</b></h1>
                <div class="row">
                    <div class="col-lg-6">
                        <p>¿Estás seguro de que deseas eliminar la cuenta con email <b>{{$user->email}}</b>?</p>
                        <form action="{{ route('Cuentas.destroy', ['id' => $user->id]) }}" method="POST" onsubmit="mostrarLoader()">
                            @csrf
                            @method('post') {{-- Agregar este campo para indicar el método DELETE --}}
                            <button type="submit" class="btn btn-danger">Eliminar Cuenta</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
