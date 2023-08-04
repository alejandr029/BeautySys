@php
    use Carbon\Carbon;
@endphp

<style>
    .table td,
    .table th {
        white-space: normal!important;
    }

    .avatar-sm-new {
        width: 75px !important;
        height: 75px !important;
        font-size: 0.875rem;
    }
    .crear {
    border: 2px solid #24b4fb;
    background-color: #24b4fb;
    border-radius: 0.9em;
    padding: 0.8em 1.2em 0.8em 1em;
    transition: all ease-in-out 0.2s;
    font-size: 14px;
    }

    .crear span {
    display: flex;
    justify-content: center;
    align-items: center;
    color: #fff;
    font-weight: 600;
    }

    .crear:hover {
    background-color: #0071e2;
    }
    .notification {
        padding: 1rem;
        background-color: #28a745;
        color: #fff;
        border-radius: 5px;
        transition: opacity 0.5s, transform 0.5s;
        opacity: 0;
        transform: translateY(-20px);
    }

    .notification.show {
        /* Estilo para mostrar la notificación */
        opacity: 1;
        transform: translateY(0);
    }

    .radio-inputs {
  position: relative;
  display: flex;
  flex-wrap: wrap;
  border-radius: 0.5rem;
  background-color: #EC407A ;
  box-sizing: border-box;
  box-shadow: 0 0 0px 1px rgba(0, 0, 0, 0.06);
  padding: 0.25rem;
  width: 300px;
  font-size: 14px;
  margin-bottom: 20px;
}

.radio-inputs .radio {
  flex: 1 1 auto;
  text-align: center;
}

.radio-inputs .radio input {
  display: none;
}

.radio-inputs .radio .name {
  display: flex;
  cursor: pointer;
  align-items: center;
  justify-content: center;
  border-radius: 0.5rem;
  border: none;
  padding: .5rem 0;
  color: #2d2d2d;
  transition: all .15s ease-in-out;
}

.radio-inputs .radio input:checked + .name {
  background-color: #fff;
  font-weight: 600;
}


</style>

@extends('layout.template')

@section('content')
    @if(session('success'))
    <div id="notification" class="position-fixed top-0 end-0 p-3">
        <div class="alert alert-success text-white" role="alert">
            <strong>{{ session('success') }}</strong>
        </div>
    </div>
    @endif
    @if(session('error'))
    <div id="notification" class="position-fixed top-0 end-0 p-3">
        <div class="alert alert-danger text-white" role="alert">
            <strong>{{ session('error') }}</strong>
        </div>
    </div>
    @endif
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
    <div class="container-fluid py-4">
        <div id="cuentasTable" class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center">
                            <h6 class="text-white text-capitalize ps-3">Lista de usuarios</h6>
                            <button class="crear" style="margin-right: 15px;" onclick="window.location.href='{{ route('Cuentas.crear') }}'">
                                <a>
                                    <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"></path><path fill="currentColor" d="M11 11V5h2v6h6v2h-6v6h-2v-6H5v-2z"></path></svg> Create
                                    </span>
                                </a>
                            </button>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7" style="text-align: center;">ID</th>
                                        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7" style="text-align: center;">Nombre</th>
                                        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7" style="text-align: center;">Email</th>
                                        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7" style="text-align: center;">Rol</th>
                                        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7" style="text-align: center;">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                    <tr>
                                        <td style="text-align: center">{{ $user->id }}</td>
                                        <td style="text-align: center;">{{ $user->name }}</td>
                                        <td style="text-align: center;">{{ $user->email }}</td>
                                        <td style="text-align: center;">
                                            @foreach($user->roles as $role)
                                                {{ $role->name }}
                                            @endforeach
                                        </td>
                                        <td class="td-actions">
                                            <div role="group">
                                                <button type="button" class="btn btn-info" style="margin:0rem 0.5rem 0.5rem 0rem; flex:none;" onclick="window.location.href='{{ route('Cuentas.visualizar', $user->id ) }}'">
                                                    <i class="material-icons">visibility</i>
                                                </button>
                                                <button type="button" class="btn btn-warning" style="margin:0rem 0.5rem 0.5rem 0rem; flex:none;" onclick="window.location.href='{{ route('Cuentas.edit', ['id' => $user->id]) }}'">
                                                    <i class="material-icons">edit</i>
                                                </button>
                                                <form action="{{ route('Cuentas.eliminar', ['id' => $user->id]) }}" method="POST">
                                                    @csrf
                                                    @method('get')
                                                    <button type="submit" class="btn btn-danger">Eliminar Cuenta</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    @include('layout.footer')
@endsection
