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
                <h4 class="card-title">Datos de la consulta</h4>
              </div>
              
                <div class="card-body">  
                    <form method="post"  enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row mb-5">
                            <div class="col-md-5">
                                <div class="input-form">
                                    <select id="personal" name="personal" required>
                                    <option value="" disabled selected>Seleccionar personal encargado</option>
                                    @foreach ($SelectPersonal as $item)
                                    <option value="{{ $item->id_personal }}">Personal: {{ $item->nombrePersonalAcargo }} - Departamento: {{ $item->nombreDepartamento }}</option>
                                    @endforeach
                                    </select>
                                    <label for="personal" class="textUser" style="visibility: hidden">Personal encargado</label>
                                    
                                </div>
                            </div>

                            
                            <div class="col-md-3">
                                <div class="input-form">
                                    <select id="consultas" name="consultas" required>
                                    <option value="" disabled selected>sala en disposicion </option>
                                    @foreach ($sala as $item)
                                    <option value="{{ $item->id_sala }}">nombre: {{ $item->nombre }} - status: {{ $item->status }}</option>
                                    @endforeach
                                    </select>
                                    <label for="consultas" class="textUser" style="visibility: hidden">salas disponibles</label>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="input-form">
                                    <select id="consultas" name="consultas" required>
                                    <option value="" disabled selected>Estatus de la consulta</option>
                                    @foreach ($status as $item)
                                    <option value="{{ $item->id_status_consulta}}"> {{ $item->nombre }}</option>
                                    @endforeach
                                    </select>
                                    <label for="consultas" class="textUser" style="visibility: hidden">estado consultas</label>
                                </div>
                            </div>

                           
                        </div>
                

                        <div class="text-center mt-3">
                            <button type="submit" class="btn btn-primary">Crear consulta</button>
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
    
