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
                <h4 class="card-title">Vista de la Consulta con id: {{$consultas->id_consulta}}</h4>
              </div>

                <div class="card-body">

                        <div class="row mb-5">
                          <div class="row mb-5">
                            <div class="col-md-6">
                              <div class="input-form">
                                <input type="date" id="fecha" name="fecha" required disabled value="{{ date('Y-m-d', strtotime($consultas->fecha_visita)) }}">
                                <label for="fecha" class="textUser" style="visibility: hidden" >Fecha de la consulta</label>
                              </div>
                            </div>
                          <div class="col-md-6">
                            <div class="input-form">

                              <input type="time" id="hora" name="hora" required disabled value="{{ date('H:i', strtotime($consultas->fecha_visita)) }}">
                              <label for="hora" class="textUser" style="visibility: hidden" >Hora de la consulta</label>
                            </div>
                          </div>
                        </div>
                        <div class="row mb-5">
                          <div class="col-md-5">
                              <div class="input-form">
                                  <select id="personal" name="personal" required disabled>
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
                                  <select id="consulta_sala" name="consulta_sala" required disabled>
                                  <option value="" disabled selected>sala en uso </option>
                                  @foreach ($sala as $item)
                                  <option value="{{ $item->id_sala }}"  {{ $consultas->id_sala == $item->id_sala ? 'selected' : '' }}> {{ str_replace('_', ' ', $item->nombre) }} - status: {{ $item->status }}</option>
                                  @endforeach
                                  </select>
                                  <label for="consulta_sala" class="textUser" style="visibility: hidden">salas disponibles</label>
                              </div>
                          </div>

                          <div class="col-md-3">
                              <div class="input-form">
                                  <select id="estatus_consultas" name="estatus_consultas" required disabled >
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
                              <input type="text" id="datos_consultas" name="datos_consultas" required disabled  value="{{ $consultas->datos_consulta}}" >
                              <label for="nombrePaciente" class="textUser fixed-label">Concepto de la consulta</label>
                            </div>
                          </div>
                          <div class="col-md-3" style="margin-inline: auto">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" name="Aprovacion_cirugia" id="Aprovacion_cirugia" {{ $consultas->aprovacion_cirugia == 1 ? 'checked' : '' }} disabled >
                                <label class="form-check-label" for="Aprovacion_cirugia">
                                  Aprovacion cirugia
                                </label>
                              </div>
                          </div>
                        </div>


                      <div class="row mb-5" >
                      <hr style="border: 1px solid #000;">
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

                      </div>


                      <table class="table">
                        <thead>
                            <tr>
                                <th class="center-cell">ID</th>
                                <th class="center-cell">PDF</th>
                                <th class="center-cell">Nombre del Documento</th>
                                <th class="center-cell">Descripción</th>
                                <th class="center-cell">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>

                          @foreach ($analisis as $documento)
                          <tr>
                              <td class="center-cell">{{ $documento->id_analisis }}</td>
                              <td class="center-cell"><i class="fas fa-file-pdf"></i></td>
                              <td class="center-cell">{{ $documento->nombre }}</td>
                              <td class="center-cell">{{ $documento->notas }}</td>
                              <td class="action-icons">
                                <a href="{{ route('mostrar.pdf', ['id_analisis' => $documento ->id_analisis]) }}" target="_blank" class="action-icon">
                                    <i class="fas fa-eye"></i>
                                    <span class="tooltip">Ver</span>
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
      </div>


      @include('layout.footer')
    </main>
    @endsection

