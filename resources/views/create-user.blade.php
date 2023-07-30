@extends('layout.tamplated')

@section('content')
<div class="container-fluid py-4">
    <h1 class="mb-4">Creación de Cuentas</h1>

    <div class="row">
        <div class="col-lg-6">
            <!-- Formulario para crear cuentas de usuario -->
            <form action="{{ route('user.store') }}" method="POST" class="role-form">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre:</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Correo electrónico:</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña:</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="rol_id" class="form-label">Seleccionar Rol:</label>
                    <select class="form-select" name="rol_id" id="rol_id">
                        @foreach($roles as $rol)
                        <option value="{{ $rol->id }}" {{ $rol->name === 'user' ? 'selected' : '' }}>{{ $rol->name }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Crear Cuenta</button>
            </form>
        </div>
    </div>

    <!-- Mensaje de éxito al crear usuario -->
    @if (Session::has('success'))
    <div class="alert alert-success mt-2">
        {{ Session::get('success') }}
    </div>
    @endif
</div>
@endsection
