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
                        <h2 class="card-title">Actualizar Cuenta con ID: {{ $user->id}}</h2>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-11">
                                <!-- Formulario para actualizar la cuenta de usuario -->
                                <form action="{{ route('Cuentas.update', ['id' => $user->id]) }}" method="POST"
                                    class="role-form">
                                    @csrf
                                    @method('PUT')


                                    <div class="row mb-5">
                                      <div class="col-md-6">
                                        <div class="input-form">
                                          <select id="rol_id" name="rol_id" required>
                                            @foreach ($roles as $rol)
                                            <option value="{{ $rol->id }}"
                                              {{ $user->hasRole($rol->id) ? 'selected' : '' }} >
                                              {{ $rol->name }}</option>
                                              @endforeach
                                            </select>
                                            <label for="rol_id" class="textUser" style="visibility: hidden">Seleccionar Rol:</label>
                                          </div>
                                        </div>
                                      <div class="col-md-6">
                                        <div class="input-form">
                                          <input type="text" id="email" name="email" value="{{ $user->email }}" required >
                                          <label for="email" class="textUser ">Correo electrónico:</label>
                                        </div>
                                      </div>
                                    </div>

                                    <div class="row mb-5"  id="nameadmin" style="display: none">
                                      <div class="col-md-4">
                                        <div class="input-form">
                                            <input type="text" id="name" name="name" class="admin-fields" value="{{ $user->name }}" required="true">
                                            <label for="name" class="textUser">Nombre</label>
                                        </div>
                                    </div>
                                  </div>
            
                                  <div id="nameOthers" style="display: none">
                                    <div class="row mb-5"  >
                                      <div class="col-md-3">
                                        <div class="input-form">
                                          <input type="text" id="name" name="name" class="others-fields" 
                                          value="{{ $paciente != null ? $paciente->primer_nombre : ($personal != null ? $personal->primer_nombre : '') }}" required="true">
                                            <label for="name" class="textUser">Primer Nombre</label>
                                        </div>
                                    </div>
                                      <div class="col-md-3">
                                        <div class="input-form">
                                          <input type="text" id="secondname" name="secondname" class="others-fields" 
                                          value="{{  $paciente != null ? $paciente->segundo_nombre : ($personal != null ? $personal->segundo_nombre : '') }}"
                                          required="true">
                                            <label for="name" class="textUser">Segundo Nombre</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                      <div class="input-form">
                                        <input type="text" id="lastname" name="lastname" class="others-fields"
                                        value="{{  $paciente != null ? $paciente->primer_apellido : ($personal != null ? $personal->primer_apellido : '') }}"
                                        required="true">
                                          <label for="name" class="textUser">Apellido Paterno</label>
                                      </div>
                                  </div>
                                    <div class="col-md-3">
                                      <div class="input-form"> 
                                        <input type="text" id="secondlastname" name="secondlastname" class="others-fields"
                                        value="{{  $paciente != null ? $paciente->segundo_apellido : ($personal != null ? $personal->segundo_apellido : '') }}"
                                        required="true">
                                        
                                          <label for="name" class="textUser">Apellido materno</label>
                                      </div>
                                    </div>
                                    </div>
                                    <div class="row mb-5">
                                      <div class="col-md-3">
                                        <div class="input-form">
                                          <input type="date" id="fecha" name="fecha" class="others-fields"
                                          value="{{  $paciente != null ? date('Y-m-d', strtotime($paciente->fecha_nacimiento)) : ($personal != null ? date('Y-m-d', strtotime($personal->fecha_nacmiento)) : '') }}"
                                          required="true">
                                          <label for="fecha" class="textUser" style="visibility: hidden">Fecha de nacimiento</label>
                                      </div>
                                    </div>
                                    <div class="col-md-3">
                                      <div class="input-form">
                                        <select id="genero" name="genero" class="others-fields" required="true">
                                            <option value="">Seleccionar género</option>
                                            <option value="masculino" {{ ($paciente != null ? $paciente->genero : ($personal != null ? $personal->genero : '')) === 'masculino' ? 'selected' : '' }}>Masculino</option>
                                            <option value="femenino" {{ ($paciente != null ? $paciente->genero : ($personal != null ? $personal->genero : '')) === 'femenino' ? 'selected' : '' }}>Femenino</option>
                                        </select>
                                        <label for="genero" class="textUser" style="visibility: hidden">Género</label>
                                    </div>
                                    </div>
                                    <div class="col-md-3">
                                      <div class="input-form">
                                        <input type="tel" id="telefono" name="numeroTelefono" class="others-fields" 
                                        value="{{  $paciente != null ? $paciente->telefono : ($personal != null ? $personal->telefono : '') }}"
                                        required="true" >
                                        
                                        <label for="telefono" class="textUser fixed-label">Numero del telefono</label>
                                      </div>                          
                                    </div>
                                    <div class="col-md-3">
                                      <div class="input-form">
                                        <input type="text" id="direccion" name="direccion" 
                                        value="{{  $paciente != null ? $paciente->dirreccion : ($personal != null ? $personal->dirreccion : '') }}"
                                         class="others-fields" required="true">
                                        
                                          <label for="direccion" class="textUser">Direccion</label>
                                      </div>
                                    </div>
                                  </div>
                                  </div>
                                  <div id="User" style="display: none">
                                    <div class="row mb-5">
                                      <div class="col-md-4">
                                        <div class="input-form">
                                            <input type="text" id="seguroMedico" name="seguroMedico" class="user-fields" value="{{ $paciente != null ? $paciente->seguro_medico : '' }}" required="true">
                                            <label for="seguroMedico" class="textUser">Seguro medico</label>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div id="Staff" style="display: none">
                                    <div class="row mb-5">
                                      <div class="col-md-4">
                                        <div class="input-form">
                                            <select id="departamento" name="departamento" class="staff-fields" required="true">
                                              <option value=""  selected>Seleccionar departamento</option>
                                                @foreach ($departamento as $depart)
                                                    <option value="{{ $depart->id_departamento }}" {{ $personal != null && $personal->id_departamento == $depart->id_departamento ? 'selected' : '' }} >{{ $depart->nombre}}</option>
                                                @endforeach
                                            </select>
                                            <label for="departamento" class="textUser" style="visibility: hidden">Seleccionar departamento</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                      <div class="input-form">
                                          <select id="horario" name="horario" class="staff-fields" required="true">
                                            <option value=""  selected>Seleccionar horario</option>
                                              @foreach ($horario as $horarios)
                                                  <option value="{{ $horarios->id_horario }}"  {{ $personal != null && $personal->id_horario == $horarios->id_horario ? 'selected' : '' }}>{{ $horarios->dias}} de: {{ $horarios->hora_inicio}} a: {{ $horarios->hora_final }}</option>
                                              @endforeach
                                          </select>
                                          <label for="horario" class="textUser" style="visibility: hidden">Seleccionar horario</label>
                                      </div>
                                    </div>
                                    </div>
                                  </div>
            


                                    <button type="submit" class="btn btn-primary">Actualizar Cuenta</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layout.footer')
