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
                <h4 class="card-title">Vista de la Cirugia con id: {{$DatosCirugia->id_cirugia}}</h4>
              </div>
              <div class="card-body">   
                  <div class="row mb-5">
                    <div class="col-md-6">
                      <div class="input-form">
                        <select id="consultas" name="consultas" required disabled>
                          <option value="" selected>Seleccionar Consulta aprobada</option>
                          @foreach ($SelectConsultas as $item)
                          <option value="{{ $item->id_consulta }}" {{ $DatosCirugia->id_consulta == $item->id_consulta ? 'selected' : '' }}>Consulta ID: {{ $item->id_consulta }} - Paciente: {{ $item->nombrePaciente }}</option>
                          @endforeach
                        </select>
                        <label for="consultas" class="textUser fixed-label" style="visibility: hidden">Consultas aprobadas</label>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="input-form">
                        <select id="personal" name="personal" required disabled>
                          <option value=""  selected>Seleccionar personal encargado</option>
                          @foreach ($SelectPersonal as $item)
                          <option value="{{ $item->id_personal }}" {{ $DatosCirugia->id_personal == $item->id_personal ? 'selected' : '' }}>Personal: {{ $item->nombrePersonalAcargo }} - Departamento: {{ $item->nombreDepartamento }}</option>
                          @endforeach
                        </select>
                        <label for="personal" class="textUser fixed-label" style="visibility: hidden">Personal encargago</label>
                      </div>
                    </div>
                  </div>
                  <hr class="dark horizontal">
                    <div class="row mb-5">
                      <div class="card-header" style="margin-bottom: 20px">
                        <h4 class="card-title">Datos del paciente</h4>
                      </div>
                      <div class="col-md-4">
                        <div class="input-form">
                          <input type="hidden" id="idPaciente" name="idPaciente">
                          <input type="text" id="nombrePaciente" name="nombrePaciente" required disabled>
                          <label for="nombrePaciente" class="textUser fixed-label">Nombre completo del paciente</label>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="input-form">
                          <input type="email" id="correoPaciente" name="correoPaciente" required disabled>
                          <label for="correoPaciente" class="textUser fixed-label">Correo del paciente</label>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="input-form">
                          <input type="text" id="telefonoPaciente" name="telefonoPaciente"  required disabled>
                          <label for="telefonoPaciente" class="textUser fixed-label">Telefono del paciente</label>
                        </div>
                      </div>

                      <div class="col-md-12">

                      
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


                      <div class="col-md-6">
                        <table class="table table-striped">
                          <thead>
                              <tr>
                                  <th scope="col">Alergias</th>
                              </tr>
                          </thead>
                          <tbody id="alergiasTableBody">
                          </tbody>
                      </table>
                    </div>
                    <div class="col-md-6">
                      <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Enfermedades Cronicas</th>
                            </tr>
                        </thead>
                        <tbody id="enfermedadesTableBody">
                        </tbody>
                    </table>
                  </div>
                    </div>
                    <hr class="dark horizontal">
                    <div class="row mb-5">
                      <div class="card-header" style="margin-bottom: 20px">
                        <h4 class="card-title">Datos de la cirugia</h4>
                      </div>
                      <div class="col-md-4">
                        <div class="input-form">
                          <select id="cirugia" name="cirugia" required disabled>
                            <option value="" selected>Seleccionar Tipo de cirugia</option>
                            @foreach ($SelectCirugias as $item)
                            <option value="{{ $item->id_tipo_cirugia }}" {{ $DatosCirugia->id_tipo_cirugia == $item->id_tipo_cirugia ? 'selected' : '' }}> {{ $item->nombre }} </option>
                            @endforeach
                          </select>
                          <label for="cirugia" class="textUser fixed-label" style="visibility: hidden">Tipo de cirugia</label>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="input-form">
                          <select id="estatusCirugia" name="estatusCirugia" required disabled>
                            <option value="" selected>Seleccionar Estatus de cirugia</option>
                            @foreach ($SelectEstatusCirugia as $item)
                            <option value="{{ $item->id_estatus_cirugia }}" {{ $DatosCirugia->id_estatus_cirugia == $item->id_estatus_cirugia ? 'selected' : '' }}> {{ $item->nombre }} </option>
                            @endforeach
                          </select>
                          <label for="estatusCirugia" class="textUser fixed-label" style="visibility: hidden">Estatus de cirugia</label>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="input-form">
                          <select id="sala" name="sala" required disabled>
                            <option value="" selected>Seleccionar sala a usar</option>
                            <option value="{{ $SelectSalas->id_sala }}" {{ $DatosCirugia->id_sala == $SelectSalas->id_sala ? 'selected' : '' }}> {{ $SelectSalas->nombre }} </option>
                          </select>
                          <label for="sala" class="textUser fixed-label" style="visibility: hidden">Seleccionar sala</label>
                        </div>
                      </div>
                    </div>

                    <div class="row mb-5">
                      <div class="col-md-6">
                      <div class="input-form">
                        <input type="date" id="fecha" name="fecha" required disabled value="{{ date('Y-m-d', strtotime($DatosCirugia->fecha_cirugia)) }}">
                        <label for="fecha" class="textUser fixed-label" style="visibility: hidden">Fecha de la Cirugia</label>
                    </div>
                </div>
                <div class="col-md-6">
                  <div class="input-form">
                    <input type="time" id="hora" name="hora" disabled  value="{{ date('H:i', strtotime($DatosCirugia->fecha_cirugia)) }}">
                    <label for="hora" class="textUser fixed-label" style="visibility: hidden">Hora de la cirugia</label>
                  </div>
                </div>
              </div>
              
              

              <div class="container">
                <div class="row">
                  <div class="col-md-8">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="table-responsive p-0">
                          <table class="table table-striped">
                            <thead>
                              <tr>
                                <th style="width: 50%; text-wrap:wrap; text-align: center;">Nombre de insumo</th>
                              <th style="width: 50%; text-wrap:wrap; text-align: center;">Cantidad Usada</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($InsumoUsado as $insumoU)
                            <tr>
                              <td style="text-align: center; width: 50%; text-wrap:wrap;">{{ $insumoU->nombre }}</td>
                              <td style="text-align: center; width: 50%; text-wrap:wrap;">{{ $insumoU->cantidad }}</td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                      <div class="col-md-6">
                        <div class="table-responsive p-0">
                          <table class="table table-striped">
                            <thead>
                              <tr>
                                <th style="width: 50%; text-wrap:wrap; text-align: center;">Nombre de Equipo medico</th>
                                <th style="width: 50%; text-wrap:wrap; text-align: center;">Cantidad Usada</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach($EquipoUsado as $equipoU)
                              <tr>
                                <td style="text-align: center; width: 50%; text-wrap:wrap;">{{ $equipoU->nombre }}</td>
                                <td style="text-align: center; width: 50%; text-wrap:wrap;">{{ $equipoU->cantidad }}</td>
                              </tr>
                              @endforeach
                            </tbody>
                          </table>
                        </div>
                      </div>

                    </div>
                  </div>
                    <div class="col-md-4">
                      <div class="table-responsive p-0">

                        <table class="table table-striped">
                          <thead>
                            <tr>
                              <th scope="col"></th>
                              <th scope="col"></th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <th scope="row" style="width: 50%; text-wrap:wrap;">Nombre cirugia:</th>
                              <td id="nombreCirugia"  style="width: 50%; text-wrap:wrap;"></td>
                            </tr>
                            <tr>
                              <th scope="row" style="width: 50%; text-wrap:wrap;">Precio unitario:</th>
                              <td id="PrecioCirugia"  style="width: 50%; text-wrap:wrap;"></td>
                            </tr>
                            <tr>
                              <th scope="row" style="width: 50%; text-wrap:wrap;">Tiempo estimado de la cirugia:</th>
                              <td id="TiempoCirugia"  style="width: 50%; text-wrap:wrap;"></td>
                            </tr>
                            <tr>
                              <th scope="row" style="width: 50%; text-wrap:wrap;">Tiempo estimado de la recuperacion:</th>
                              <td id="TiempoRecuperacion"  style="width: 50%; text-wrap:wrap;"></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                </div>
            </div>
                
            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    // Definir una función que realiza las operaciones AJAX para SelectCirugias
                    function updateCirugiaData() {
                        const selectedCirugiaId = SelectCirugias.value;
                        if (selectedCirugiaId) {
                            fetch(`/cirugia-datos-cirugia/${selectedCirugiaId}`)
                                .then((response) => response.json())
                                .then((data) => {
                                    console.log(data)
                                    TablaNombreCirugia.textContent = data.nombre;
                                    TablaPrecioCirugia.textContent = "$ " + data.precio_unitario;
                                    TablaTiempoCirugia.textContent = data.tiempo_estimado_cirugia;
                                    TablaTiempoRecuperacion.textContent = data.tiempo_estimado_recuperacion;
                                });
                        } else {
                            TablaNombreCirugia.textContent = "";
                            TablaPrecioCirugia.textContent = "";
                            TablaTiempoCirugia.textContent = "";
                            TablaTiempoRecuperacion.textContent = "";
                        }
                    }
            
                    // Definir una función que realiza las operaciones AJAX para selectConsultas
                    function updateConsultaData() {
                        const selectedConsultaId = selectConsultas.value;
                        if (selectedConsultaId) {
                            fetch(`/cirugia-datos-paciente/${selectedConsultaId}`)
                            .then((response) => response.json())
                            .then((data) => {
                                console.log(data);
                                idPacienteInput.value = data.id_paciente;
                                nombrePacienteInput.value = data.nombrePaciente;
                                correoPacienteInput.value = data.correoPaciente;
                                telefonoPacienteInput.value = data.telefonoPaciente;
            
                                // Ahora que tenemos el id del paciente, obtenemos las alergias y enfermedades
                                fetch(`/cirugia-obtener-alergias-enfermedades/${data.id_paciente}`)
                                    .then((response) => response.json())
                                    .then((data) => {
                                        // Limpiar las tablas antes de agregar nuevas filas
                                        alergiasTableBody.innerHTML = '';
                                        enfermedadesTableBody.innerHTML = '';
            
                                        // Agregar filas de alergias a la tabla
                                        data.alergias.forEach(alergia => {
                                            const newRow = document.createElement("tr");
                                            const newCell = document.createElement("td");
                                            newCell.textContent = alergia.nombre;
                                            newRow.appendChild(newCell);
                                            alergiasTableBody.appendChild(newRow);
                                        });
            
                                        // Agregar filas de enfermedades crónicas a la tabla
                                        data.enfermedades.forEach(enfermedad => {
                                            const newRow = document.createElement("tr");
                                            const newCell = document.createElement("td");
                                            newCell.textContent = enfermedad.nombre;
                                            newRow.appendChild(newCell);
                                            enfermedadesTableBody.appendChild(newRow);
                                        });
                                    });
                            });
                        } else {
                            idPacienteInput.value = "";
                            nombrePacienteInput.value = "";
                            correoPacienteInput.value = "";
                            telefonoPacienteInput.value = "";
                            alergiasTableBody.innerHTML = '';
                            enfermedadesTableBody.innerHTML = '';
                        }
                    }
            
                    const selectConsultas = document.getElementById("consultas");
                    const idPacienteInput = document.getElementById("idPaciente");
                    const nombrePacienteInput = document.getElementById("nombrePaciente");
                    const correoPacienteInput = document.getElementById("correoPaciente");
                    const telefonoPacienteInput = document.getElementById("telefonoPaciente");
            
                    const SelectCirugias = document.getElementById("cirugia");
                    const TablaNombreCirugia = document.getElementById("nombreCirugia");
                    const TablaPrecioCirugia = document.getElementById("PrecioCirugia");
                    const TablaTiempoCirugia = document.getElementById("TiempoCirugia");
                    const TablaTiempoRecuperacion = document.getElementById("TiempoRecuperacion");
            
                    const alergiasTableBody = document.getElementById("alergiasTableBody");
                    const enfermedadesTableBody = document.getElementById("enfermedadesTableBody");
            
                    // Llamar a las funciones al cargar la página
                    updateConsultaData();
                    updateCirugiaData();
            
                    selectConsultas.addEventListener("change", function () {
                        // Llamar a la función en el evento "change"
                        updateConsultaData();
                    });
            
                    SelectCirugias.addEventListener("change", function () {
                        // Llamar a la función en el evento "change"
                        updateCirugiaData();
                    });
                });
            </script>
            
            
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>   
      @include('layout.footer')
    </main>
    @endsection
    
