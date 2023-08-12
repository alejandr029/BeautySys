@php
use Carbon\Carbon;
Carbon::setLocale('es');

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
                      <div class="table-responsive p-0 border-radius-lg" style="overflow-x: hidden;background: #ffffff; border-radius: ">
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
                      <div class="table-responsive p-0 border-radius-lg" style="overflow-x: hidden;background: #ffffff; border-radius: ">
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


      @include('layout.footer')
    </div>

  </main>

@endsection
