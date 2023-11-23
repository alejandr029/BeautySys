@php
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

Carbon::setLocale('es');
$user = Auth::user();

@endphp

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
                      <div class="table-responsive p-0 border-radius-lg" style="overflow-x: hidden;background: #ffffff;">
                        <table class="table align-items-center mb-0">
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
                </div>
              </div>

              <div class="card-body">
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
                      <div class="table-responsive p-0 border-radius-lg" style="overflow-x: hidden;background: #ffffff;">
                        <table class="table align-items-center mb-0">
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
                                <td colspan="3" style="text-align: center;">No hay citas disponibles</td>
                            </tr>
                            @endif
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <h6 class="mb-0 "> Consultas </h6>
                @if(count($Consultas) > 0)
                <p class="text-sm ">Ultimas 5 Consultas del dia: {{ Carbon::parse($Consulta->fecha_visita)->isoFormat('dddd D [de] MMMM [de] YYYY') }}</p>
                @else
                <p class="text-sm ">Ultimas 5 Consultas del dia: {{ Carbon::parse($today)->isoFormat('dddd D [de] MMMM [de] YYYY') }}</p>
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
                      <div class="table-responsive p-0 border-radius-lg" style="overflow-x: hidden;background: #ffffff;">
                        <table class="table align-items-center mb-0">
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
                              <td class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7" style="text-align: center;">{{ $Cirugia->primer_apellido }}</td>
                              <td class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7" style="text-align: center;">{{ str_replace('_', ' ', $Cirugia->nombre) }}</td>
                              <td class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7" style="text-align: center;">{{ Carbon::parse($Cirugia->fecha_cirugia)->format('h:i A') }}</td>
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
                </div>
              </div>
              <div class="card-body">
                <h6 class="mb-0 ">Cirugias</h6>
                @if(count($Cirugias) > 0)
                <p class="text-sm ">Ultimas 5 Cirugias del dia: {{ Carbon::parse($Cirugia->fecha_cirugia)->isoFormat('dddd D [de] MMMM [de] YYYY') }}</p>
                @else
                <p class="text-sm ">Ultimas 5 Cirugias del dia: {{ Carbon::parse($today)->isoFormat('dddd D [de] MMMM [de] YYYY') }}</p>
                @endif
              </div>
            </div>
          </div>
        </div>

        @if(auth()->user()->hasRole(['admin','staff']))
      <div class="row mt-4">
        <div class="col-lg-4 col-md-6 mt-4 mb-4">
          <div class="card z-index-2 ">

            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
              <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                <div class="chart">
                  <div class="px-0 pb-2 m-2">
                      <div class="d-flex aling-items-center text-center mb-0">
                        <b class="text-capitalize  font-weight-bolder"  style="text-align: center; color: #ffffff;">
                          <span class="material-icons" style="font-size: 30p;">
                            coronavirus
                          </span>
                          grafico de usuarios por tipo de alergia
                        </b>
                      </div>
                  </div>
                </div>
              </div>
            </div>


            
            <div class="chart">
              <div class="px-0 pb-2 m-2">
                <div class="table-responsive p-0 border-radius-lg" style="overflow-x: hidden;background: #ffffff;">
                  <canvas id="AlergiaChart" width="100" height="100"></canvas>  
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
                            coronavirus
                          </span>
                          grafico de usuarios por tipo de enfermedad
                        </b>
                      </div>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="chart">
              <div class="px-0 pb-2 m-2">
                <div class="table-responsive p-0 border-radius-lg" style="overflow-x: hidden;background: #ffffff;">
                  <canvas id="EnfermedadChart" width="100" height="100"></canvas>  
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
                            coronavirus
                          </span>
                          graficoo de usuarios por genero
                        </b>
                      </div>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="chart">
              <div class="px-0 pb-2 m-2">
                <div class="table-responsive p-0 border-radius-lg" style="overflow-x: hidden;background: #ffffff;">
                  <canvas id="GeneroChart" width="100" height="100"></canvas>  
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


            var alergias = @json($alergiaCount);
            var enfermedad = @json($enfermedadCount);
            var UserCounter = @json($CountUser);
            var Genero = @json($generoCounter);

            console.log(alergias);
            console.log(Genero);

            

            const dataAlergia = {
            datasets: [{
                label : 'data',
                data: alergias,
                backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(255, 205, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(201, 203, 207, 0.2)'
                ],
                borderColor: [
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
              datasets: [{
                label : 'data',
                data: enfermedad,
                backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(255, 205, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(201, 203, 207, 0.2)'
                ],
                borderColor: [
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

            const dataGenero = {
              labels: Object.keys(Genero),
              datasets: [{
                label: 'My First Dataset',
                data: Object.values(Genero),
                backgroundColor: [
                  'rgb(255, 99, 132)',
                  'rgb(54, 162, 235)',
                  'rgb(255, 205, 86)'
                ],
                hoverOffset: 4
              }]
            };

            var BarChartAlergia = new Chart( ctxAlergia,{
                    type: 'bar',
                    data: dataAlergia,
                    options: {
                      // maintainAspectRatio: false,
                      scales: {
                          y: {
                              beginAtZero: true
                          }
                      }
                    },
            });

            var BarChartEnfermedad = new Chart( ctxEnfermedad,{
                    type: 'bar',
                    data: dataEnfermedad,
                    options: {
                      // maintainAspectRatio: false,
                      scales: {
                          y: {
                              beginAtZero: true
                          }
                      }
                    },
            });
            var doughnutGenero = new Chart(ctxGenero,{
              type: 'doughnut',
              data: dataGenero,
              options: {
                      // maintainAspectRatio: false,
                      scales: {
                          y: {
                              beginAtZero: true
                          }
                      }
                    },
            });

          


        });
    </script>
  @endif
@endsection

