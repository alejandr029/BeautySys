{{-- consultaactualizar --}}

<style>
    .input-form {
      position: relative;
      font-family: Arial, Helvetica, sans-serif;
    }

    .input-form input, .input-form textarea, .input-form select {
      border: solid 1.9px #9e9e9e;
      border-radius: 1.3rem;
      background: none;
      padding: 1rem;
      font-size: 1rem;
      color: #000000;
      transition: border 150ms cubic-bezier(0.4, 0, 0.2, 1);
      width: 100%;
    }

    .textUser {
      position: absolute;
      left: 15px;
      color: #666666;
      pointer-events: none;
      transform: translateY(1rem);
      transition: 150ms cubic-bezier(0.4, 0, 0.2, 1);
    }

    .input-form input:focus, .input-form input:valid, .input-form textarea:focus, .input-form textarea:valid,
    .input-form select:focus, .input-form select:valid {
      outline: none;
      box-shadow: 1px 2px 5px rgba(133, 133, 133, 0.523);
      background-image: linear-gradient(to top, rgba(182, 182, 182, 0.199), rgba(252, 252, 252, 0));
      transition: background 4s ease-in-out;
    }

    .input-form input:focus ~ label, .input-form input:valid ~ label,
    .input-form textarea:focus ~ label, .input-form textarea:valid ~ label,
    .input-form select:focus ~ label, .input-form select:valid ~ label {
      transform: translateY(-95%) scale(0.9);
      padding: 0 .2em;
      color: #000000be;
      left: 10%;
      font-size: 14pt;
      visibility: visible!important;
    }

    .input-form input:hover, .input-form textarea:hover, .input-form select:hover {
      border: solid 1.9px #000002;
      transform: scale(1.03);
      box-shadow: 1px 1px 5px rgba(133, 133, 133, 0.523);
      transition: border-color 1s ease-in-out;
    }

    input:disabled ~ label.fixed-label, textarea:disabled ~ label.fixed-label,  select:disabled ~ .fixed-label {
    transform: translateY(-95%) scale(0.9);
    padding: 0 .2em;
    color: #000000be;
    left: 10%;
    font-size: 14pt;
    visibility: visible!important;
    }


    .container2 {
      height: 300px;
      width: 300px;
      border-radius: 10px;
      box-shadow: 4px 4px 30px rgba(0, 0, 0, .2);
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: space-between;
      padding: 10px;
      gap: 5px;
      background-color: rgba(0, 110, 255, 0.041);
    }

    .header {
      flex: 1;
      width: 100%;
      border: 2px dashed royalblue;
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction: column;
      background-size: contain;
      background-position: center;
      background-repeat: no-repeat;
    }

    .header svg {
      height: 100px;
    }

    .header p {
      text-align: center;
      color: black;
    }

    .footer {
      background-color: rgba(0, 110, 255, 0.075);
      width: 100%;
      height: 40px;
      padding: 8px;
      border-radius: 10px;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: flex-end;
      color: black;
      border: none;
    }

    .footer svg {
      height: 130%;
      fill: royalblue;
      background-color: rgba(70, 66, 66, 0.103);
      border-radius: 50%;
      padding: 2px;
      cursor: pointer;
      box-shadow: 0 2px 30px rgba(0, 0, 0, 0.205);
    }

    .footer p {
      flex: 1;
      text-align: center;
    }

    #file {
      display: none;
    }

    .label-container {
            display: inline-block;
            width: 150px; /* Ajusta el ancho según lo que necesites */
            height: 150px; /* Ajusta la altura según lo que necesites */
            border: 1px solid #ccc; /* Agrega un borde para que sea visible */

        }

        

