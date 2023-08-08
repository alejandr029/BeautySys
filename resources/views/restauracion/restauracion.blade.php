<style>


</style>

@extends('layout.template')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card shadow">
                    <div class="card-header" style="margin-inline: auto">
                        <h4 class="card-title">Restauracion y Guardado de Datos</h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Guardar datos actuale:</label>
                            <div>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                </button>
                            </div>
                            
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Reseteo de base de datos: </label>
                            <div></div>
                            <div>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAllert">
                                </button>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="rol" class="form-label">Reseteo a en cierta version: </label>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                  Versiones
                                </button>
                                <ul class="dropdown-menu">
                                    @foreach ($result as $results)
                                        <li><a class="dropdown-item" href='{{ route('restaurar_file', ['file' => $results->files]) }}'><b>{{ $results->files }} </b> {{ $results->FechaDeCreacion}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        {{-- @foreach ($resultados as $rest)
                            <p> {{$rest-> currencyname}}</p>
                        @endforeach
                         --}}
                          <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">

                                <div class="modal-body">
                                  <h3> los Datos Guardar los Actuales</h3>
                                  Estas Seguro de guardar los datos actuales en el sistema? <br>
                                  *la cuenta cerrara secion al momento que esto suceda*
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                  <button type="button" class="btn btn-primary" onclick="window.location.href='{{ route('restaurar.guardar') }}'">Aceptar</button>
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="modal fade" id="modalAllert" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalAllertLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">

                                <div class="modal-body">
                                  Estas Seguro de querer restaurar todos los datos?<br>
                                  *la cuenta cerrara secion al momento que esto suceda*
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                  <button type="button" class="btn btn-primary" onclick="window.location.href='{{ route('restaurar.todo') }}'">Aceptar</button>
                                </div>
                              </div>
                            </div>
                          </div>

{{-- 
                          @if (@alert)
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                              <strong> {{@alert}}</strong>
                              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                              
                          @endif --}}


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection