@php
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

Carbon::setLocale('es');
$user = Auth::user();

@endphp

<style>
  :root{
    --color-gray : rgba(229,229,229,255);
  }

  .cardUsers {
  width: 400px;
  border-radius: 20px;
  background: #ffffff;
  padding: 5px;
  margin: auto;
  overflow: hidden;
  box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 20px 0px;
  transition: transform 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

.cardUsers .top-section {
  height: 200px;
  border-radius: 15px;
  display: flex;
  flex-direction: column;
  background: linear-gradient(45deg, rgb(224, 105, 228) 0%, rgb(239, 166, 241) 100%);
  position: relative;
}

.cardUsers .top-section .border {
  border-bottom-right-radius: 10px;
  height: 30px;
  width: 130px;
  background: white;
  background: #ffffff;
  position: relative;
  transform: skew(-40deg);
  box-shadow: -10px -10px 0 0 #ffffff;
}

.cardUsers .top-section .border::before {
  content: "";
  position: absolute;
  width: 15px;
  height: 15px;
  top: 0;
  right: -15px;
  background: rgba(255, 255, 255, 0);
  border-top-left-radius: 10px;
  box-shadow: -5px -5px 0 2px #ffffff;
}

.cardUsers .top-section::before {
  content: "";
  position: absolute;
  top: 30px;
  left: 0;
  background: rgba(255, 255, 255, 0);
  height: 15px;
  width: 15px;
  border-top-left-radius: 15px;
  box-shadow: -5px -5px 0 2px #ffffff;
}

.cardUsers .top-section .icons {
  position: absolute;
  top: 0;
  width: 100%;
  height: 28px;
  display: flex;
  justify-content: space-between;
}

.cardUsers .top-section .icons .logo {
  height: 100%;
  aspect-ratio: 1;
  padding: 7px 0 7px 15px;
}

.cardUsers .top-section .icons .logo .top-section {
  height: 100%;
}

.cardUsers .top-section .icons .social-media {
  height: 100%;
  padding: 8px 15px;
  display: flex;
  gap: 7px;
}

.cardUsers .top-section .icons .social-media .svg {
  height: 100%;
  fill: #ffffff;
}

.cardUsers .top-section .icons .social-media .svg:hover {
  fill: white;
}

.cardUsers .bottom-section {
  margin-top: 15px;
  padding: 10px 5px;
}

.cardUsers .bottom-section .title {
  display: block;
  font-size: 25px;
  font-weight: bolder;
  color: rgb(0, 0, 0);
  text-align: center;
  letter-spacing: 2px;
}

.cardUsers .bottom-section .row {
  display: flex;
  justify-content: space-between;
  margin-top: 20px;
}

.cardUsers .bottom-section .row .item {
  flex: 30%;
  text-align: center;
  padding: 5px;
  color: rgba(63, 65, 66, 0.721);
}

.cardUsers .bottom-section .row .item .big-text {
  font-size: 18px;
  display: block;
}

.cardUsers .bottom-section .row .item .regular-text {
  font-size: 18px;
}

.cardUsers .bottom-section .row .item:nth-child(2) {
  border-left: 1px solid rgba(255, 255, 255, 0.126);
  border-right: 1px solid rgba(255, 255, 255, 0.126);
}
</style>

@extends('layout.template')

@section('content')
    <div class="container-fluid py-4">
        <div class="row mt-4">
          <div class="col-lg-4 col-md-6 mt-4 mb-4">
            <div class="card z-index-2 ">
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                  <div class="chart">
                    <div class="px-0 pb-2 m-2">
                      <div class="d-flex aling-items-center text-center mb-0">
                        <b class="text-capitalize  font-weight-bolder"  style="text-align: center; color: #ffffff;">

                          Ultimas 5 citas de hoy
                        </b>
                      </div>

                    </div>
                  </div>
                </div>
              </div>

              <div class="card-body">
                <div class="chart">
                  <div class="px-0 pb-2 m-2">
                    <div class="table-responsive p-0 border-radius-lg" style="overflow-x: hidden;background: #ffffff;">
                      <table class="table table-bordered align-items-center mb-0">
                        <thead >
                          <tr>
                            <th class="text-uppercase text-secondary text-s font-weight-bolder" style="text-align: center;">
                              Paciente
                            </th>
                            <th class="text-uppercase text-secondary text-s font-weight-bolder" style="text-align: center;">
                              Sala
                            </th>
                            <th class="text-uppercase text-secondary text-s font-weight-bolder" style="text-align: center;">
                              Hora
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          @if(count($Citas) > 0)
                          @forEach($Citas as $cita)
                          <tr>
                            <td class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7" style="text-align: center;">{{ $cita->primer_apellido }}</td>
                            <td class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7" style="text-align: center;">{{ str_replace('_', ' ', $cita->nombre) }}</td>
                            <td class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7" style="text-align: center;">{{ Carbon::parse($cita->hora_cita)->format('h:i A') }}</td>
                          </tr>
                          @endforeach
                          @else
                          <tr>
                              <td colspan="3" style="text-align: center;">No hay citas disponibles</td>
                          </tr>
                          @endif
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>

                <h6 class="mb-0 ">Citas</h6>
                @if(count($Citas) > 0)
                <p class="text-sm ">Ultimas 5 citas del dia: {{ Carbon::parse($cita->fecha_cita)->isoFormat('dddd D [de] MMMM [de] YYYY') }}</p>
                @else
                <p class="text-sm ">Ultimas 5 citas del dia: {{ Carbon::parse($today)->isoFormat('dddd D [de] MMMM [de] YYYY') }}</p>
                @endif
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 mt-4 mb-4">
            <div class="card z-index-2  ">
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                <div class="bg-gradient-success shadow-success border-radius-lg py-3 pe-1">
                  <div class="chart">
                    <div class="px-0 pb-2 m-2">
                      <div class="d-flex aling-items-center text-center mb-0">
                        <b class="text-capitalize  font-weight-bolder"  style="text-align: center; color: #ffffff;">

                          Ultimas 5 consultas de hoy
                        </b>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-body">

                <div class="chart">
                  <div class="px-0 pb-2 m-2">
                    <div class="table-responsive p-0 border-radius-lg" style="overflow-x: hidden;background: #ffffff;">
                      <table class="table table-bordered align-items-center mb-0">
                        <thead >
                          <tr>
                            <th class="text-uppercase text-secondary text-s font-weight-bolder" style="text-align: center;">
                              Paciente
                            </th>
                            <th class="text-uppercase text-secondary text-s font-weight-bolder" style="text-align: center;">
                              Sala
                            </th>
                            <th class="text-uppercase text-secondary text-s font-weight-bolder" style="text-align: center;">
                              Fecha
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          @if(count($Consultas) > 0)
                          @forEach($Consultas as $Consulta)
                          <tr>
                            <td class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7" style="text-align: center;">{{ $Consulta->primer_apellido }}</td>
                            <td class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7" style="text-align: center;">{{ str_replace('_', ' ', $Consulta->nombre) }}</td>
                            <td class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7" style="text-align: center;">{{ Carbon::parse($Consulta->fecha_visita)->format('h:i A') }}</td>
                          </tr>
                          @endforeach
                          @else
                          <tr>
                              <td colspan="3" style="text-align: center;">No hay consultas disponibles</td>
                          </tr>
                          @endif
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <h6 class="mb-0 "> Consultas </h6>
                @if(count($Consultas) > 0)
                <p class="text-sm ">Ultimas 5 consultas del dia: {{ Carbon::parse($Consulta->fecha_visita)->isoFormat('dddd D [de] MMMM [de] YYYY') }}</p>
                @else
                <p class="text-sm ">Ultimas 5 consultas del dia: {{ Carbon::parse($today)->isoFormat('dddd D [de] MMMM [de] YYYY') }}</p>
                @endif
              </div>
            </div>
          </div>

          <div class="col-lg-4 mt-4 mb-3">
            <div class="card z-index-2 ">
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                <div class="bg-gradient-dark shadow-dark border-radius-lg py-3 pe-1">
                  <div class="chart">
                    <div class="px-0 pb-2 m-2">
                        <div class="d-flex aling-items-center text-center mb-0">
                          <b class="text-capitalize  font-weight-bolder"  style="text-align: center; color: #ffffff;">

                            Ultimas 5 cirugias de hoy
                          </b>
                        </div>
                    </div>
                  </div>

                </div>
              </div>
              <div class="card-body">

                <div class="chart">
                  <div class="px-0 pb-2 m-2">
                    <div class="table-responsive" >
                      <table class="table table-bordered align-items-center mb-0">
                        <thead >
                          <tr>
                            <th class="text-uppercase text-secondary text-s font-weight-bolder" style="text-align: center;">
                              Paciente
                            </th>
                            <th class="text-uppercase text-secondary text-s font-weight-bolder" style="text-align: center;">
                              Sala
                            </th>
                            <th class="text-uppercase text-secondary text-s font-weight-bolder" style="text-align: center;">
                              Fecha
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          @if(count($Cirugias) > 0)
                          @forEach($Cirugias as $Cirugia)
                          <tr>
                            <td class="text-uppercase text-secondary text-xs font-weight-bolder opacity-5" style="text-align: center;"> {{ $Cirugia->primer_apellido }}</td>
                            <td class="text-uppercase text-secondary text-xs font-weight-bolder opacity-5" style="text-align: center;">{{ str_replace('_', ' ', $Cirugia->nombre) }}</td>
                            <td class="text-uppercase text-secondary text-xs font-weight-bolder opacity-5" style="text-align: center;">{{ Carbon::parse($Cirugia->fecha_cirugia)->format('h:i A') }}</td>
                          </tr>
                          @endforeach
                          @else
                          <tr>
                              <td colspan="3" style="text-align: center; border: 1px #c9cbcf ">No hay cirugias disponibles</td>
                          </tr>
                          @endif
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <h6 class="mb-0 ">Cirugias</h6>
                @if(count($Cirugias) > 0)
                <p class="text-sm ">Ultimas 5 cirugias del dia: {{ Carbon::parse($Cirugia->fecha_cirugia)->isoFormat('dddd D [de] MMMM [de] YYYY') }}</p>
                @else
                <p class="text-sm ">Ultimas 5 cirugias del dia: {{ Carbon::parse($today)->isoFormat('dddd D [de] MMMM [de] YYYY') }}</p>
                @endif
              </div>
            </div>
          </div>
        </div>

        @if(auth()->user()->hasRole(['admin','staff']))
        <div class="row mt-4">
          <div class="col-lg-4 col-md-6 mt-4 mb-4">
            <div class="card z-index-2 " style="height: 100%">

              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                  <div class="chart">
                    <div class="px-0 pb-2 m-2">
                        <div class="d-flex aling-items-center text-center mb-0">
                          <b class="text-capitalize  font-weight-bolder"  style="text-align: center; color: #ffffff;">
                            <span class="material-icons" style="font-size: 30p;">
                              bar_chart
                              </span>
                            Probabilidad de tener alguna alergia o enfermedad según tu edad
                          </b>
                        </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="chart" style="height: 100%" >
                <div class="px-0 pb-2 m-2">
                  <div class="table-responsive p-0 border-radius-lg" style="overflow-x: hidden;">
                    <canvas id="datasienschart" style="height: 90%"></canvas>
                  </div>
                </div>
              </div>

            </div>
          </div>

          <div class="col-lg-4 col-md-6 mt-4 mb-4">
            <div class="card z-index-2 ">
              <div class="chart">
                <div class="px-0 pb-2 m-2">
                  <div class="d-flex aling-items-center text-center mb-0">
                    <div class="cardUsers">
                      <div class="top-section">
                        <div class="border"></div>
                        <div class="icons">

                        </div>
                      </div>
                      <div class="bottom-section">
                        <span class="title"> Usuarios: {{ $CountUser}}</span>
                        <div class="row row1">
                          @if($generoCounter > 0)
                          <div class="item">
                            <span class="big-text">
                              @if($generoCounter['masculino'] > 0)
                                {{ $generoCounter['masculino']}}

                              @else
                                0
                              @endif

                            </span>
                            <span class="regular-text">Masculino</span>
                          </div>
                          <div class="item">
                            <span class="big-text">
                              @if($generoCounter['femenino'] > 0)
                                {{ $generoCounter['femenino']}}

                              @else
                              @endif
                            </span>
                            <span class="regular-text">Femenino</span>
                          </div>
                          <div class="item">
                            <span class="big-text">
                              @if($generoCounter['Neutro'] > 0)
                                {{ $generoCounter['Neutro']}}

                              @else
                                0
                              @endif
                            </span>
                            <span class="regular-text">Neutro</span>
                          </div>
                          @else
                          <div class="item">
                            <span class="big-text">
                              0
                            </span>
                            <span class="regular-text">Masculino</span>
                          </div>
                          <div class="item">
                            <span class="big-text">
                              0
                            </span>
                            <span class="regular-text">Femenino</span>
                          </div>
                          <div class="item">
                            <span class="big-text">
                                0
                            </span>
                            <span class="regular-text">Neutro</span>
                          </div>
                          @endif

                        </div>
                      </div>
                    </div>

                    <p class="text-uppercase text-secondary text-xxl font-weight-bolder" style="text-align: center;"></p>
                  </div>
                </div>
              </div>

            </div>
          </div>

          <div class="col-lg-4 col-md-6 mt-4 mb-4">
            <div class="card z-index-2 " style="height: 100%">

              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                <div class="bg-gradient-dark  shadow-primary border-radius-lg py-3 pe-1">
                  <div class="chart">
                    <div class="px-0 pb-2 m-2">
                        <div class="d-flex aling-items-center text-center mb-0">
                          <b class="text-capitalize  font-weight-bolder"  style="text-align: center; color: #ffffff;">
                            <span class="material-icons" style="font-size: 30p;">

                                female
                            </span>
                            usuarios por g&eacute;nero
                          </b>
                        </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="chart">
                <div class="pb-2 m-2">
                  <div class=" border-radius-lg" style="overflow-x: hidden;background: #ffffff;">
                    <canvas id="GeneroChart" style="height: 288px" ></canvas>
                  </div>
                </div>
              </div>

            </div>
          </div>

        </div>

      <div class="row mt-4">
        <div class="col-lg-4 col-md-6 mt-4 mb-4">
          <div class="card z-index-2">

            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
              <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                <div class="chart">
                  <div class="px-0 pb-2 m-2">
                      <div class="d-flex aling-items-center text-center mb-0">
                        <b class="text-capitalize  font-weight-bolder"  style="text-align: center; color: #ffffff;">
                          <span class="material-icons" style="font-size: 30p;">
                            coronavirus
                          </span>
                          usuarios por tipo de alergia
                        </b>
                      </div>
                  </div>
                </div>
              </div>
            </div>


            <div class="chart" style="height: 100%">
              <div class="px-0 pb-2 m-2">
                <div class="table-responsive p-0 border-radius-lg" style="overflow-x: hidden;background: #ffffff;">
                  <canvas id="AlergiaChart" style="height: 288px"></canvas>
                </div>
              </div>
            </div>

          </div>
        </div>

        <div class="col-lg-4 col-md-6 mt-4 mb-4">
          <div class="card z-index-2 ">

            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
              <div class="bg-gradient-success shadow-primary border-radius-lg py-3 pe-1">
                <div class="chart">
                  <div class="px-0 pb-2 m-2">
                      <div class="d-flex aling-items-center text-center mb-0">
                        <b class="text-capitalize  font-weight-bolder"  style="text-align: center; color: #ffffff;">
                          <span class="material-icons" style="font-size: 30p;">
                              sick
                          </span>
                          usuarios por tipo de enfermedad
                        </b>
                      </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="chart">
              <div class="px-0 pb-2 m-2">
                <div class="table-responsive p-0 border-radius-lg" style="overflow-x: hidden;background: #ffffff;">
                  <canvas id="EnfermedadChart" style="height: 288px"></canvas>
                </div>
              </div>
            </div>

          </div>
        </div>

        <div class="col-lg-4 col-md-6 mt-4 mb-4">
          <div class="card z-index-2 ">

            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
              <div class="bg-gradient-dark  shadow-primary border-radius-lg py-3 pe-1">
                <div class="chart">
                  <div class="px-0 pb-2 m-2">
                      <div class="d-flex aling-items-center text-center mb-0">
                        <b class="text-capitalize  font-weight-bolder"  style="text-align: center; color: #ffffff;">
                          <span class="material-icons" style="font-size: 30p;">
                            group
                          </span>
                          usuarios por Edad
                        </b>
                      </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="chart">
              <div class="px-0 pb-2 m-2">
                <div class="table-responsive p-0 border-radius-lg" style="overflow-x: hidden;background: #ffffff;">
                  <canvas id="EdadChart" style="height: 288px" ></canvas>
                </div>
              </div>
            </div>

          </div>
        </div>

      </div>

      @endif
    </div>
    @include('layout.footer')


  @if(auth()->user()->hasRole(['admin','staff']))

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var ctxAlergia = document.getElementById('AlergiaChart').getContext('2d');
            var ctxEnfermedad = document.getElementById('EnfermedadChart').getContext('2d');
            var ctxGenero = document.getElementById('GeneroChart').getContext('2d');
            var ctxEdad = document.getElementById('EdadChart').getContext('2d');
            var ctxdata = document.getElementById('datasienschart').getContext('2d');


            var alergias = @json($alergiaCount);
            var enfermedad = @json($enfermedadCount);
            var UserCounter = @json($CountUser);
            var Genero = @json($generoCounter);
            var porcentajeAlergia = @json($porcentajeAlergia);
            var porcentajeEnfermedad = @json($porcentajeEnfermedad);
            var Edad = @json($edadCounter);
            var labelEnfermeda =  @json($labelEnfermedaFinal);
            var labelAlergia =  @json($labelAlergiFinal);


            const dataChart ={
                datasets: [{
                    type: 'bar',
                    label: 'Enfermedad',
                    data: porcentajeEnfermedad,
                    backgroundColor: [
                      'rgb(255, 170, 207)'

                    ],
                }, {
                    type: 'bar',
                    label: 'Alergia',
                    data: porcentajeAlergia,
                    backgroundColor: [
                      'rgb(234, 143, 234)'
                    ],
                }],
            };

            const dataGenero = {
              labels: Object.keys(Genero),
              datasets: [{
                label: 'data',
                data: Object.values(Genero),
                backgroundColor: [
                  'rgb(255, 199, 199)',
                  'rgb(237, 158, 214)',
                  'rgb(234, 143, 234)'
                ],
                hoverOffset: 4
              }]
            };

            const dataAlergia = {
            labels: labelAlergia,
            datasets: [{
                label : 'usuarios',
                data: alergias,
                backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(255, 205, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(201, 203, 207, 0.2)'
                ]
                ,borderColor: [
                'rgb(255, 99, 132)',
                'rgb(255, 159, 64)',
                'rgb(255, 205, 86)',
                'rgb(75, 192, 192)',
                'rgb(54, 162, 235)',
                'rgb(153, 102, 255)',
                'rgb(201, 203, 207)'
                ],
                borderWidth: 1
            }]
            };

            const dataEnfermedad ={
              labels: labelEnfermeda,
              datasets: [{
                label : 'usuarios',
                data: enfermedad,
                backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(255, 205, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(201, 203, 207, 0.2)'
                ]
                ,borderColor: [
                'rgb(255, 99, 132)',
                'rgb(255, 159, 64)',
                'rgb(255, 205, 86)',
                'rgb(75, 192, 192)',
                'rgb(54, 162, 235)',
                'rgb(153, 102, 255)',
                'rgb(201, 203, 207)'
                ],
                borderWidth: 1
            }]
            };

            const dataEdad ={
              datasets: [{
                label : 'usuarios',
                data: Edad,
                backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(255, 205, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(201, 203, 207, 0.2)'
                ]
                ,borderColor: [
                'rgb(255, 99, 132)',
                'rgb(255, 159, 64)',
                'rgb(255, 205, 86)',
                'rgb(75, 192, 192)',
                'rgb(54, 162, 235)',
                'rgb(153, 102, 255)',
                'rgb(201, 203, 207)'
                ],
                borderWidth: 1
            }]
            };

            var datasienc = new Chart(ctxdata, {
            data: dataChart,
            options: {

              maintainAspectRatio: false,
                scales: {
                  x: {
                    title: {
                        display: true,
                        text: 'Edad'
                    }
                },
                y: {
                  beginAtZero: true, // Establece el valor máximo del eje y al 100%
                  ticks: {
                      callback: function(value) {
                          return value + '%'; // Agrega el símbolo de porcentaje a las etiquetas del eje y
                      }
                  },
                  title: {
                        display: true,
                        text: 'porcentaje'
                    }
                }
              }
            }
            });

            var doughnutGenero = new Chart(ctxGenero,{
              type: 'doughnut',
              data: dataGenero,
              options: {
                      maintainAspectRatio: false,
                    },
            });

            var BarChartAlergia = new Chart( ctxAlergia,{
                    type: 'bar',
                    data: dataAlergia,
                    options: {
                      maintainAspectRatio: false,
                      scales: {
                            x: {
                              title: {
                                  display: true,
                                  text: 'Alergias'
                              }
                          },
                          y: {
                              beginAtZero: true,
                              title: {
                                display: true,
                                  text: 'Usuarios'
                              }
                          }
                      }
                    },
            });

            var BarChartEnfermedad = new Chart( ctxEnfermedad,{
                    type: 'bar',
                    data: dataEnfermedad,
                    options: {
                      maintainAspectRatio: false,
                      scales: {
                            x: {
                              title: {
                                  display: true,
                                  text: 'Enfermedades'
                              }
                          },
                          y: {
                              beginAtZero: true,
                              title: {
                                display: true,
                                  text: 'Usuarios'
                              }
                          }
                      }
                    },
            });

            var BarChartEdad = new Chart( ctxEdad,{
                    type: 'bar',
                    data: dataEdad,
                    options: {
                      maintainAspectRatio: false,
                      scales: {
                            x: {
                              title: {
                                  display: true,
                                  text: 'Edad'
                              }
                          },
                          y: {
                              beginAtZero: true,
                              title: {
                                display: true,
                                  text: 'Usuarios'
                              }
                          }
                      }
                    },
            });




        });
    </script>
  @endif
@endsection