</style>
    
    @extends('layout.template')
    @section('content')
    <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-11">
            <div class="card">
              <div class="card-header"> 
                <h4 class="card-title">Actualizar la Consulta con id: {{$consultas->id_consulta}}</h4>
              </div>
              
                <div class="card-body"> 
                    <form method="POST" action="{{ route('ConsultaActualizar', $consultas->id_consulta) }}" enctype="multipart/form-data">
                      @csrf
                      @method('PUT')
                      
                        <div class="row mb-5">
                          <div class="row mb-5">
                            <div class="col-md-6">
                              <div class="input-form">
                                <input type="date" id="fecha" name="fecha" required  value="{{ date('Y-m-d', strtotime($consultas->fecha_visita)) }}">
                                <label for="fecha" class="textUser" style="visibility: hidden" >Fecha de la consulta</label>
                              </div>
                            </div>
                          <div class="col-md-6">
                            <div class="input-form">
                              
                              <input type="time" id="hora" name="hora" required  value="{{ date('H:i', strtotime($consultas->fecha_visita)) }}">
                              <label for="hora" class="textUser" style="visibility: hidden" >Hora de la consulta</label>
                            </div>
                          </div>
                        </div>
                        <div class="row mb-5">
                          <div class="col-md-5">
                              <div class="input-form">
                                  <select id="personal" name="personal" required >
                                  <option value="" disabled selected>personal encargado</option>
                                  @foreach ($SelectPersonal as $item)
                                  <option value="{{ $item->id_personal }}" {{ $consultas->id_personal == $item->id_personal ? 'selected' : '' }}>Personal: {{ $item->nombrePersonalAcargo }} - Departamento: {{ $item->nombreDepartamento }}</option>
                                  @endforeach
                                  </select>
                                  <label for="personal" class="textUser" style="visibility: hidden">Personal encargado</label>
                                  
                              </div>
                          </div>

                          
                          <div class="col-md-3">
                              <div class="input-form">
                                  <select id="consulta_sala" name="consulta_sala" required >
                                  <option value="" disabled selected>sala en uso </option>
                                  @foreach ($sala as $item)
                                  <option value="{{ $item->id_sala }}"  {{ $consultas->id_sala == $item->id_sala ? 'selected' : '' }}> {{ $item->nombre }} - status: {{ $item->status }}</option>
                                  @endforeach
                                  </select>
                                  <label for="consulta_sala" class="textUser" style="visibility: hidden">salas disponibles</label>
                              </div>
                          </div>
                          
                          <div class="col-md-3">
                              <div class="input-form">
                                  <select id="estatus_consultas" name="estatus_consultas" required  >
                                  <option value="" disabled selected>Estatus de la consulta</option>
                                  @foreach ($status as $item)
                                  <option value="{{ $item->id_status_consulta}}"{{ $consultas->id_status_consulta == $item->id_status_consulta ? 'selected' : '' }}> {{ $item->nombre }}</option>
                                  @endforeach
                                  </select>
                                  <label for="estatus_consultas" class="textUser" style="visibility: hidden">estado consultas</label>
                              </div>
                          </div>
                        </div>

                        <div class="row mb-5" >
                          <div class="col-md-9" style="margin-inline: auto">
                            <div class="input-form">
                              <input type="text" id="datos_consultas" name="datos_consultas" required   value="{{ $consultas->datos_consulta}}" >
                              <label for="nombrePaciente" class="textUser fixed-label">Concepto de la consulta</label>
                            </div>
                          </div>

                            <div class="col-md-3" style="margin-inline: auto">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" name="Aprovacion_cirugia" id="Aprovacion_cirugia" {{ $consultas->aprovacion_cirugia == 1 ? 'checked' : '' }} >
                                    <label class="form-check-label" for="Aprovacion_cirugia">
                                        Aprovacion cirugia
                                    </label>
                                </div>
                            </div>
                        </div>
                        

                        <div class="row mb-5" > 
                          <hr class="dark horizontal">
                            <div class="row mb-5">
                                <div class="card-header" style="margin-bottom: 20px">
                                    <h4 class="card-title">Datos del paciente</h4>
                                </div>

                                <div class="row mb-6" style="margin-top: 35px">                          
                                    <div class="col-md-4">
                                        <div class="input-form">
                                            <input type="text" id="Paciente_nombre" name="Paciente_nombre" disabled value="{{$paciente->nombrePaciente}}">
                                            <label for="Paciente_nombre" class="textUser fixed-label">Nombre completo del paciente</label>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="input-form">
                                            <input type="email" id="correoPaciente" name="correoPaciente"  disabled value="{{$paciente->correo}}">
                                            <label for="correoPaciente" class="textUser fixed-label">Correo del paciente</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-form">
                                            <input type="text" id="telefonoPaciente" name="telefonoPaciente"  disabled value="{{$paciente->telefono}}">
                                            <label for="telefonoPaciente" class="textUser fixed-label">Telefono del paciente</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4 text-center">
                                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#miModal">
                                      Agregar analisis del paciente
                                  </button>
                                </div>
                            </div>
                            
                            <div class="text-center mt-2" >
                              <button type="submit" class="btn btn-primary">Actualizar consulta</button>
                          </div>
                            
                        </div>
                          

                        
                    </form>

                    

                    

                       
                      

                </div>
                
            </div>
          </div>
        </div>
      </div>
      
      
      @include('layout.footer')
    </main>
    @endsection
    <div class="modal fade" id="miModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="height: 95%; margin-left:7%">
      <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                  <h3 class="modal-title" id="exampleModalLabel">Analisis del paciente</h2>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="margin-right: 25px">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#000" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                      <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                      </svg>
                  </button>
              </div>

              <div class="modal-body">

                  <button type="button" id="btnNuevo" class="btn btn-primary">Nuevo</button>

                  <form id="formularioAnalisis" class="d-none" action="{{ route('analisis_paciente', ['id'=> $consultas->id_consulta])}}" method="post">
                      @csrf 
                      
                      <div class="row mb-5" style="margin-top: 10px"> 
                          <div class="col-md-3">
                              <div class="input-form">
                              <input type="number" id="id_paciente_modal" name="id_paciente_modal" required  value="{{ $paciente->id_paciente }}" disabled>
                              <label for="id_paciente_modal" class="textUser fixed-label" >Id Paciente</label>
                              </div>
                          </div>

                          <div class="col-md-4">
                              <div class="input-form">
                              <input type="text" id="nombre_paciente_modal" name="nombre_paciente_modal" required  value="">
                              <label for="nombre_paciente_modal" class="textUser fixed-label" >Nombre del analisis</label>
                              </div>
                          </div>

                          <div class="col-md-5" style="margin-inline: auto">
                              <div class="input-form">
                                  <select id="estatus_analisis" name="estatus_analisis" required  >
                                      <option value="" disabled selected>tipo estatus analisis </option>
                                      <option value="aprobado">aprobado</option>
                                      <option value="cancelado">cancelado</option>
                                      <option value="analisando">analisando</option>
                                  </select>
                                  <label for="estatus_analisis" class="textUser" style="visibility: hidden">estatus del analisis</label>
                              </div>
                          </div>
                      </div>
                      <div class="row mb-5">
                          <div class="col-md-6">
                              <label for="paciente_nota" class="form-label">nota del analisis</label>
                              <textarea class="form-control" id="paciente_nota" name="paciente_nota" rows="5" style="resize: none;
                               border: 1px solid gray;"></textarea>
                          </div>

                          <div class="col-md-6">
                              <label for="paceinte_diagnostico" class="form-label">diagnostico</label>
                              <textarea class="form-control" id="paceinte_diagnostico"  name="paceinte_diagnostico" rows="5" style="resize: none;
                               border: 1px solid gray;"></textarea>
                          </div>
                      </div>
                      <div class="text-center mt-3">
                          <button type="submit" class="btn btn-primary">Generar analisis</button>
                      </div>
                  </form>
                  
                  <hr class="dark horizontal">

                  @if(count($analisis) > 0)
                      @foreach ($analisis as $item)
                          <div class="row mb-5" style="margin-top: 40px">
                              <div class="col-md-3">
                                  <div class="input-form">
                                  <input type="number" id="id_paciente_modal" name="id_paciente_modal" required  value="{{ $paciente->id_paciente }}" disabled >
                                  <label for="id_paciente_modal" class="textUser fixed-label" >Id Paciente</label>
                                  </div>
                              </div>

                              <div class="col-md-4">
                                  <div class="input-form">
                                  <input type="text" id="nombre_paciente_modal" name="nombre_paciente_modal" required  value="{{ $item->nombre }}" disabled>
                                  <label for="nombre_paciente_modal" class="textUser fixed-label" >Nombre del analisis</label>
                                  </div>
                              </div>

                              <div class="col-md-5" style="margin-inline: auto">
                                  <div class="input-form">
                                      <select id="estatus_analisis" name="estatus_analisis" required disabled >
                                          <option value="{{ $item->resultados }}" disabled selected>{{ $item->resultados }} </option>
                                          <option value="aprobado">aprobado</option>
                                          <option value="cancelado">cancelado</option>
                                          <option value="analisando">analisando</option>
                                      </select>
                                      <label for="estatus_analisis" class="textUser" style="visibility: hidden">estatus del analisis</label>
                                  </div>
                              </div>
                          </div>
                          <div class="row mb-5">
                              <div class="col-md-6">
                                  <label for="paciente_nota" class="form-label">nota del analisis</label>
                                  <textarea class="form-control" id="paciente_nota" rows="5" style="resize: none;
                                  border: 1px solid gray;" disabled>{{ $item->notas }}</textarea>
                              </div>

                              <div class="col-md-6">
                                  <label for="paceinte_diagnostico" class="form-label">diagnostico</label>
                                  <textarea class="form-control" id="paceinte_diagnostico" rows="5" style="resize: none;
                                  border: 1px solid gray;" disabled>{{ $item->diagnostico }}</textarea>
                              </div>
                          </div>
                      @endforeach
                  @endif
                  

              </div>
                      
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Guardar cambios</button>
              </div>

              
        </div>
      </div>

      <script>
          document.addEventListener("DOMContentLoaded", function () {
          const btnNuevo = document.getElementById("btnNuevo");
          const formularioAnalisis = document.getElementById("formularioAnalisis");

          btnNuevo.addEventListener("click", function () {
              formularioAnalisis.classList.toggle("d-none");
          });
      });

      </script>
  </div>

