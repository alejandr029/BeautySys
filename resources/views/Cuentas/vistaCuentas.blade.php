@extends('layout.template')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card shadow">
                    <div class="card-header">
                        <h4 class="card-title">Detalles de la Cuenta</h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre:</label>
                            <input type="text" class="form-control" id="name" value="{{ $user->name }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Correo Electrónico:</label>
                            <input type="email" class="form-control" id="email" value="{{ $user->email }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="rol" class="form-label">Rol:</label>
                            <input type="text" class="form-control" id="rol"
                                value="{{ $user->roles->pluck('name')->implode(', ') }}" readonly>
                        </div>

                        <div class="text-center mt-4">
                            <a href="{{ route('Cuentas.index') }}" class="btn btn-primary">Volver</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
