<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" sizes="76x76" href="../assets/img/logos/logoproyecto8b.png">
    <link rel="icon" type="image/png" href="../assets/img/logos/logoproyecto8b">
    <title>
        BeautySys Registro
    </title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons -->
    <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.1.0" rel="stylesheet" />
    <!-- Nepcha Analytics (nepcha.com) -->
    <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
    <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
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

.input-group.input-group-outline.is-focused .form-label,
.input-group.input-group-outline.is-filled .form-label {
  width: 100%;
  height: 100%;
  font-size: 0.6875rem !important;
  color: #e91e63;
  display: flex;
  line-height: 1.25 !important;
  visibility: visible!important;
}
</style>

</head>

<body class="">
    <main class="main-content  mt-0">
        <section>
            <div class="page-header min-vh-100">
                <div class="container">
                    <div class="row">
                        <div
                            class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 start-0 text-center justify-content-center flex-column">
                            <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center"
                                style="background-image: url('../assets/img/logos/sig-up.png'); background-size: cover; background-position-y: center; background-position-x: center">
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column ms-auto me-auto ms-lg-auto me-lg-5">
                            <div class="card card-plain">
                                <div class="card-header">
                                    <h4 class="font-weight-bolder">Registro</h4>
                                    <p class="mb-0">Ingresa tus datos para crear una cuenta de paciente.</p>
                                </div>
                                <div class="card-body">
                                    <x-validation-errors class="mb-4" />

                                    <form method="POST" action="{{ route('register') }}">
                                        @csrf

                                        <div class="input-group input-group-outline mb-3">
                                            <x-label for="name" value="{{ __('Nombre') }}" class="form-label" />
                                            <x-input id="name" class="form-control" type="text" name="name"
                                                :value="old('name')" required autofocus autocomplete="name" />
                                        </div>

                                        <div class="input-group input-group-outline mb-3">
                                            <x-label for="email" value="{{ __('Correo Electronico') }}" class="form-label" />
                                            <x-input id="email" class="form-control" type="email" name="email"
                                                :value="old('email')" required autocomplete="username" />
                                        </div>

                                        <div class="input-group input-group-outline mb-3">
                                            <x-label for="fecha_nacimiento" value="{{ __('Fecha de Nacimiento') }}" class="form-label" style="visibility: hidden" />
                                            <x-input id="fecha_nacimiento" class="form-control" type="date" name="fecha_nacimiento" max="{{ now()->toDateString() }}"
                                            :value="old('fecha_nacimiento')" required autocomplete="fecha_nacimiento"/>
                                        </div>

                                        <div class="input-group input-group-outline mb-3">
                                            <x-label for="telefono" value="{{ __('Numero de Telefono') }}" class="form-label" />
                                            <x-input id="telefono" class="form-control" type="text" name="telefono"
                                                :value="old('telefono')" required autocomplete="telefono" />
                                        </div>

                                        <div class="input-group input-group-outline mb-3">
                                            <x-label for="password" value="{{ __('Contraseña') }}" class="form-label" />
                                            <x-input id="password" class="form-control" type="password" name="password"
                                                required autocomplete="new-password" />
                                        </div>

                                        <div class="input-group input-group-outline mb-3">
                                            <x-label for="password_confirmation" value="{{ __('Confirmar Contraseña') }}"
                                                class="form-label" />
                                            <x-input id="password_confirmation" class="form-control" type="password"
                                                name="password_confirmation" required autocomplete="new-password" />
                                        </div>

                                        <div class="form-check form-check-info text-start ps-0">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="flexCheckDefault" checked required>
                                            <label class="form-label" for="flexCheckDefault">
                                                Acepto los <a href="javascript:;"
                                                    class="text-dark font-weight-bolder">T&eacute;rminos y Condiciones.</a>
                                            </label>
                                        </div>

                                        <div class="text-center">
                                            <x-button class="btn btn-lg bg-gradient-primary btn-lg w-100 mt-4 mb-0">
                                                {{ __('Registrarse') }}
                                            </x-button>
                                        </div>
                                        <br>
                                        <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                                href="{{ route('login') }}">
                                                {{ __('Ya tienes una cuenta?') }}
                                            </a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </main>
    <!--   Core JS Files   -->
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../assets/js/material-dashboard.min.js?v=3.1.0"></script>
</body>

</html>
