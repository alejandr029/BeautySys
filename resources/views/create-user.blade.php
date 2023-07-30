<style>
    .input-form {
        position: relative;
        font-family: Arial, Helvetica, sans-serif;
    }

    .input-form input,
    .input-form textarea,
    .input-form select {
        border: solid 1.9px #9e9e9e;
        border-radius: 0.6rem;
        background: none;
        padding: 1rem;
        font-size: 1rem;
        color: #000000;
        transition: border 150ms cubic-bezier(0.4, 0, 0.2, 1);
        width: 100%;
    }

    .textUser {
        left: 15px;
        color: #666666;
        pointer-events: none;
    }

    .input-form input:focus,
    .input-form input:valid,
    .input-form textarea:focus,
    .input-form textarea:valid,
    .input-form select:focus,
    .input-form select:valid {
        outline: none;
        box-shadow: 1px 2px 5px rgba(133, 133, 133, 0.523);
        background-image: linear-gradient(to top, rgba(182, 182, 182, 0.199), rgba(252, 252, 252, 0));
        transition: background 4s ease-in-out;
    }

    .input-form input:focus~label,
    .input-form input:valid~label,
    .input-form textarea:focus~label,
    .input-form textarea:valid~label,
    .input-form select:focus~label,
    .input-form select:valid~label {
        transform: translateY(-95%) scale(0.9);
        padding: 0 .2em;
        color: #000000be;
        left: 10%;
        font-size: 14pt;
        visibility: visible !important;
    }

    .input-form input:hover,
    .input-form textarea:hover,
    .input-form select:hover {
        border: solid 1.9px #000002;
        transform: scale(1.03);
        box-shadow: 1px 1px 5px rgba(133, 133, 133, 0.523);
        transition: border-color 1s ease-in-out;
    }
</style>

@extends('layout.tamplated')

@section('content')
    <div class="container-fluid py-4">
        <h1 class="mb-4">Creación de Cuentas</h1>

        <div class="row">
            <div class="col-lg-6">
                <!-- Formulario para crear cuentas de usuario -->
                <form action="{{ route('user.store') }}" method="POST" class="role-form">
                    @csrf
                    <div class="mb-3 input-form">
                        <label for="name" class="textUser">Nombre:</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>

                    <div class="mb-3 input-form">
                        <label for="email" class="textUser">Correo electrónico:</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>

                    <div class="mb-3 input-form">
                        <label for="password" class="textUser">Contraseña:</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>

                    <div class="mb-3 input-form">
                        <label for="rol_id" class="textUser">Seleccionar Rol:</label>
                        <select class="form-select" name="rol_id" id="rol_id">
                            @foreach ($roles as $rol)
                                <option value="{{ $rol->id }}" {{ $rol->name === 'user' ? 'selected' : '' }}>
                                    {{ $rol->name }}</option>
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
