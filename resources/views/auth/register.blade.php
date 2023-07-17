<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" sizes="76x76" href="../assets/img/logos/logoproyecto8b.png">
    <link rel="icon" type="image/png" href="../assets/img/logos/logoproyecto8b">
    <title>
        Material Dashboard 2 by Creative Tim
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
                                    <h4 class="font-weight-bolder">Sign Up</h4>
                                    <p class="mb-0">Enter your email and password to register</p>
                                </div>
                                <div class="card-body">
                                    <x-validation-errors class="mb-4" />

                                    <form method="POST" action="{{ route('register') }}">
                                        @csrf

                                        <div class="input-group input-group-outline mb-3">
                                            <x-label for="name" value="{{ __('Name') }}" class="form-label" />
                                            <x-input id="name" class="form-control" type="text" name="name"
                                                :value="old('name')" required autofocus autocomplete="name" />
                                        </div>

                                        <div class="input-group input-group-outline mb-3">
                                            <x-label for="email" value="{{ __('Email') }}" class="form-label" />
                                            <x-input id="email" class="form-control" type="email" name="email"
                                                :value="old('email')" required autocomplete="username" />
                                        </div>

                                        <div class="input-group input-group-outline mb-3">
                                            <x-label for="password" value="{{ __('Password') }}" class="form-label" />
                                            <x-input id="password" class="form-control" type="password" name="password"
                                                required autocomplete="new-password" />
                                        </div>

                                        <div class="input-group input-group-outline mb-3">
                                            <x-label for="password_confirmation" value="{{ __('Confirm Password') }}"
                                                class="form-label" />
                                            <x-input id="password_confirmation" class="form-control" type="password"
                                                name="password_confirmation" required autocomplete="new-password" />
                                        </div>

                                        <div class="form-check form-check-info text-start ps-0">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="flexCheckDefault" checked required>
                                            <label class="form-label" for="flexCheckDefault">
                                                I agree the <a href="javascript:;"
                                                    class="text-dark font-weight-bolder">Terms and Conditions</a>
                                            </label>
                                        </div>

                                        <div class="text-center">
                                            <x-button class="btn btn-lg bg-gradient-primary btn-lg w-100 mt-4 mb-0">
                                                {{ __('Register') }}
                                            </x-button>
                                        </div>
                                        <br>
                                        <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                                href="{{ route('login') }}">
                                                {{ __('Already registered?') }}
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