</main>
<!-- Modal -->
<div class="modal fade" id="error" tabindex="-1" aria-labelledby="errorLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="errorLabel">Message</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                {{session('error')}}
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
              </div>
            </div>
          </div>
        </div>
        @if(session('showModal'))
          <script>
              $(document).ready(function() {
                  $('#error').modal('show');
              });
          </script>
        @endif
@endsection

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Obtén referencias a los elementos de los campos y etiquetas correspondientes
    const nameadminLabel = document.getElementById('nameadmin');
    const nameOthersLabel = document.getElementById('nameOthers');
    const nameUserLabel = document.getElementById('User');
    const nameStaffLabel = document.getElementById('Staff');

    const adminFields = document.querySelectorAll('.admin-fields');
    const othersFields = document.querySelectorAll('.others-fields');
    const userFields = document.querySelectorAll('.user-fields');
    const staffFields = document.querySelectorAll('.staff-fields');
  
    // Obtén la referencia al elemento de selección de rol
    const rolSelect = document.getElementById('rol_id');
  
    // Función para actualizar la visibilidad de los campos según el rol seleccionado
    function updateFieldsVisibility(selectedRoleId) {
        // Oculta todos los conjuntos de campos primero
        nameadminLabel.style.display = 'none';
        nameOthersLabel.style.display = 'none';
        nameUserLabel.style.display = 'none'
        nameStaffLabel.style.display = 'none';

        // Establece la visibilidad de los conjuntos de campos según el rol seleccionado
        if (selectedRoleId === '1') { 
            nameadminLabel.style.display = 'block';
            nameOthersLabel.style.display = 'none';
            nameUserLabel.style.display = 'none'
            nameStaffLabel.style.display = 'none';

            adminFields.forEach(input => {
                input.required = true;
            });
            othersFields.forEach(input => {
                input.required = false;
            });
            userFields.forEach(input => {
                input.required = false;
            });
            staffFields.forEach(input => {
                input.required = false;
            });


          } else if(selectedRoleId === '2') {
            nameadminLabel.style.display = 'none';
            nameUserLabel.style.display = 'none'
            nameOthersLabel.style.display = 'block';
            nameStaffLabel.style.display = 'block';

            adminFields.forEach(input => {
                input.required = false;
            });
            othersFields.forEach(input => {
                input.required = true;
            });
            userFields.forEach(input => {
                input.required = false;
            });
            staffFields.forEach(input => {
                input.required = true;
            });

        }else if(selectedRoleId === '3'){
          nameadminLabel.style.display = 'none';
          nameStaffLabel.style.display = 'none';
          nameUserLabel.style.display = 'block'
          nameOthersLabel.style.display = 'block';

          adminFields.forEach(input => {
                input.required = false;
            });
            othersFields.forEach(input => {
                input.required = true;
            });
            userFields.forEach(input => {
                input.required = true;
            });
            staffFields.forEach(input => {
                input.required = false;
            });
        }
    }

    // Llama a la función para configurar la visibilidad inicial basada en el rol seleccionado
    updateFieldsVisibility(rolSelect.value);

    // Agrega un evento de cambio para actualizar la visibilidad cuando el rol cambie
    rolSelect.addEventListener('change', function() {
        updateFieldsVisibility(this.value);
    });
});

</script>