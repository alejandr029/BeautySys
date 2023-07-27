<!-- resources/views/asignar_roles/index.blade.php -->
@extends('layout.tamplated')

@section('content')
    <h1>Asignar Roles</h1>

    <!-- Formulario para asignar roles -->
    <form action="{{ route('assign-roles.assign') }}" method="POST">
        @csrf
        <div>
            <label for="usuario_id">Seleccionar Usuario:</label>
            <select name="usuario_id" id="usuario_id">
                @foreach($usuarios as $usuario)
                    <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="rol_id">Seleccionar Rol:</label>
            <select name="rol_id" id="rol_id">
                @foreach($roles as $rol)
                    <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit">Asignar Rol</button>
    </form>
@endsection
