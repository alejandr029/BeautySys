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

@extends('layout.template')

@section('content')
    <div class="container-fluid py-4">
        <h1 class="mb-4">Asignar Roles</h1>

        <div class="row">
            <div class="col-lg-6">
                <!-- Formulario para asignar roles -->
                <form action="{{ route('asignar-roles.assign') }}" method="POST" class="role-form">
                    @csrf
                    <div class="mb-3 input-form">
                        <label for="usuario_id" class="textUser">Seleccionar Usuario:</label>
                        <select class="form-select" name="usuario_id" id="usuario_id">
                            @foreach ($usuarios as $usuario)
                                <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                            @endforeach
                        </select>
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

                    <button type="submit" class="btn btn-primary">Asignar Rol</button>
                </form>
            </div>
        </div>
        <!-- Mensaje de éxito al crear usuario -->
        @if (Session::has('success'))
            <div id="notification" class="position-fixed top-0 end-0 p-3">
                <div class="alert alert-success text-white" role="alert">
                    <strong>{{ Session::get('success') }}</strong>
                </div>
            </div>
            <script>
                // Mostrar la notificación lentamente
                setTimeout(function() {
                    var notification = document.getElementById('notification');
                    if (notification) {
                        notification.classList.add('show');
                        // Ocultar y eliminar la notificación después de 2 segundos
                        setTimeout(function() {
                            notification.classList.remove('show');
                            setTimeout(function() {
                                notification.remove();
                            }, 500); // Esperar el tiempo de la transición (0.5s)
                        }, 2000);
                    }
                }, 100); // Agregar un pequeño retraso antes de mostrar la notificación (opcional)
            </script>
        @endif
    </div>
@endsection
