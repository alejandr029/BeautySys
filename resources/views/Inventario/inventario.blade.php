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

</style>

@extends('layout.tamplated')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center">
                            <h6 class="text-white text-capitalize ps-3">Inventario de insumos</h6>
                            <button class="crear" style="margin-right: 15px;">
                                <a href="{{ route('crearInsumo') }}">
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
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="text-align: center;">ID</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="text-align: center;">Imagen</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="text-align: center;">Nombre</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="text-align: center;">Descripción</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="text-align: center;">Fecha Adquisición</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="text-align: center;">Fecha Vencimiento</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="text-align: center;">Cantidad</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="text-align: center;">Estatus</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="text-align: center;">Proveedor</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($InventarioInsumos as $insumo)
                                    <tr>
                                        <td style="text-align: center">{{ $insumo->id_insumos }}</td>
                                        <td><img src="{{ $insumo->imagen }}" class="avatar avatar-sm-new me-3 border-radius-lg" alt="{{ $insumo->nombre }}" style="display: block; margin: auto;"></td>
                                        <td style="text-align: center; width: 100px">{{ $insumo->nombre }}</td>
                                        <td style="text-align: justify; width: 350px">{{ $insumo->descripcion }}</td>
                                        <td style="text-align: center; width: 100px">{{ Carbon::parse($insumo->fecha_adquisicion)->format('Y-m-d') }}</td>
                                        <td style="text-align: center; width: 100px">{{ Carbon::parse($insumo->fecha_vencimiento)->format('Y-m-d') }}</td>
                                        <td style="text-align: center; width: 50px">{{ $insumo->cantidad }}</td>
                                        <td style="text-align: center; width: 100px">{{ $insumo->nombre_estatus }}</td>
                                        <td style="text-align: center; width: 100px">{{ $insumo->nombre_empresarial }}</td>
                                        <td>
                                            <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                                Edit
                                            </a>
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
                    <li class="page-item {{ $InventarioInsumos->currentPage() === 1 ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $InventarioInsumos->url(1) }}" aria-label="First">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8.354 1.646a.5.5 0 0 1 0 .708L2.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                                <path fill-rule="evenodd" d="M12.354 1.646a.5.5 0 0 1 0 .708L6.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                              </svg>
                        </a>
                    </li>
                    <li class="page-item {{ $InventarioInsumos->previousPageUrl() ? '' : 'disabled' }}">
                        <a class="page-link" href="{{ $InventarioInsumos->previousPageUrl() }}" aria-label="Previous">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                            </svg>
                        </a>
                    </li>
            
                    <!-- Aquí puedes iterar sobre las páginas disponibles -->
                    @php
                        // Calcular el rango de páginas a mostrar
                        $currentPage = $InventarioInsumos->currentPage();
                        $startPage = max($currentPage - 1, 1);
                        $endPage = min($currentPage + 1, $InventarioInsumos->lastPage());
                    @endphp
            
                    @for ($i = $startPage; $i <= $endPage; $i++)
                        <li class="page-item {{ $i == $InventarioInsumos->currentPage() ? 'active' : '' }}">
                            <a class="page-link" href="{{ $InventarioInsumos->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor
            
                    <li class="page-item {{ $InventarioInsumos->nextPageUrl() ? '' : 'disabled' }}">
                        <a class="page-link" href="{{ $InventarioInsumos->nextPageUrl() }}" aria-label="Next">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                            </svg>
                        </a>
                    </li>
                    <li class="page-item {{ $InventarioInsumos->currentPage() === $InventarioInsumos->lastPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $InventarioInsumos->url($InventarioInsumos->lastPage()) }}" aria-label="Last">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z"/>
                                <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z"/>
                            </svg>
                        </a>
                    </li>
                </ul>
            </div>
            
            
            
        </div>
    </div>
    @include('layout.footer')
</main>
@endsection
