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
                            @foreach ($estatus as $item)
                                <option value="{{ $item->id_estatus_insumos }}">{{ $item->nombre }}</option>
                            @endforeach
                        </select>
                        <label for="estatus" class="textUser" style="visibility: hidden">Estatus de insumos</label>
                    </div>
                </div>
                  <div class="col-md-4">
                    <div class="input-form">
                        <select id="proveedor" name="proveedor" required>
                            <option value="" disabled selected>Seleccionar Proveedor</option>
                            @foreach ($proveedores as $proveedor)
                                <option value="{{ $proveedor->id_proveedor }}">{{ $proveedor->nombre_empresarial }}</option>
                            @endforeach
                        </select>
                        <label for="proveedor" class="textUser" style="visibility: hidden">Proveedor</label>
                    </div>
                </div>
              </div>
              <div class="row mb-5">
                <div class="container2 col-md-4">
                    <label for="file" class="header" id="image_label">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> 
                            <path d="M7 10V9C7 6.23858 9.23858 4 12 4C14.7614 4 17 6.23858 17 9V10C19.2091 10 21 11.7909 21 14C21 15.4806 20.1956 16.8084 19 17.5M7 10C4.79086 10 3 11.7909 3 14C3 15.4806 3.8044 16.8084 5 17.5M7 10C7.43285 10 7.84965 10.0688 8.24006 10.1959M12 12V21M12 12L15 15M12 12L9 15" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></g></svg> 
                        <strong id="subir">Sube una foto!</strong>
                    </label>
                    <input id="file" type="file" accept="image/*" capture>
                    <input id="url" class="footer" type="text" placeholder="Coloca una URL">
                </div>
                
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script>
                    // Función para mostrar la imagen seleccionada por el usuario
                    function showImagePreview(input) {
                        if (input.files && input.files[0]) {
                            var reader = new FileReader();
                
                            reader.onload = function(e) {
                                $('#image_label').css('background-image', 'url(' + e.target.result + ')');
                                $('#svg, #subir').css('visibility', 'hidden');
                                // Limpiar la URL del campo de texto cuando se selecciona una imagen local
                                $('#url').val('');
                            }
                
                            reader.readAsDataURL(input.files[0]);
                        } else {
                            $('#image_label').css('background-image', 'none');
                            $('#svg, #subir').css('visibility', 'visible');
                        }
                    }
                
                    // Lógica para mostrar la imagen al seleccionar un archivo local
                    $('#file').change(function() {
                        showImagePreview(this);
                    });
                
                    // Lógica para mostrar la imagen al ingresar una URL
                    $('#url').on('input', function() {
                        var imageUrl = $(this).val();
                        $('#image_label').css('background-image', imageUrl ? 'url(' + imageUrl + ')' : 'none');
                        $('#svg, #subir').css('visibility', imageUrl ? 'hidden' : 'visible');
                    });
                </script>
                       
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

