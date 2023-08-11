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
                    <h4 class="card-title">Creación de Cuentas</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('user.store') }}" method="post" class="role-form">
                        @csrf
                        <div class="row mb-5">
                          <div class="col-md-4">
                            <div class="input-form">
                                <select id="rol_id" name="rol_id" required>
                                  <option value=""  selected>Seleccionar rol</option>
                                    @foreach ($roles as $rol)
                                        <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                                    @endforeach
                                </select>
                                <label for="rol_id" class="textUser" style="visibility: hidden">Seleccionar Rol</label>
                            </div>
                        </div>
                            <div class="col-md-4">
                                <div class="input-form">
                                    <input type="email" id="email" name="email" required>
                                    <label for="email" class="textUser">Correo electrónico</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-form">
                                    <input type="password" id="password" name="password" required>
                                    <label for="password" class="textUser">Contraseña</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5"  id="nameadmin" style="display: none">
                          <div class="col-md-4">
                            <div class="input-form">
                                <input type="text" id="name" name="name" class="admin-fields" required="true">
                                <label for="name" class="textUser">Nombre</label>
                            </div>
                        </div>
                      </div>

                      <div id="nameOthers" style="display: none">
                        <div class="row mb-5"  >
                          <div class="col-md-3">
                            <div class="input-form">
                                <input type="text" id="name" name="name" class="others-fields" required="true">
                                <label for="name" class="textUser">Primer Nombre</label>
                            </div>
                        </div>
                          <div class="col-md-3">
                            <div class="input-form">
                                <input type="text" id="secondname" name="secondname" class="others-fields" required="true">
                                <label for="name" class="textUser">Segundo Nombre</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                          <div class="input-form">
                              <input type="text" id="lastname" name="lastname" class="others-fields" required="true">
                              <label for="name" class="textUser">Apellido Paterno</label>
                          </div>
                      </div>
                        <div class="col-md-3">
                          <div class="input-form">
                              <input type="text" id="secondlastname" name="secondlastname" class="others-fields" required="true">
                              <label for="name" class="textUser">Apellido materno</label>
                          </div>
                        </div>
                        </div>
                        <div class="row mb-5">
                          <div class="col-md-3">
                            <div class="input-form">
                              <input type="date" id="fecha" name="fecha" class="others-fields" required="true">
                              <label for="fecha" class="textUser" style="visibility: hidden">Fecha de nacimiento</label>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="input-form">
                            <select id="genero" name="genero" class="others-fields" required="true">
                                <option value="" selected>Seleccionar género</option>
                                <option value="masculino">Masculino</option>
                                <option value="femenino">Femenino</option>
                            </select>
                            <label for="genero" class="textUser" style="visibility: hidden">Género</label>
                        </div>
                        </div>
                        <div class="col-md-3">
                          <div class="input-form">
                            <input type="tel" id="telefono" name="numeroTelefono" class="others-fields" required="true" >
                            <label for="telefono" class="textUser fixed-label">Numero del telefono</label>
                          </div>                          
                        </div>
                        <div class="col-md-3">
                          <div class="input-form">
                              <input type="text" id="direccion" name="direccion" class="others-fields" required="true">
                              <label for="direccion" class="textUser">Direccion</label>
                          </div>
                        </div>
                      </div>
                      </div>
                      <div id="User" style="display: none">
                        <div class="row mb-5">
                          <div class="col-md-4">
                            <div class="input-form">
                                <input type="text" id="seguroMedico" name="seguroMedico" class="user-fields" required="true">
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
                                        <option value="{{ $depart->id_departamento }}">{{ $depart->nombre}}</option>
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
                                      <option value="{{ $horarios->id_horario }}">{{ $horarios->dias}} de: {{ $horarios->hora_inicio}} a: {{ $horarios->hora_final }}</option>
                                  @endforeach
                              </select>
                              <label for="horario" class="textUser" style="visibility: hidden">Seleccionar horario</label>
                          </div>
                        </div>
                        </div>
                      </div>

                        <div class="text-center mt-3">
                            <button type="submit" class="btn btn-primary">Crear Cuenta</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@include('layout.footer')
@endsection

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const nameadminLabel = document.getElementById('nameadmin');
    const nameOthersLabel = document.getElementById('nameOthers');
    const nameUserLabel = document.getElementById('User');
    const nameStaffLabel = document.getElementById('Staff');

    const adminFields = document.querySelectorAll('.admin-fields');
    const othersFields = document.querySelectorAll('.others-fields');
    const userFields = document.querySelectorAll('.user-fields');
    const staffFields = document.querySelectorAll('.staff-fields');
  
    const rolSelect = document.getElementById('rol_id');
  
    rolSelect.addEventListener('change', function() {
        const selectedRoleId = this.value;

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
    });
});

</script>


