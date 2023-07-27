@extends('layout.tamplated')

@section('content')
<div class="container-fluid py-4">
    <h1 class="mb-4">Asignar Roles</h1>

    <div class="row">
        <div class="col-lg-6">
            <!-- Formulario para asignar roles -->
            <form action="{{ route('assign-roles.assign') }}" method="POST" class="role-form">
                @csrf
                <div class="mb-3">
                    <label for="usuario_id" class="form-label">Seleccionar Usuario:</label>
                    <select class="form-select" name="usuario_id" id="usuario_id">
                        @foreach($usuarios as $usuario)
                        <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="rol_id" class="form-label">Seleccionar Rol:</label>
                    <select class="form-select" name="rol_id" id="rol_id">
                        @foreach($roles as $rol)
                        <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Asignar Rol</button>
            </form>
        </div>
    </div>
</div>
@endsection
