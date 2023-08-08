@php
use Carbon\Carbon;
@endphp

@extends('layout.template')

@section('content')

    <!-- Navbar -->
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row mt-4">
        <div class="col-lg-4 col-md-6 mt-4 mb-4">
          <div class="card z-index-2 ">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
              <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                <div class="chart">
                  <div class="px-0 pb-2 m-2">
                    <div class="table-responsive p-0 border-radius-lg" style="overflow-x: hidden;background: #ffffff; border-radius: ">
                      <table class="table align-items-center mb-0">
                        <thead >
                          <tr>
                            <th class="text-uppercase text-secondary text-s font-weight-bolder" style="text-align: center;">
                              Paciente
                            </th>
                            <th class="text-uppercase text-secondary text-s font-weight-bolder" style="text-align: center;">
                              Tipo Cita
                            </th>
                            <th class="text-uppercase text-secondary text-s font-weight-bolder" style="text-align: center;">
                              Fecha
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          @forEach($Citas as $cita)
                          <tr>
                            <td class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7" style="text-align: center;">{{ $cita->primer_apellido }}</td>
                            <td class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7" style="text-align: center;">{{ str_replace('_', ' ', $cita->nombre) }}</td>
                            <td class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7" style="text-align: center;">{{ Carbon::parse($cita->fecha_cita)->format('Y-m-d') }}</td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                  {{-- <canvas id="chart-bars" class="chart-canvas" height="170"></canvas> --}}
                </div>
              </div>
            </div>
            <div class="card-body">
              <h6 class="mb-0 ">Citas</h6>
              <p class="text-sm ">Ultimas 5 citas</p>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 mt-4 mb-4">
          <div class="card z-index-2  ">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
              <div class="bg-gradient-success shadow-success border-radius-lg py-3 pe-1">
                <div class="chart">
                  <div class="px-0 pb-2 m-2">
                    <div class="table-responsive p-0 border-radius-lg" style="overflow-x: hidden;background: #ffffff; border-radius: ">
                      <table class="table align-items-center mb-0">
                        <thead >
                          <tr>
                            <th class="text-uppercase text-secondary text-s font-weight-bolder" style="text-align: center;">
                              Paciente
                            </th>
                            <th class="text-uppercase text-secondary text-s font-weight-bolder" style="text-align: center;">
                              Tipo Cita
                            </th>
                            <th class="text-uppercase text-secondary text-s font-weight-bolder" style="text-align: center;">
                              Fecha
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          @forEach($Citas as $cita)
                          <tr>
                            <td class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7" style="text-align: center;">{{ $cita->primer_apellido }}</td>
                            <td class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7" style="text-align: center;">{{ str_replace('_', ' ', $cita->nombre) }}</td>
                            <td class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7" style="text-align: center;">{{ Carbon::parse($cita->fecha_cita)->format('Y-m-d') }}</td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                  {{-- <canvas id="chart-line" class="chart-canvas" height="170"></canvas> --}}
                </div>
              </div>
            </div>
            <div class="card-body">
              <h6 class="mb-0 "> Consultas </h6>
              <p class="text-sm "> Ultimas 5 consultas </p>
            </div>
          </div>
        </div>
        <div class="col-lg-4 mt-4 mb-3">
          <div class="card z-index-2 ">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
              <div class="bg-gradient-dark shadow-dark border-radius-lg py-3 pe-1">
                <div class="chart">
                  <div class="px-0 pb-2 m-2">
                    <div class="table-responsive p-0 border-radius-lg" style="overflow-x: hidden;background: #ffffff; border-radius: ">
                      <table class="table align-items-center mb-0">
                        <thead >
                          <tr>
                            <th class="text-uppercase text-secondary text-s font-weight-bolder" style="text-align: center;">
                              Paciente
                            </th>
                            <th class="text-uppercase text-secondary text-s font-weight-bolder" style="text-align: center;">
                              Tipo Cita
                            </th>
                            <th class="text-uppercase text-secondary text-s font-weight-bolder" style="text-align: center;">
                              Fecha
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          @forEach($Citas as $cita)
                          <tr>
                            <td class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7" style="text-align: center;">{{ $cita->primer_apellido }}</td>
                            <td class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7" style="text-align: center;">{{ str_replace('_', ' ', $cita->nombre) }}</td>
                            <td class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7" style="text-align: center;">{{ Carbon::parse($cita->fecha_cita)->format('Y-m-d') }}</td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                  {{-- <canvas id="chart-line-tasks" class="chart-canvas" height="170"></canvas> --}}
                </div>
              </div>
            </div>
            <div class="card-body">
              <h6 class="mb-0 ">Cirugias</h6>
              <p class="text-sm ">Ultimas 5 cirugias</p>
            </div>
          </div>
        </div>
      </div>


      @include('layout.footer')
    </div>
  </main>

@endsection
