@extends('layout.tamplated')

@section('content')
<div class="container-fluid py-4">
    <h1 class="mb-4">Crear Usuario y Asignar Rol</h1>

    <div class="row">
        <div class="col-lg-6">
            <!-- Formulario para crear usuario y asignar rol -->
            <form action="{{ route('user.store') }}" method="POST" class="role-form">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre:</label>
                    <input type="text" class="form-control" name="name" id="name" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Correo Electrónico:</label>
                    <input type="email" class="form-control" name="email" id="email" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña:</label>
                    <input type="password" class="form-control" name="password" id="password" required>
                </div>

                <div class="mb-3">
                    <label for="rol_id" class="form-label">Seleccionar Rol:</label>
                    <select class="form-select" name="rol_id" id="rol_id" required>
                        @foreach($roles as $rol)
                        <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Crear Usuario y Asignar Rol</button>
            </form>
        </div>
    </div>
</div>
@endsection
