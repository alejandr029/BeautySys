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
                            <label for="name" class="form-label">Guardar datos actuales:</label>
                            <div>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-down" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M3.5 10a.5.5 0 0 1-.5-.5v-8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 .5.5v8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 0 0 1h2A1.5 1.5 0 0 0 14 9.5v-8A1.5 1.5 0 0 0 12.5 0h-9A1.5 1.5 0 0 0 2 1.5v8A1.5 1.5 0 0 0 3.5 11h2a.5.5 0 0 0 0-1h-2z"/>
                                    <path fill-rule="evenodd" d="M7.646 15.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 14.293V5.5a.5.5 0 0 0-1 0v8.793l-2.146-2.147a.5.5 0 0 0-.708.708l3 3z"/>
                                  </svg>
                                </button>
                            </div>
                            
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Reseteo de base de datos: </label>
                            <div></div>
                            <div>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAllert">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z"/>
                                    <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z"/>
                                  </svg>
                                </button>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="rol" class="form-label">Reseteo a en cierta version: </label>
                            <div class="dropdown">
                                <button style="background-color: #F2F2F2; border-color:#F2F2F2;color: #0D0D0D;" class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
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
                                  <h3>Deseas guardar los datos actuales</h3>
                                  Estas Seguro de guardar los datos actuales en el sistema? <br>
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
                                  <h3> Deseas resetear los datos</h3>
                                  Estas Seguro de querer restaurar todos los datos?<br>
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