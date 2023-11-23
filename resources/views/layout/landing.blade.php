<style>
    html ::-webkit-scrollbar{
        display: none;
    }
</style>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/logos/logoproyecto8b.png">

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

</head>

<body>
    @include('loader')
    

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
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right navbar-uppercase">
                    {{-- <li>
                        <a href="http://www.creative-tim.com/product/gaia-bootstrap-template-pro" target="_blank">Get PRO Version</a>
                    </li> --}}
                    {{-- <li class="dropdown">
                        <a href="#gaia" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-share-alt"></i> Share
                        </a>
                        <ul class="dropdown-menu dropdown-danger">
                            <li>
                                <a href="#"><i class="fa fa-facebook-square"></i> Facebook</a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-twitter"></i> Twitter</a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-instagram"></i> Instagram</a>
                            </li>
                        </ul>
                    </li> --}}
                    <li>
                            <a href="/IniciarSesion" target="_blank" class="btn btn-danger btn-fill" style="border: 2px solid #ffafb4;">Iniciar sesion</a>
                    </li>
                    <li>
                        <a href="/Registro" target="_blank" class="btn btn-danger btn-fill" style="border: 2px solid #ffafb4;" >Registrar</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
    </nav>

    <div class="section section-header">
        <div class="parallax filter filter-color-red">
            <div class="image"
                style="background-image: url('assets/img/logos/logoproecto.png'); background-size: contain; height: 160vh;">
            </div>
            <div class="container">
                <div class="content">
                    <div class="title-area">
                        <h1 class="title-modern">BeautySys</h1>
                        <h3>Un proyecto creado por <b>TASKLAB</b> </h2>
                        <div class="separator line-separator">♦</div>
                    </div>

                    {{-- <div class="button-get-started">
                        <a href="http://www.creative-tim.com/product/gaia-bootstrap-template" target="_blank" class="btn btn-white btn-fill btn-lg ">
                            Download Demo
                        </a>
                    </div> --}}
                </div>

            </div>
        </div>
    </div>


    <div class="section">
        <div class="container">
            <div class="row">
                <div class="title-area">
                    <h2>Acerca del servicio</h2>
                    <div class="separator separator-danger">✻</div>
                    <p class="description">La empresa TASKLAB se tomo como principal enfoque y objetivo el de
                        desarrollar un sistema integral para el monitoreo y gestión de registros de cirugías estéticas. Este sistema se
                        generara con el fin de obtener una mejor eficiencia de registros como también tener una mayor seguridad de datos
                        y obtener así una mejor calidad de atención hacia el cliente</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="info-icon">
                        <div class="icon text-danger">
                            <i class="pe-7s-display1"></i>
                        </div>
                        <h3>Transformando la Gestión de Cirugías Estéticas </h3>
                        <p class="description">En TASKLAB, nos enorgullece presentar nuestro compromiso con la excelencia en el ámbito de la cirugía estética. Nuestro objetivo primordial es desarrollar un sistema integral de monitoreo y gestión de registros de cirugías estéticas. Este sistema está diseñado para optimizar la eficiencia en la documentación, fortalecer la seguridad de los datos y elevar la calidad de atención al cliente.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info-icon">
                        <div class="icon text-danger">
                            <i class="pe-7s-look"></i>
                        </div>
                        <h3>Vision <br><br> </h3>
                        <p class="description">Nuestra visión abarca mucho más que solo registros precisos. Buscamos facilitar la gestión y seguimiento de los procedimientos quirúrgicos estéticos para clínicas y sucursales. Al emplear nuestro sistema, las instituciones podrán mantener registros exhaustivos y detallados de cada paciente, asegurando un historial completo y seguro.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info-icon">
                        <div class="icon text-danger">
                            <i class="pe-7s-medal"></i>
                        </div>
                        <h3>Alcance <br><br></h3>
                        <p class="description">Un futuro de atención al paciente más eficiente y personalizado está a tu alcance con TASKLAB. Únete a nosotros en este viaje hacia una gestión de cirugías estéticas más innovadora y confiable.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="section section-our-team-freebie">
        <div class="parallax filter filter-color-black">
            <div class="image" style="background-image:url('assets/img/header-2.jpeg')">
            </div>
            <div class="container">
                <div class="content">
                    <div class="row">
                        <div class="title-area">
                            <h2>Quienes somos?</h2>
                            <div class="separator separator-danger">✻</div>
                            <p class="description">TASKLAB se conforma de un equipo el cual se unio para salvaguardar diferentes sircurcustacion y sobrellevar las nececidades de los usuarios</p>
                        </div>
                    </div>
                    {{-- team --}}
                    <div class="col-8" style="display: flex;justify-content: center;flex-wrap: wrap;">
                        <div class="col-8 col-sm-6 col-md-4">
                            <div class="card card-member">
                                <div class="content" style="height: 40rem;">
                                    <div class="description">
                                        <h3 class="title">De La Mora Vazquez Victor Manuel</h3>
                                        <p class="small-text">Tester y reparacion de bugs</p>
                                        <p class="description">En nuestro equipo de desarrollo, el rol de Tester y Reparación de Bugs es esencial. Esta función implica llevar a cabo pruebas exhaustivas en el sistema de monitoreo y gestión de registros de cirugías estéticas, identificando y reportando problemas y errores. Además, se encarga de analizar y solucionar estos problemas para asegurar que el sistema funcione sin contratiempos y brinde una experiencia confiable a nuestros usuarios.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-8 col-sm-6 col-md-4">
                            <div class="card card-member">
                                <div class="content" style="height: 40rem;">
                                    <div class="description">
                                        <h3 class="title">Noyola Barradas Juan Diego</h3>
                                        <p class="small-text">Tester y reparacion de bugs</p>
                                        <p class="description">En nuestro equipo de desarrollo, En nuestro equipo de desarrollo, el rol de Desarrollador Móvil desempeña una función esencial. Este profesional se encarga de la creación y optimización de aplicaciones móviles para dispositivos iOS y Android. Su labor implica el desarrollo de soluciones innovadoras que mejoren la vida de los usuarios y proporcionen experiencias excepcionales.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-8 col-sm-6 col-md-4">
                            <div class="card card-member">
                                <div class="content" style="height: 40rem;">
                                    <div class="description">
                                        <h3 class="title">Ruiz Alvarez Jose Eduardo</h3>
                                        <p class="small-text">Project Manager y Desarrollador web</p>
                                        <p class="description">En nuestro equipo, contamos con un miembro que desempeña los roles de Project Manager y Desarrollador Web. Esta doble función implica liderar la planificación, coordinación y ejecución de proyectos, asegurando que se cumplan los plazos y objetivos. Además, se encarga del desarrollo web, creando y manteniendo las interfaces que dan vida a nuestro sistema de monitoreo y gestión de registros de cirugías estéticas. Su trabajo garantiza una implementación exitosa y una experiencia fluida para nuestros usuarios.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-8 col-sm-6 col-md-4">
                            <div class="card card-member">
                                <div class="content" style="height: 40rem;">
                                    <div class="description">
                                        <h3 class="title">Toledo Perez Cristian Alejandro</h3>
                                        <p class="small-text">Lider de desarrollo</p>
                                        <p class="description">En nuestro equipo, contamos con un Líder de Desarrollo clave. Este rol desempeña una función crucial al dirigir y supervisar el equipo de desarrollo en la creación y mejora constante de nuestro sistema de monitoreo y gestión de registros de cirugías estéticas. El Líder de Desarrollo coordina las tareas, establece directrices y garantiza que se sigan las mejores prácticas de programación, lo que resulta en un sistema confiable y eficiente que cumple con las necesidades de nuestros usuarios.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-8 col-sm-6 col-md-4">
                            <div class="card card-member">
                                <div class="content" style="height: 40rem;">
                                    <div class="description">
                                        <h3 class="title">Velazquez Gonzalez Jesus Alejandro</h3>
                                        <p class="small-text">Desarrollador de base de datos</p>
                                        <p class="description">Dentro de nuestro equipo, contamos con un Desarrollador de Base de Datos especializado. Este rol es esencial para diseñar, implementar y mantener la estructura de la base de datos que respalda nuestro sistema de monitoreo y gestión de registros de cirugías estéticas. El Desarrollador de Base de Datos trabaja en la optimización del rendimiento, la integridad de los datos y la seguridad de la información almacenada, asegurando que el sistema funcione de manera eficiente y confiable para satisfacer las necesidades de nuestros usuarios.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="team">
                        <div class="row">
                            <div class="col-md-12 ">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="card card-member">
                                            <div class="content" style="height: 40rem;">
                                                <div class="description">
                                                    <h3 class="title">De La Mora Vazquez Victor Manuel</h3>
                                                    <p class="small-text">Tester y reparacion de bugs</p>
                                                    <p class="description">En nuestro equipo de desarrollo, el rol de Tester y Reparación de Bugs es esencial. Esta función implica llevar a cabo pruebas exhaustivas en el sistema de monitoreo y gestión de registros de cirugías estéticas, identificando y reportando problemas y errores. Además, se encarga de analizar y solucionar estos problemas para asegurar que el sistema funcione sin contratiempos y brinde una experiencia confiable a nuestros usuarios.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card card-member">
                                            <div class="content" style="height: 40rem;">
                                                <div class="description">
                                                    <h3 class="title">Ruiz Alvarez Jose Eduardo</h3>
                                                    <p class="small-text">Project Manager y Desarrollador web</p>
                                                    <p class="description">En nuestro equipo, contamos con un miembro que desempeña los roles de Project Manager y Desarrollador Web. Esta doble función implica liderar la planificación, coordinación y ejecución de proyectos, asegurando que se cumplan los plazos y objetivos. Además, se encarga del desarrollo web, creando y manteniendo las interfaces que dan vida a nuestro sistema de monitoreo y gestión de registros de cirugías estéticas. Su trabajo garantiza una implementación exitosa y una experiencia fluida para nuestros usuarios.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="card card-member">
                                            <div class="content" style="height: 40rem;">
                                                <div class="description">
                                                    <h3 class="title">Toledo Perez Cristian Alejandro</h3>
                                                    <p class="small-text">Lider de desarrollo</p>
                                                    <p class="description">En nuestro equipo, contamos con un Líder de Desarrollo clave. Este rol desempeña una función crucial al dirigir y supervisar el equipo de desarrollo en la creación y mejora constante de nuestro sistema de monitoreo y gestión de registros de cirugías estéticas. El Líder de Desarrollo coordina las tareas, establece directrices y garantiza que se sigan las mejores prácticas de programación, lo que resulta en un sistema confiable y eficiente que cumple con las necesidades de nuestros usuarios.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="card card-member">
                                            <div class="content" style="height: 40rem;">
                                                <div class="description">
                                                    <h3 class="title">Velazquez Gonzalez Jesus Alejandro</h3>
                                                    <p class="small-text">Desarrollador de base de datos</p>
                                                    <p class="description">Dentro de nuestro equipo, contamos con un Desarrollador de Base de Datos especializado. Este rol es esencial para diseñar, implementar y mantener la estructura de la base de datos que respalda nuestro sistema de monitoreo y gestión de registros de cirugías estéticas. El Desarrollador de Base de Datos trabaja en la optimización del rendimiento, la integridad de los datos y la seguridad de la información almacenada, asegurando que el sistema funcione de manera eficiente y confiable para satisfacer las necesidades de nuestros usuarios.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>


    {{-- <div class="section section-our-clients-freebie">
        <div class="container">
            <div class="title-area">
                <h5 class="subtitle text-gray">Here are some</h5>
                <h2>Clients Testimonials</h2>
                <div class="separator separator-danger">∎</div>
            </div>

            <ul class="nav nav-text" role="tablist">
                <li class="active">
                    <a href="#testimonial1" role="tab" data-toggle="tab">
                        <div class="image-clients">
                            <img alt="..." class="img-circle" src="assets/img/faces/face_5.jpg"/>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#testimonial2" role="tab" data-toggle="tab">
                        <div class="image-clients">
                            <img alt="..." class="img-circle" src="assets/img/faces/face_6.jpg"/>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#testimonial3" role="tab" data-toggle="tab">
                        <div class="image-clients">
                            <img alt="..." class="img-circle" src="assets/img/faces/face_2.jpg"/>
                        </div>
                    </a>
                </li>
            </ul>


            <div class="tab-content">
                <div class="tab-pane active" id="testimonial1">
                    <p class="description">
                        And I used a period because contrary to popular belief I strongly dislike exclamation points! We no longer have to be scared of the truth feels good to be home In Roman times the artist would contemplate proportions and colors. Now there is only one important color... Green I even had the pink polo I thought I was Kanye I promise I will never let the people down. I want a better life for all!
                    </p>
                </div>
                <div class="tab-pane" id="testimonial2">
                    <p class="description">Green I even had the pink polo I thought I was Kanye I promise I will never let the people down. I want a better life for all! And I used a period because contrary to popular belief I strongly dislike exclamation points! We no longer have to be scared of the truth feels good to be home In Roman times the artist would contemplate proportions and colors. Now there is only one important color...
                    </p>
                </div>
                <div class="tab-pane" id="testimonial3">
                    <p class="description"> I used a period because contrary to popular belief I strongly dislike exclamation points! We no longer have to be scared of the truth feels good to be home In Roman times the artist would contemplate proportions and colors. The 'Gaia' team did a great work while we were collaborating. They provided a vision that was in deep connection with our needs and helped us achieve our goals.
                    </p>
                </div>

            </div>

        </div>
    </div>


    <div class="section section-small section-get-started">
        <div class="parallax filter">
            <div class="image"
                style="background-image: url('assets/img/office-1.jpeg')">
            </div>
            <div class="container">
                <div class="title-area">
                    <h2 class="text-white">Do you want to work with us?</h2>
                    <div class="separator line-separator">♦</div>
                    <p class="description"> We are keen on creating a second skin for anyone with a sense of style! We design our clothes having our customers in mind and we never disappoint!</p>
                </div>

                <div class="button-get-started">
                    <a href="#gaia" class="btn btn-danger btn-fill btn-lg">Contact Us</a>
                </div>
            </div>
        </div>
    </div> --}}


    <footer class="footer footer-big footer-color-black" data-color="black">
        <div class="container">
            <div class="row">
                {{-- <div class="col-md-2 col-sm-3">
                    <div class="info">
                        <h5 class="title">Company</h5>
                        <nav>
                            <ul>
                                <li>
                                    <a href="#">Home</a></li>
                                <li>
                                    <a href="#">Find offers</a>
                                </li>
                                <li>
                                    <a href="#">Discover Projects</a>
                                </li>
                                <li>
                                    <a href="#">Our Portfolio</a>
                                </li>
                                <li>
                                    <a href="#">About Us</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-md-3 col-md-offset-1 col-sm-3">
                    <div class="info">
                        <h5 class="title"> Help and Support</h5>
                         <nav>
                            <ul>
                                <li>
                                    <a href="#">Contact Us</a>
                                </li>
                                <li>
                                    <a href="#">How it works</a>
                                </li>
                                <li>
                                    <a href="#">Terms &amp; Conditions</a>
                                </li>
                                <li>
                                    <a href="#">Company Policy</a>
                                </li>
                                <li>
                                    <a href="#">Money Back</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3">
                    <div class="info">
                        <h5 class="title">Latest News</h5>
                        <nav>
                            <ul>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-twitter"></i> <b>Get Shit Done</b> The best kit in the market is here, just give it a try and let us...
                                        <hr class="hr-small">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-twitter"></i> We've just been featured on <b> Awwwards Website</b>! Thank you everybody for...
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-md-2 col-md-offset-1 col-sm-3">
                    <div class="info">
                        <h5 class="title">Follow us on</h5>
                        <nav>
                            <ul>
                                <li>
                                    <a href="#" class="btn btn-social btn-facebook btn-simple">
                                        <i class="fa fa-facebook-square"></i> Facebook
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="btn btn-social btn-dribbble btn-simple">
                                        <i class="fa fa-dribbble"></i> Dribbble
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="btn btn-social btn-twitter btn-simple">
                                        <i class="fa fa-twitter"></i> Twitter
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="btn btn-social btn-reddit btn-simple">
                                        <i class="fa fa-google-plus-square"></i> Google+
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div> --}}
            </div>
            <hr>
            <div class="copyright">
                 © <script> document.write(new Date().getFullYear()) </script> by BeautySys
            </div>
        </div>
    </footer>

</body>

<!--   core js files    -->
<script src="assets/js/jquery.min.js" type="text/javascript"></script>
<script src="assets/js/bootstrap.js" type="text/javascript"></script>

<!--  js library for devices recognition -->
<script type="text/javascript" src="assets/js/modernizr.js"></script>

<!--  script for google maps   -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>

<!--   file where we handle all the script from the Gaia - Bootstrap Template   -->
<script type="text/javascript" src="assets/js/gaia.js"></script>

</html>