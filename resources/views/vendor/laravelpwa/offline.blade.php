{{--@extends('layouts.app')--}}

{{--@section('content')--}}

{{--    <h1>You are currently not connected to any networks.</h1>--}}

{{--@endsection--}}

<nav class="navbar navbar-default navbar-transparent navbar-fixed-top" style="background-color:#e78b90 " color-on-scroll="200">
    <!-- if you want to keep the navbar hidden you can add this class to the navbar "navbar-burger"-->
    <div class="container">
        <div class="navbar-header">
            <button id="menu-toggle" type="button" class="navbar-toggle" data-toggle="collapse" data-target="#example">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar bar1"></span>
                <span class="icon-bar bar2"></span>
                <span class="icon-bar bar3"></span>
            </button>
            <a class="navbar-brand">
                BeautySys
            </a>
        </div>
{{--        <div class="">--}}
{{--            <ul class="nav navbar-nav navbar-right navbar-uppercase">--}}
{{--                <li>--}}
{{--                    <a href="/IniciarSesion" class="btn btn-danger btn-fill" style="border: 2px solid #ffafb4;">Iniciar sesion</a>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <a href="/Registro" class="btn btn-danger btn-fill" style="border: 2px solid #ffafb4;" >Registrar</a>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--        </div>--}}
        <!-- /.navbar-collapse -->
    </div>
</nav>

<div class="section section-header">
    <div class="parallax filter filter-color-red">
        <div class="image"
             style="background-image: url('images/icons/icon.png'); background-size: contain; height: 160vh;">
        </div>
        <div class="container">
            <div class="content">
                <div class="title-area">
                    <h1 class="title-modern">BeautySys</h1>
                    <h3> No tienes conexion a Intenet </h2>
                        <div class="separator line-separator">♦</div>
                </div>
            </div>
        </div>
    </div>
</div>
