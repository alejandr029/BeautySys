@php
    use Illuminate\Support\Facades\Auth;
    $user = Auth::user();
@endphp

<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="shortcut icon" sizes="76x76" href="../assets/img/logos/logoproyecto8b.png">
  <link rel="icon" type="image/png" href="../assets/img/logos/logoproyecto8b">
  <title>
      BeautySys
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.1.0" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/js/app.js'])

    <link rel="stylesheet" href="{{ asset('assets/css/loader.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/tabla.css') }}">



    <script src="{{ asset('assets/js/loader.js') }}"></script>


    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/chartjs.min.js"></script>



  {{-- CALENDARIO LINKS --}}
  {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/locale/es.js"></script>

    {{--  PWA  --}}
    @laravelPWA
</head>


<style>
  .backbutton{
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background-color: #fff;
    border: none;
    font-weight: 600;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.164);
    cursor: pointer;
    transition-duration: .3s;
    overflow: hidden;
    position: relative;
  }

  body{
    background-image: url('../assets/img/logos/background-image.jpg'); background-size: cover;
  }

  .aside-menu {
      fill: #232525;
  }

</style>

<body class="g-sidenav-show  bg-gray-200">
  @include('loader')

  <div class="offcanvas offcanvas-start navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-gradient-dark" id="sidenav-main">
      <div class="offcanvas-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0 d-flex align-items-center" target="_blank">
        <img src="../assets/img/logos/logoproyecto8b.png" class="navbar-brand-img h-100" alt="main_logo" style="max-height: 3rem;">
        <span class="ms-1 font-weight-bold text-white">BeautySys</span>
      </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
      <div class="offcanvas-body">
        <ul class="navbar-nav">
            <li class="nav-item" id="admin_dashboard">
                <a class="nav-link text-white <?php echo session('activeTab') === 'Dashboard' ? 'active bg-gradient-primary' : ''; ?>" href="{{ route('dashboard') }}" onclick="mostrarLoader()">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">dashboard</i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            @if(auth()->user()->hasRole(['admin', 'staff']))
                <!-- Solo se muestra el tab "Inventario" para los roles admin y staff -->

                <li class="nav-item">
                    <a class="nav-link text-white <?php echo session('activeTab') === 'Citas' ? 'active bg-gradient-primary' : ''; ?>" href="{{ route('Citas.index') }}" onclick="mostrarLoader()">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <!-- Icono de calendario -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-calendar" viewBox="0 0 16 16">
                                <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2V5H0V2zm14 2h1v1h-1V4zm-3 0h1v1h-1V4zM5 4h1v1H5V4zM2 4h1v1H2V4zM0 6h16v9H0V6zm2 1v2h3V7H2zm5 0v2h3V7H7zm5 0v2h3V7h-3z"/>
                            </svg>
                        </div>
                        <span class="nav-link-text ms-1">Citas</span>
                    </a>
                </li>

                <li class="nav-item">
                  <a class="nav-link text-white <?php echo session('activeTab') === 'Consultas' ? 'active bg-gradient-primary' : ''; ?>" href="{{ route('consultas.index') }}" onclick="mostrarLoader()">
                      <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-check-fill" viewBox="0 0 16 16">
                          <path d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2zm-5.146-5.146-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708.708z"/>
                        </svg>
                      </div>
                      <span class="nav-link-text ms-1">Consultas</span>
                  </a>
                </li>

                <li class="nav-item">
                  <a class="nav-link text-white <?php echo session('activeTab') === 'Cirugias' ? 'active bg-gradient-primary' : ''; ?>" href="{{ route('tablaCirugia') }}" onclick="mostrarLoader()">
                      <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <img src="../assets/img/icons/Cirugia.png" style="width: 20px">
                      </div>
                      <span class="nav-link-text ms-1">Cirugia</span>
                  </a>
              </li>


                <li class="nav-item">
                    <a class="nav-link text-white <?php echo session('activeTab') === 'Inventario' ? 'active bg-gradient-primary' : ''; ?>" href="{{ route('Inventario.index') }}" onclick="mostrarLoader()">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-box-seam-fill" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M15.528 2.973a.75.75 0 0 1 .472.696v8.662a.75.75 0 0 1-.472.696l-7.25 2.9a.75.75 0 0 1-.557 0l-7.25-2.9A.75.75 0 0 1 0 12.331V3.669a.75.75 0 0 1 .471-.696L7.443.184l.01-.003.268-.108a.75.75 0 0 1 .558 0l.269.108.01.003 6.97 2.789ZM10.404 2 4.25 4.461 1.846 3.5 1 3.839v.4l6.5 2.6v7.922l.5.2.5-.2V6.84l6.5-2.6v-.4l-.846-.339L8 5.961 5.596 5l6.154-2.461L10.404 2Z"/>
                          </svg>
                        </div>
                        <span class="nav-link-text ms-1">Inventario</span>
                    </a>
                </li>
            @endif

            @if(auth()->user()->hasRole(['admin']))
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Acciones de Administrador</h6>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white <?php echo session('activeTab') === 'Proveedor' ? 'active bg-gradient-primary' : ''; ?>"  href="{{ route('tablaProvedor') }}" onclick="mostrarLoader()">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                      <i class="material-icons">local_shipping</i>
                    </div>
                    <span class="nav-link-text ms-1">Proveedores</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white <?php echo session('activeTab') === 'Cuentas' ? 'active bg-gradient-primary' : ''; ?>" href="{{ route('Cuentas.index') }}" onclick="mostrarLoader()">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <!-- Aquí puedes agregar un icono o cualquier otro elemento que desees -->
                        <i class="material-icons">person_add</i>
                    </div>
                    <span class="nav-link-text ms-1">Cuentas</span>
                </a>
            </li>

            <li class="nav-item">
              <a class="nav-link text-white <?php echo session('activeTab') === 'Restauracion' ? 'active bg-gradient-primary' : ''; ?>" href="{{ route('restauracion.index') }}" onclick="mostrarLoader()">
                  <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                      <!-- Aquí puedes agregar un icono o cualquier otro elemento que desees -->
                      <i class="fas fa-database"></i>
                  </div>
                  <span class="nav-link-text ms-1">Base de Datos</span>
              </a>
          </li>
            @endif

            @if(auth()->user()->hasRole(['user']))


            <li class="nav-item">
                <a class="nav-link text-white <?php echo session('activeTab') === 'CitasUsuarios' ? 'active bg-gradient-primary' : ''; ?>" href="{{ route('CitasUsuarios.index') }}" onclick="mostrarLoader()">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <!-- Icono de calendario -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-calendar" viewBox="0 0 16 16">
                            <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2V5H0V2zm14 2h1v1h-1V4zm-3 0h1v1h-1V4zM5 4h1v1H5V4zM2 4h1v1H2V4zM0 6h16v9H0V6zm2 1v2h3V7H2zm5 0v2h3V7H7zm5 0v2h3V7h-3z"/>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Agendar Cita</span>
                </a>
            </li>

            <li class="nav-item">
              <a class="nav-link text-white <?php echo session('activeTab') === 'Calendario' ? 'active bg-gradient-primary' : ''; ?>" href="{{ route('Calendario', Auth::user()->id) }}" onclick="mostrarLoader()">
                  <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                      <!-- Icono de calendario -->
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-event-fill" viewBox="0 0 16 16">
                        <path d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2m-3.5-7h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5"/>
                      </svg>
                  </div>
                  <span class="nav-link-text ms-1">Calendario</span>
              </a>
          </li>

              <li class="nav-item">
                <a class="nav-link text-white <?php echo session('activeTab') === 'Alergias' ? 'active bg-gradient-primary' : ''; ?>" href="{{ route('alergiasTabla', Auth::user()->id) }}" onclick="mostrarLoader()">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <!-- Aquí puedes agregar un icono o cualquier otro elemento que desees -->
                        <img src="../assets/img/icons/alergias.png" style="width: 20px">
                    </div>
                    <span class="nav-link-text ms-1">Alergias</span>
                </a>
              </li>


              <li class="nav-item">
                <a class="nav-link text-white <?php echo session('activeTab') === 'Enfermedad Cronicas' ? 'active bg-gradient-primary' : ''; ?>" href="{{ route('enfermedadesCronicasTabla', Auth::user()->id) }}" onclick="mostrarLoader()">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <!-- Aquí puedes agregar un icono o cualquier otro elemento que desees -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-pulse-fill" viewBox="0 0 16 16">
                          <path d="M1.475 9C2.702 10.84 4.779 12.871 8 15c3.221-2.129 5.298-4.16 6.525-6H12a.5.5 0 0 1-.464-.314l-1.457-3.642-1.598 5.593a.5.5 0 0 1-.945.049L5.889 6.568l-1.473 2.21A.5.5 0 0 1 4 9H1.475Z"/>
                          <path d="M.88 8C-2.427 1.68 4.41-2 7.823 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C11.59-2 18.426 1.68 15.12 8h-2.783l-1.874-4.686a.5.5 0 0 0-.945.049L7.921 8.956 6.464 5.314a.5.5 0 0 0-.88-.091L3.732 8H.88Z"/>
                        </svg>
                      </div>
                    <span class="nav-link-text ms-1">Enfermedades Cronicas</span>
                </a>
              </li>
            @endif
        </ul>
    </div>
  </div>

  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
  <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0 d-flex align-items-center" target="_blank">
          <img src="../assets/img/logos/logoproyecto8b.png" class="navbar-brand-img h-100" alt="main_logo" style="max-height: 3rem;">
          <span class="ms-1 font-weight-bold text-white">BeautySys</span>
      </a>
  </div>
  <hr class="horizontal light mt-0 mb-2">
  <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
      <ul class="navbar-nav">
          <li class="nav-item" id="admin_dashboard">
              <a class="nav-link text-white <?php echo session('activeTab') === 'Dashboard' ? 'active bg-gradient-primary' : ''; ?>" href="{{ route('dashboard') }}" onclick="mostrarLoader()">
                  <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                      <i class="material-icons opacity-10">dashboard</i>
                  </div>
                  <span class="nav-link-text ms-1">Dashboard</span>
              </a>
          </li>
          @if(auth()->user()->hasRole(['admin', 'staff']))
              <!-- Solo se muestra el tab "Inventario" para los roles admin y staff -->

              <li class="nav-item">
                  <a class="nav-link text-white <?php echo session('activeTab') === 'Citas' ? 'active bg-gradient-primary' : ''; ?>" href="{{ route('Citas.index') }}" onclick="mostrarLoader()">
                      <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                          <!-- Icono de calendario -->
                          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-calendar" viewBox="0 0 16 16">
                              <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2V5H0V2zm14 2h1v1h-1V4zm-3 0h1v1h-1V4zM5 4h1v1H5V4zM2 4h1v1H2V4zM0 6h16v9H0V6zm2 1v2h3V7H2zm5 0v2h3V7H7zm5 0v2h3V7h-3z"/>
                          </svg>
                      </div>
                      <span class="nav-link-text ms-1">Citas</span>
                  </a>
              </li>

              <li class="nav-item">
                  <a class="nav-link text-white <?php echo session('activeTab') === 'Consultas' ? 'active bg-gradient-primary' : ''; ?>" href="{{ route('consultas.index') }}" onclick="mostrarLoader()">
                      <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-check-fill" viewBox="0 0 16 16">
                              <path d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2zm-5.146-5.146-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708.708z"/>
                          </svg>
                      </div>
                      <span class="nav-link-text ms-1">Consultas</span>
                  </a>
              </li>

              <li class="nav-item">
                  <a class="nav-link text-white <?php echo session('activeTab') === 'Cirugias' ? 'active bg-gradient-primary' : ''; ?>" href="{{ route('tablaCirugia') }}" onclick="mostrarLoader()">
                      <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                          <img src="../assets/img/icons/Cirugia.png" style="width: 20px">
                      </div>
                      <span class="nav-link-text ms-1">Cirugia</span>
                  </a>
              </li>


              <li class="nav-item">
                  <a class="nav-link text-white <?php echo session('activeTab') === 'Inventario' ? 'active bg-gradient-primary' : ''; ?>" href="{{ route('Inventario.index') }}" onclick="mostrarLoader()">
                      <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-box-seam-fill" viewBox="0 0 16 16">
                              <path fill-rule="evenodd" d="M15.528 2.973a.75.75 0 0 1 .472.696v8.662a.75.75 0 0 1-.472.696l-7.25 2.9a.75.75 0 0 1-.557 0l-7.25-2.9A.75.75 0 0 1 0 12.331V3.669a.75.75 0 0 1 .471-.696L7.443.184l.01-.003.268-.108a.75.75 0 0 1 .558 0l.269.108.01.003 6.97 2.789ZM10.404 2 4.25 4.461 1.846 3.5 1 3.839v.4l6.5 2.6v7.922l.5.2.5-.2V6.84l6.5-2.6v-.4l-.846-.339L8 5.961 5.596 5l6.154-2.461L10.404 2Z"/>
                          </svg>
                      </div>
                      <span class="nav-link-text ms-1">Inventario</span>
                  </a>
              </li>
          @endif

          @if(auth()->user()->hasRole(['admin']))
              <li class="nav-item mt-3">
                  <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Acciones de Administrador</h6>
              </li>

              <li class="nav-item">
                  <a class="nav-link text-white <?php echo session('activeTab') === 'Proveedor' ? 'active bg-gradient-primary' : ''; ?>"  href="{{ route('tablaProvedor') }}" onclick="mostrarLoader()">
                      <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                          <i class="material-icons">local_shipping</i>
                      </div>
                      <span class="nav-link-text ms-1">Proveedores</span>
                  </a>
              </li>

              <li class="nav-item">
                  <a class="nav-link text-white <?php echo session('activeTab') === 'Cuentas' ? 'active bg-gradient-primary' : ''; ?>" href="{{ route('Cuentas.index') }}" onclick="mostrarLoader()">
                      <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                          <!-- Aquí puedes agregar un icono o cualquier otro elemento que desees -->
                          <i class="material-icons">person_add</i>
                      </div>
                      <span class="nav-link-text ms-1">Cuentas</span>
                  </a>
              </li>

              <li class="nav-item">
                  <a class="nav-link text-white <?php echo session('activeTab') === 'Restauracion' ? 'active bg-gradient-primary' : ''; ?>" href="{{ route('restauracion.index') }}" onclick="mostrarLoader()">
                      <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                          <!-- Aquí puedes agregar un icono o cualquier otro elemento que desees -->
                          <i class="fas fa-database"></i>
                      </div>
                      <span class="nav-link-text ms-1">Base de Datos</span>
                  </a>
              </li>
          @endif

          @if(auth()->user()->hasRole(['user']))


              <li class="nav-item">
                  <a class="nav-link text-white <?php echo session('activeTab') === 'CitasUsuarios' ? 'active bg-gradient-primary' : ''; ?>" href="{{ route('CitasUsuarios.index') }}" onclick="mostrarLoader()">
                      <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                          <!-- Icono de calendario -->
                          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-calendar" viewBox="0 0 16 16">
                              <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2V5H0V2zm14 2h1v1h-1V4zm-3 0h1v1h-1V4zM5 4h1v1H5V4zM2 4h1v1H2V4zM0 6h16v9H0V6zm2 1v2h3V7H2zm5 0v2h3V7H7zm5 0v2h3V7h-3z"/>
                          </svg>
                      </div>
                      <span class="nav-link-text ms-1">Agendar Cita</span>
                  </a>
              </li>

              <li class="nav-item">
                  <a class="nav-link text-white <?php echo session('activeTab') === 'Calendario' ? 'active bg-gradient-primary' : ''; ?>" href="{{ route('Calendario', Auth::user()->id) }}" onclick="mostrarLoader()">
                      <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                          <!-- Icono de calendario -->
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-event-fill" viewBox="0 0 16 16">
                              <path d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2m-3.5-7h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5"/>
                          </svg>
                      </div>
                      <span class="nav-link-text ms-1">Calendario</span>
                  </a>
              </li>

              <li class="nav-item">
                  <a class="nav-link text-white <?php echo session('activeTab') === 'Alergias' ? 'active bg-gradient-primary' : ''; ?>" href="{{ route('alergiasTabla', Auth::user()->id) }}" onclick="mostrarLoader()">
                      <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                          <!-- Aquí puedes agregar un icono o cualquier otro elemento que desees -->
                          <img src="../assets/img/icons/alergias.png" style="width: 20px">
                      </div>
                      <span class="nav-link-text ms-1">Alergias</span>
                  </a>
              </li>


              <li class="nav-item">
                  <a class="nav-link text-white <?php echo session('activeTab') === 'Enfermedad Cronicas' ? 'active bg-gradient-primary' : ''; ?>" href="{{ route('enfermedadesCronicasTabla', Auth::user()->id) }}" onclick="mostrarLoader()">
                      <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                          <!-- Aquí puedes agregar un icono o cualquier otro elemento que desees -->
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-pulse-fill" viewBox="0 0 16 16">
                              <path d="M1.475 9C2.702 10.84 4.779 12.871 8 15c3.221-2.129 5.298-4.16 6.525-6H12a.5.5 0 0 1-.464-.314l-1.457-3.642-1.598 5.593a.5.5 0 0 1-.945.049L5.889 6.568l-1.473 2.21A.5.5 0 0 1 4 9H1.475Z"/>
                              <path d="M.88 8C-2.427 1.68 4.41-2 7.823 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C11.59-2 18.426 1.68 15.12 8h-2.783l-1.874-4.686a.5.5 0 0 0-.945.049L7.921 8.956 6.464 5.314a.5.5 0 0 0-.88-.091L3.732 8H.88Z"/>
                          </svg>
                      </div>
                      <span class="nav-link-text ms-1">Enfermedades Cronicas</span>
                  </a>
              </li>
          @endif
      </ul>
  </div>
  </aside>

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <nav class="navbar navbar-main px-0 mx-2 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
      <div class="container-fluid py-1" style="display: inline-flex; justify-content: space-between">
            <div style="display: inline-flex; gap: 8px; align-items: center">
                <button id="backButton" class="backbutton aside-menu" onclick="goBack(); mostrarLoader();" style="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                    </svg>
                </button>

                <a class="border-0 d-lg-none aside-menu backbutton" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidenav-main" aria-controls="sidenav-main">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" style="width: 16px;"><path d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z"/></svg>
                </a>

                <h3 class="font-weight-bolder mb-0 px-2 d-none d-lg-block"><?php echo session('activeTab')?></h3>
            </div>

          <script>
            function goBack() {
              window.history.back();
            }
          </script>

          <script>
            document.addEventListener('DOMContentLoaded', function() {
            var userRoles = @json(auth()->user()->roles);
            var tabAdminStaff = document.getElementById("admin_dashboard");
            var tabUser = document.getElementById("user_dashboard");

            if (userRoles.includes('admin') || userRoles.includes('staff')) {
            tabAdminStaff.click();
            } else {
            tabUser.click();
            }
          });
          </script>

            <div>
                @livewire('navigation-menu')
            </div>
      </div>

        <h3 class="font-weight-bolder mb-0 px-3 d-lg-none"><?php echo session('activeTab')?></h3>
    </nav>
    @yield('content')
  </main>
</body>

</html>
