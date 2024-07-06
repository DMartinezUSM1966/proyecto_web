@extends('templates.index')

@section('titulo')
Pagina de Inicio
@endsection

@section('cargo')
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: #ffffff;">
            Cuenta
        </a>
        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#">
                <strong>Email:</strong> {{$usuario->email}}
            </a>
            <a class="dropdown-item" href="#">
                <strong>Cargo:</strong> {{$cargo}}
            </a>
            <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#cambiarContraseñaModal">
                Cambiar Contraseña
            </a>
        </div>
    </li>
@endsection

@section('contenido')
<!-- Link de la fuente en la cabecera -->
@section('head')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Orelega+One&display=swap" rel="stylesheet">
@endsection

<style>
    /* Estilos para la página de inicio */
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

    .main-container {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    .content {
        position: relative;
        z-index: 1;
    }

    .bg-light{
        background-color: rgba(0, 0, 0, 0.8) !important;
    }
    .bg-dark {
        background-color: rgba(0, 0, 0, 0.8) !important;
        color: #f9982f !important;
    }

    .text-white {
        color: #f9982f !important;
    }

    .text-center {
        text-align: center;
    }

    .btn-primary {
        background-color: #312e2e;
        opacity: .9;
        border-color: #f9982f;
    }

    .btn-primary:hover {
        background-color: #b0854a;
        border-color: #b0854a;
    }

    .footer {
        color: #f9982f;
    }

    h1, p {
        color: white;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7); /* Sombra para mejor contraste */
    }

    footer {
        margin-top: auto;
        background-color: #000;
    }
</style>

<div class="main-container">
    <!-- Encabezado -->
    <header class="bg-dark text-white text-center py-5 content">
        <div class="container">
            <h1 class="display-4">Bienvenido a LookingCar</h1>
            <p class="lead">Tu plataforma de alquiler de vehículos de confianza</p>
        </div>
    </header>

    <!-- Sección de fondo con imagen y botón -->
    <section class="text-center content">
        <div class="container">
            <h1 class="display-10">¿Buscas arrendar un vehiculo?</h1>
            <a href="{{ route('home.catalogo') }}" class="btn btn-primary btn-lg mt-4">Empezar</a>
        </div>
    </section>

    <!-- Mensaje de éxito o error -->
    @if(session('success'))
    <div class="container mt-4">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="container mt-4">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    @endif

    <!-- Pie de página -->
    <footer class="bg-light text-center py-4 content">
        <div class="container">
            <p class="mb-0 footer">&copy; 2024 Diego Martínez & Jeremy Arriagada</p>
        </div>
    </footer>
</div>
@endsection

<!-- Modal para cambiar contraseña -->
<div class="modal fade" id="cambiarContraseñaModal" tabindex="-1" aria-labelledby="cambiarContraseñaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cambiarContraseñaModalLabel">Cambiar Contraseña</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Formulario para cambiar contraseña -->               
                <form action="{{ route('cambiar.password') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="password_actual" class="form-label">Contraseña Actual</label>
                        <input type="password" class="form-control" id="password_actual" name="password_actual" required>
                    </div>
                    <div class="mb-3">
                        <label for="password_nueva" class="form-label">Nueva Contraseña</label>
                        <input type="password" class="form-control" id="password_nueva" name="password_nueva" required>
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmar" class="form-label">Confirmar Nueva Contraseña</label>
                        <input type="password" class="form-control" id="password_confirmar" name="password_confirmar" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
@section('scripts')
<!-- Agrega aquí tus scripts de Bootstrap y otros si los necesitas -->
@endsection
