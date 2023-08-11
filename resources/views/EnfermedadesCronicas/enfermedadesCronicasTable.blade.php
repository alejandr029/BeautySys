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
    <div id="notification" class="position-fixed top-0 end-0 p-3" style="z-index: 5">
        <div class="alert alert-success text-white" role="alert">
            <strong>{{ session('success') }}</strong> 
        </div>
    </div>
    <script>
        setTimeout(function() {
            var notification = document.getElementById('notification');
            if (notification) {
                notification.classList.add('show');
                setTimeout(function() {
                    notification.classList.remove('show');
                    setTimeout(function() {
                        notification.remove();
                    }, 500);
                }, 2000);
            }
        }, 100);
    </script>
    @endif
    <div class="container-fluid py-4">      
        
        <div id="ProveedoresTable" class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center">
                            <h6 class="text-white text-capitalize ps-3">Enfermedades Cronicas</h6>
                            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#miModal" style="margin-right: 15px; background: #F2F2F2; color: #0D0D0D;">
                                <a>
                                    <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"></path><path fill="currentColor" d="M11 11V5h2v6h6v2h-6v6h-2v-6H5v-2z"></path></svg> 
                                    Agregar enfermedades cronicas
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
                                        <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7" style="text-align: center;">Descripcion</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($EnfermedadesCronicas) > 0)
                                    @foreach ($EnfermedadesCronicas as $EnfermedadesCronica)
                                    <tr>
                                        <td style="text-align: center">{{ $EnfermedadesCronica->id_tipo_enfermedad_cronica }}</td>
                                        <td style="text-align: center;">{{ $EnfermedadesCronica->nombre }}</td>
                                        <td style="text-align: center;">{{ $EnfermedadesCronica->descripcion }}</td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="3" style="text-align: center;">No tienes enfermedades cronicas</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    </div>
                </div>
            </div>


    </div>
    @include('layout.footer')
</main>


<div class="modal fade" id="miModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title" id="exampleModalLabel">Selecciona tus alergias</h2>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="margin-right: 25px">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#000" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
              </svg>
            </button>
          </div>
          <div class="row">
            <form action="{{ route('añadirEnfermedadCronica', Auth::user()->id) }}" method="post">
            @csrf 
            <div style="height: 30em;overflow-y: auto;">
                <div class="modal-body table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col" style="text-align: center">ID</th>
                                <th scope="col" style="text-align: center">Nombre</th>
                                <th scope="col" style="text-align: center">Descripcion</th>
                                <th scope="col" style="text-align: center">Seleccionar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($EnfermedadesCronicasModal as $EnfermedadesCronicasModal)
                            <tr>
                                <td style="text-align: center">{{ $EnfermedadesCronicasModal->id_tipo_enfermedad_cronica }}</td>
                                <td style="text-align: center">{{ $EnfermedadesCronicasModal->nombre }}</td>
                                <td style="text-align: center">{{ $EnfermedadesCronicasModal->descripcion }}</td>
                                <td style="text-align: center">
                                    <!-- Agrega el campo oculto con el tipo y el ID -->
                                    <input type="hidden" name="elementos[enfermedadesCronicas{{ $EnfermedadesCronicasModal->id_tipo_enfermedad_cronica }}][id]" value="{{ $EnfermedadesCronicasModal->id_tipo_enfermedad_cronica }}">
                                    <input type="hidden" name="elementos[enfermedadesCronicas{{ $EnfermedadesCronicasModal->id_tipo_enfermedad_cronica }}][seleccionado]" value="0">
                                    <input type="checkbox" name="elementos[enfermedadesCronicas{{ $EnfermedadesCronicasModal->id_tipo_enfermedad_cronica }}][seleccionado]" value="1"></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                  </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                  </div>
                </form>
                </div>
          </div> 
    </div> 
</div>

@endsection
