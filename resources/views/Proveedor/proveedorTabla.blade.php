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
    {{-- NOTIFICAICON --}}
    @if(session('success'))
        <div id="notification" class="position-fixed top-0 end-0 p-3" style="z-index: 5">
            <div class="alert alert-success text-white" role="alert">
                <strong>{{ session('success') }}</strong>
            </div>
        </div>
        <script>
            setTimeout(function () {
                var notification = document.getElementById('notification');
                if (notification) {
                    notification.classList.add('show');
                    setTimeout(function () {
                        notification.classList.remove('show');
                        setTimeout(function () {
                            notification.remove();
                        }, 500);
                    }, 2000);
                }
            }, 100);
        </script>
    @endif

    @if (session('error'))
        <div id="error" class="position-fixed top-0 end-0 p-3" style="z-index: 1051;">
            <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
                <strong>{{ session('error') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
        <script>
            setTimeout(function () {
                var notification = document.getElementById('error');
                if (notification) {
                    notification.classList.add('show');
                    setTimeout(function () {
                        notification.classList.remove('show');
                        setTimeout(function () {
                            notification.remove();
                        }, 500);
                    }, 2000);
                }
            }, 100);
        </script>
    @endif

        <div id="ProveedoresTable" class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center">
                            <h6 class="text-white text-capitalize ps-3">Proveedores</h6>
                            <button class="crear" style="margin-right: 15px; background-color: #F2F2F2; border-color:#F2F2F2;" onclick="window.location.href='{{ route('vistaCrearProveedor') }}'; mostrarLoader();">
                                <a>
                                    <span style="color: #0D0D0D;">
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
                                        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7" style="text-align: center;">Imagen</th>
                                        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7" style="text-align: center;">Nombre del proveedor</th>
                                        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7" style="text-align: center;">Telefono</th>
                                        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7" style="text-align: center;">Nombre del contacto</th>
                                        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7" style="text-align: center;">Direccion</th>
                                        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7" style="text-align: center;">Estatus</th>
                                        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7" style="text-align: center;">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($Proveedor as $proveedor)
                                    <tr>
                                        <td style="text-align: center">{{ $proveedor->id_proveedor }}</td>
                                        <td><img src="{{ $proveedor->logo }}" class="avatar avatar-sm-new me-3 border-radius-lg" alt="imagen" style="display: block; margin: auto;"></td>
                                        <td style="text-align: center; width: 200px">{{ $proveedor->nombre_empresarial }}</td>
                                        <td style="text-align: center; width: 200px">{{ $proveedor->telefono }}</td>
                                        <td style="text-align: center; width: 200px">{{ $proveedor->contacto }}</td>
                                        <td style="text-align: center; width: 250px">{{ $proveedor->direccion }}</td>
                                        <td style="text-align: center; width: 150px">{{ $proveedor->estatus }}</td>
                                        <td class="td-actions">
                                            <div role="group">
                                                <button type="button" class="btn btn-info"
                                                    style="margin:0rem 0.5rem 0.5rem 0rem; flex:none;" onclick="window.location.href='{{ route('vistaProveedor', ['id' => $proveedor->id_proveedor]) }}'; mostrarLoader();" ><i class="material-icons">visibility</i></button>
                                                <button type="button" class="btn btn-warning"
                                                    style="margin:0rem 0.5rem 0.5rem 0rem; flex:none;" onclick="window.location.href='{{ route('vistActualizarProveedor', ['id' => $proveedor->id_proveedor]) }}'; mostrarLoader();"><i class="material-icons">edit</i></button>

                                                <form method="POST" action="{{ route('cambiarEstadoProveedor', ['id' => $proveedor->id_proveedor]) }}" onsubmit="mostrarLoader()">
                                                   @csrf
                                                    @method('get')
                                                        @if ($proveedor->estatus == 'Activo')
                                                            <button type="submit" class="btn btn-danger" style="margin:0rem 0.5rem 0.5rem 0rem; flex:none;">
                                                            <i class="fas fa-lock"></i>
                                                            </button>
                                                        @else
                                                                    <button type="submit" class="btn btn-success" style="margin:0rem 0.5rem 0.5rem 0rem; flex:none;">
                                                            <i class="fas fa-lock-open"></i>
                                                                    </button>
                                                        @endif
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
            <div class="my-custom-paginator" style="display: flex; justify-content: flex-end; margin-right: 25px;">
                <!-- Agrega aquí tus estilos personalizados para el paginador -->
                <ul class="pagination">
                    <li class="page-item {{ $Proveedor->currentPage() === 1 ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $Proveedor->url(1) }}" aria-label="First" onclick="mostrarLoader()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8.354 1.646a.5.5 0 0 1 0 .708L2.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                                <path fill-rule="evenodd" d="M12.354 1.646a.5.5 0 0 1 0 .708L6.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                              </svg>
                        </a>
                    </li>
                    <li class="page-item {{ $Proveedor->previousPageUrl() ? '' : 'disabled' }}">
                        <a class="page-link" href="{{ $Proveedor->previousPageUrl() }}" aria-label="Previous" onclick="mostrarLoader()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                            </svg>
                        </a>
                    </li>

                    <!-- Aquí puedes iterar sobre las páginas disponibles -->
                    @php
                        // Calcular el rango de páginas a mostrar
                        $currentPage = $Proveedor->currentPage();
                        $startPage = max($currentPage - 1, 1);
                        $endPage = min($currentPage + 1, $Proveedor->lastPage());
                    @endphp

                    @for ($i = $startPage; $i <= $endPage; $i++)
                        <li class="page-item {{ $i == $Proveedor->currentPage() ? 'active' : '' }}">
                            <a class="page-link" href="{{ $Proveedor->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor

                    <li class="page-item {{ $Proveedor->nextPageUrl() ? '' : 'disabled' }}">
                        <a class="page-link" href="{{ $Proveedor->nextPageUrl() }}" aria-label="Next" onclick="mostrarLoader()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                            </svg>
                        </a>
                    </li>
                    <li class="page-item {{ $Proveedor->currentPage() === $Proveedor->lastPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $Proveedor->url($Proveedor->lastPage()) }}" aria-label="Last" onclick="mostrarLoader()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z"/>
                                <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z"/>
                            </svg>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    <!-- Modal -->
    <div class="modal fade" id="success" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Message</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{ session('success') }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    @if(session('showModal'))
        <script>
            $(document).ready(function() {
                $('#success').modal('show');
            });
        </script>
    @endif
    @include('layout.footer')
@endsection
