<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="images/icons/icon.ico">
    <link rel="icon" type="ico" sizes="96x96" href="images/icons/icon.ico">

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Beautysys</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <link href="assets/assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/assets/css/gaia.css" rel="stylesheet"/>

    <!--     Fonts and icons     -->
    <link href='https://fonts.googleapis.com/css?family=Cambo|Poppins:400,600' rel='stylesheet' type='text/css'>
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/assets/css/fonts/pe-icon-7-stroke.css" rel="stylesheet">

   <link rel="stylesheet" href="{{ asset('assets/css/loader.css') }}">

    <script src="{{ asset('assets/js/loader.js') }}"></script>

    {{--  PWA  --}}
    @laravelPWA
</head>
{{-- @extends('layout.landing') --}}

 {{-- <nav class="navbar navbar-default navbar-transparent navbar-fixed-top" style="background-color:#e78b90 " color-on-scroll="200">
    <!-- if you want to keep the navbar hidden you can add this class to the navbar "navbar-burger"-->
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand">
                BeautySys
            </a>
        </div>
       <div class="">
           <ul class="nav navbar-nav navbar-right navbar-uppercase">
               <li>
                   <a href="/IniciarSesion" class="btn btn-danger btn-fill" style="border: 2px solid #ffafb4;">Iniciar sesion</a>
               </li>
               <li>
                   <a href="/Registro" class="btn btn-danger btn-fill" style="border: 2px solid #ffafb4;" >Registrar</a>
               </li>
           </ul>
       </div>
        <!-- /.navbar-collapse -->
    </div>
</nav>  --}}

<div class="section section-header">
    <div class="parallax filter filter-color-red">
        <div class="image"
             style="background-image: url('images/icons/icon.png'); background-size: contain; height: 160vh;">
        </div>
        <div class="container">
            <div class="content">
                <div class="title-area">
                    <h1 class="title-modern">BeautySys</h1>
                    <h3> No tienes conexion a Intenet </h3>
                        <div class="separator line-separator">♦</div>
                </div>
            </div>
        </div>
    </div>
</div>
