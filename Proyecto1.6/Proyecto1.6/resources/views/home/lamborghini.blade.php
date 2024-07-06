@extends('templates.index')

@section('titulo')
    Página de Inicio
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
<style>
    /* Estilos para asegurar la visualización correcta */
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
        font-family: "Orelega One", serif;
        font-weight: 400;
        font-style: normal;
        background-image: url('https://www.chromethemer.com/download/hd-wallpapers/lamborghini-car-3840x2160.jpg');
        background-size: cover;
        background-position: center center;
        background-attachment: fixed;
        color: #000;
    }

    .main-container {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    body::before {
        content: "";
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        z-index: 0;
    }

    .content {
        position: relative;
        z-index: 1;
    }

    .bg-dark {
        background-color: rgba(0, 0, 0, 0.5) !important;
        color: #fff !important;
    }

    .text-white {
        color: #fff !important;
    }

    .card {

        background-color: rgba(3, 3, 3, 0.8);
        color: #f9982f;
        display: flex;
        flex-direction: column;
        justify-content: space-between; /* Asegura que el contenido se distribuya uniformemente */
        align-items: center;
        padding: 10px;
        box-shadow: 0px 2px 2px 2px #dbd8d5;
        height: 100%; /* Establece la altura para que todos los cards sean del mismo tamaño */
    }



    .card-img-top {
        max-width: 100%;
        height: auto;
        max-height: 150px; /* Define la altura máxima de la imagen para mantener la proporción */
        width: auto;
    }


    .marca-link {
        text-decoration: none;
        color: inherit;
    }

    .card:hover {
        transform: scale(1.05);
        transition: transform 0.3s ease;
    }

    .card-body {
    /* Otras propiedades existentes */
        width: 100%
        display: flex;
        text-align: center;
        display: block;
        flex-direction: column;       
    }

    .btn-primary {
        background-color: #312e2e;
        opacity: .9;
        border-color: #f18a03;
        margin-top: 10px; /* Alinea el botón en la parte inferior del card */
    }

    .btn-primary:hover {
        background-color: #b0854a;
        border-color: #b0854a;
    }

    #modalArriendo {
        background-color: #000;
    }

    /* Estilos para mensajes de error */
    .error-message {
        color: #dc3545; /* Color rojo */
        font-size: 0.875rem; /* Tamaño de fuente más pequeño */
        margin-top: 0.25rem; /* Espacio superior */
    }

    .col-md-3{
        margin-top: 10px;
        margin-bottom: 10px;
    }
</style>

<div class="main-container">
    <header class="bg-dark text-white text-center py-5 content">
        <div class="container">
            <h1 class="display-4">Seleccione Vehiculo</h1>
            <p class="lead">Lamborghini</p>
        </div>
    </header>


        <div class="container-fluid mt-2">
            <div class="row">
                @foreach ($vehiculos as $vehiculo)
                    @if ($vehiculo->estado_vehiculo == 1 && $vehiculo->marcaVehiculo == 1)
                    <div class="col-md-3">
                        <div class="card text-white">
                            <img class="card-img-top" src="{{$vehiculo->url_imagen}}" alt="Imagen de {{$vehiculo->marcaVehiculo}}">
                            <div class="card-body">
                                <div>
                                    <h5 class="card-title">{{$vehiculo->marca->marca . " " . $vehiculo->modelo}}</h5>
                                    <p class="card-text">{{$vehiculo->tipoVehiculo->tipoVehiculo}}</p>
                                    <p class="card-text">${{ number_format($vehiculo->tipoVehiculo->precio, 0, ',', '.') }}</p>
                                </div>
                                <!-- Botón para abrir el modal -->
                                <button type="button" class="btn btn-primary mt-auto" data-bs-toggle="modal" data-bs-target="#modalArrendar{{$vehiculo->id}}" data-imagen="{{$vehiculo->url_imagen}}">
                                    Arrendar
                                </button>
                            </div>
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>
        </div>

</div>

<!-- Modales para arrendar vehículo -->
@foreach ($vehiculos as $vehiculo)
    @if ($vehiculo->estado_vehiculo == 1 && $vehiculo->marcaVehiculo == 1)
        <div class="modal fade" id="modalArrendar{{$vehiculo->id}}" tabindex="-1" aria-labelledby="modalArrendarLabel{{$vehiculo->id}}" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content bg-dark text-white">
                    <form action="{{ route('arriendos.crear', $vehiculo->id) }}" method="POST" id="formArriendo{{$vehiculo->id}}">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalArrendarLabel{{$vehiculo->id}}">{{$vehiculo->marcaVehiculo . " " . $vehiculo->modelo}}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" id="modalArriendo">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="rut{{$vehiculo->id}}" class="form-label">RUT</label>
                                        <input type="text" class="form-control @error('rut') is-invalid @enderror" id="rut{{$vehiculo->id}}" name="rut" required>
                                        @error('rut')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="nombre{{$vehiculo->id}}" class="form-label">Nombre</label>
                                        <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre{{$vehiculo->id}}" name="nombre" value="{{ old('nombre', isset($cliente) ? $cliente->nombre : '') }}" required>
                                        @error('nombre')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="apellido{{$vehiculo->id}}" class="form-label">Apellido</label>
                                        <input type="text" class="form-control @error('apellido') is-invalid @enderror" id="apellido{{$vehiculo->id}}" name="apellido" value="{{ old('apellido', isset($cliente) ? $cliente->apellido : '') }}" required>
                                        @error('apellido')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="telefono{{$vehiculo->id}}" class="form-label">Teléfono</label>
                                        <input type="tel" class="form-control @error('telefono') is-invalid @enderror" id="telefono{{$vehiculo->id}}" name="telefono" value="{{ old('telefono', isset($cliente) ? $cliente->telefono : '') }}" required>
                                        @error('telefono')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <img src="{{$vehiculo->url_imagen}}" class="img-fluid rounded mx-auto d-block mb-3" alt="Imagen de {{$vehiculo->marcaVehiculo}}">
                                    <h5 style="text-align: center" class="modal-title" id="modalArrendarLabel{{$vehiculo->id}}">{{$vehiculo->marcaVehiculo . " " . $vehiculo->modelo}}</h5>
                                    <h5 style="text-align: center" class="modal-title">${{number_format($vehiculo->tipoVehiculo->precio, 0, ',', '.')}} / día</h5>

                                    <div class="row mb-3">
                                        <div class="col">
                                            <label for="fecha_arriendo{{$vehiculo->id}}" class="form-label">Fecha de arriendo</label>
                                            <input type="date" class="form-control @error('fecha_arriendo') is-invalid @enderror" id="fecha_arriendo{{$vehiculo->id}}" name="fecha_arriendo" required>
                                            @error('fecha_arriendo')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col">
                                            <label for="fecha_entrega{{$vehiculo->id}}" class="form-label">Fecha de entrega</label>
                                            <input type="date" class="form-control @error('fecha_entrega') is-invalid @enderror" id="fecha_entrega{{$vehiculo->id}}" name="fecha_entrega" required>
                                            @error('fecha_entrega')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <button type="submit" class="btn btn-primary mb-1">Confirmar Arriendo</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
@endforeach

<!-- Modal para cambiar contraseña-->
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

@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection
