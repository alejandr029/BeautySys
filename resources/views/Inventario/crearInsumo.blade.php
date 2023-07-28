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



</style>

@extends('layout.tamplated')
@section('content')
<div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-11">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Crear Insumo</h4>
          </div>
          <div class="card-body">
            <form>
              <div class="row mb-5">
                <div class="col-md-4">
                  <div class="input-form">
                    <input type="text" id="nombre" name="nombre" required>
                    <label for="nombre" class="textUser">Nombre</label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="input-form">
                    <input type="date" id="fechaAdquisicion" name="fechaAdquisicion" required>
                    <label for="fechaAdquisicion" class="textUser" style="visibility: hidden">Fecha de Adquisición</label>
                  </div>
                </div>
                <div class="col-md-4">
                    <div class="input-form">
                      <input type="date" id="fechaVencimiento" name="fechaVencimiento" required>
                      <label for="fechaVencimiento" class="textUser" style="visibility: hidden">Fecha de Vencimiento</label>
                    </div>
                  </div>
              </div>
              <div class="row mb-5">
                <div class="col-md-4">
                  <div class="input-form">
                    <input type="number" id="cantidad" name="cantidad" required>
                    <label for="cantidad" class="textUser">Cantidad de Insumo</label>
                  </div>
                </div>
                <div class="col-md-4">
                    <div class="input-form">
                      <select id="estatus" name="estatus" required>
                        <option value="" disabled selected>Seleccionar Estatus</option>
                        <option value="activo">Activo</option>
                        <option value="inactivo">Inactivo</option>
                      </select>
                      <label for="estatus" class="textUser" style="visibility: hidden">Estatus de insumos</label>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="input-form">
                      <select id="proveedor" name="proveedor" required>
                        <option value="" disabled selected>Seleccionar Proveedor</option>
                        <option value="proveedor1">Proveedor 1</option>
                        <option value="proveedor2">Proveedor 2</option>
                        <!-- Agrega más opciones de proveedores según necesites -->
                      </select>
                      <label for="proveedor" class="textUser" style="visibility: hidden">Proveedor</label>
                    </div>
                  </div>
              </div>
              <div class="row mb-5">
                    <div class="container2 col-md-4">
                        <label for="file" class="header">
                            <svg xmlns="http://www.w3.org/2000/svg" width="72" height="72" fill="#000000" class="bi bi-cloud-upload" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M4.406 1.342A5.53 5.53 0 0 1 8 0c2.69 0 4.923 2 5.166 4.579C14.758 4.804 16 6.137 16 7.773 16 9.569 14.502 11 12.687 11H10a.5.5 0 0 1 0-1h2.688C13.979 10 15 8.988 15 7.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 2.825 10.328 1 8 1a4.53 4.53 0 0 0-2.941 1.1c-.757.652-1.153 1.438-1.153 2.055v.448l-.445.049C2.064 4.805 1 5.952 1 7.318 1 8.785 2.23 10 3.781 10H6a.5.5 0 0 1 0 1H3.781C1.708 11 0 9.366 0 7.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383z"/>
                                <path fill-rule="evenodd" d="M7.646 4.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V14.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3z"/>
                              </svg>
                          <p>Browse File to upload!</p>
                        </label>
                        <label for="file" class="footer">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-arrow-up" viewBox="0 0 16 16">
                                <path d="M8.5 11.5a.5.5 0 0 1-1 0V7.707L6.354 8.854a.5.5 0 1 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 7.707V11.5z"/>
                                <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
                            </svg>
                          <p>Not selected file</p>
                        </label>
                        <input id="file" type="file">
                    </div>
                      

                    <div class="col-md-6">
                        <div class="input-form" style="height: 70%;">
                        <textarea id="descripcion" name="descripcion" required></textarea>
                        <label for="descripcion" class="textUser">Descripción</label>
                        </div>
                    </div>
              </div>
              <div class="text-center mt-3">
                    <button type="submit" class="btn btn-primary">Crear Insumo</button>
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

