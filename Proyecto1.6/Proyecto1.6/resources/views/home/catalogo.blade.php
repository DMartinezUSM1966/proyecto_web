@extends('templates.index')

@section('titulo')
Pagina de Inicio
@endsection

@section('cargo')
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: #ffffff;">
            Usuario
        </a>
        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#">
                <strong>Email:</strong> {{$usuario->email}}
            </a>
            <a class="dropdown-item" href="#">
                <strong>Cargo:</strong> {{$cargo}}
            </a>
        </div>
    </li>
@endsection

@section('contenido')
<style>
    /* Asegura que el html y el body ocupen toda la altura de la pantalla */
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
        font-family: "Orelega One", serif;
        font-weight: 400;
        font-style: normal;
        background-image: url('https://mrwallpaper.com/images/hd/dark-mercedes-benz-amg-iphone-uu830fi3k86b1ih1.jpg');
        background-size: cover;
        background-position: center center;
        background-attachment: fixed;
        color: #000;
    }

    /* Contenedor principal */
    .main-container {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    /* Capa superpuesta sobre la imagen de fondo */
    body::before {
        content: "";
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5); /* Color gris con opacidad */
        z-index: 0;
    }

    /* Asegurar que el contenido esté por encima de la capa de superposición */
    .content {
        position: relative;
        z-index: 1;
    }

    /* Estilo de los elementos de la página */
    .bg-dark {
        background-color: rgba(0, 0, 0, 0.5) !important;
        color: #ffffff !important;
    }

    .text-white {
        color: #ffffff!important;
    }

    .bg-light {
        background-color: rgba(0, 0, 0, 0.8) !important;
    }

    .text-center {
        text-align: center;
    }

    .btn-primary {
        background-color: #312e2e;
        border-color: #f9982f;
    }

    .btn-primary:hover {
        background-color: #b0854a;
        border-color: #b0854a;
    }

    .card {
        background-color: rgba(74, 74, 74, 0.8); /* Color de fondo oscuro para las tarjetas con transparencia */
        border: none;
        color: #f9982f;
        height: 200px; /* Altura fija de las tarjetas */
        margin-bottom: 20px; /* Espacio entre las tarjetas */
        display: flex; /* Flexbox para alinear contenido */
        flex-direction: column; /* Alinear contenido en columna */
        justify-content: center; /* Centrar contenido verticalmente */
        align-items: center; /* Centrar contenido horizontalmente */
        padding: 10px; /* Espaciado interno */
    }

    .card-body {
        text-align: center; /* Alinear texto al centro */
    }

    .card-img-top {
        max-width: 100%; /* Ajusta el tamaño máximo de la imagen */
        height: auto; /* Para mantener la proporción */
        max-height: 80px; /* Altura máxima de la imagen */
        width: auto; /* Permitir ajuste automático del ancho */
    }

    .marca-card:hover {
        transform: scale(1.05);
        transition: transform 0.3s ease;
    }

    .item:hover{
        cursor: pointer;
    }

    /* Estilos personalizados para los enlaces */
    .marca-link {
        text-decoration: none; /* Elimina el subrayado predeterminado */
        color: inherit; /* Hereda el color de texto del contenedor padre */
    }

    .marca-link:hover {
        text-decoration: none; /* Elimina el subrayado en hover */
        color: inherit; /* Hereda el color de texto del contenedor padre en hover */
    }
</style>

<div class="main-container">
    <!-- Encabezado -->
    <header class="bg-dark text-white text-center py-5 content">
        <div class="container">
            <h1 class="display-4">Seleccione marca</h1>
            <p class="lead">Elige entre las siguientes marcas de vehículos</p>
        </div>
    </header>

    <!-- Sección de marcas de vehículos -->
    <section class="text-center content">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-2 item">
                    <a href="{{route('home.lamborghini')}}" class="marca-link">
                        <div class="card bg-dark text-white marca-card">
                            <img class="card-img-top" src="https://1000logos.net/wp-content/uploads/2018/03/Lamborghini-Logo-500x281.png" alt="Marca 1">
                            <div class="card-body">
                                <h5 class="card-title">Lamborghini</h5>
                                <p class="card-text">Modelos Lamborghini</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-2 item">
                    <a href="{{route('home.audi')}}"  class="marca-link">
                        <div class="card bg-dark text-white marca-card">
                            <img class="card-img-top" src="https://www.freepnglogos.com/uploads/audi-logo-27.png" alt="Marca 2">
                            <div class="card-body">
                                <h5 class="card-title">Audi</h5>
                                <p class="card-text">Modelos Audi</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-2 item">
                    <a href="{{route('home.alfaRomeo')}}"  class="marca-link">
                        <div class="card bg-dark text-white marca-card">
                            <img class="card-img-top" src="https://logos-world.net/wp-content/uploads/2021/08/Alfa-Romeo-Logo-1972-2000.png" alt="Marca 3">
                            <div class="card-body">
                                <h5 class="card-title">Alfa Romeo</h5>
                                <p class="card-text">Modelos Alfa Romeo</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-2 item">
                    <a href="{{route('home.ferrari')}}"  class="marca-link">
                        <div class="card bg-dark text-white marca-card">
                            <img class="card-img-top" src="https://i.pinimg.com/originals/4c/ab/f1/4cabf11ca2754891d4d9d20326eca835.png" alt="Marca 4">
                            <div class="card-body">
                                <h5 class="card-title">Ferrari</h5>
                                <p class="card-text">Modelos Ferrari</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-2 item">
                    <a href="{{route('home.mercedesBenz')}}" class="marca-link">
                        <div class="card bg-dark text-white marca-card">
                            <img class="card-img-top" src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/90/Mercedes-Logo.svg/2048px-Mercedes-Logo.svg.png" alt="Marca 5">
                            <div class="card-body">
                                <h5 class="card-title">Mercedes Benz</h5>
                                <p class="card-text">Modelos Mercedes Benz</p>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- Agrega más tarjetas según sea necesario -->
            </div>
        </div>
    </section>

    <!-- Pie de página -->
</div>
@endsection

<!-- Agregar scripts de Bootstrap necesarios -->
@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min
@endsection