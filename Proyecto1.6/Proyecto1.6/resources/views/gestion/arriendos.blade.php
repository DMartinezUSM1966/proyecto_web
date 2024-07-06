@extends('templates.index')

@section('titulo')
    Sistema de Gestión de Arriendos
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
    /* Estilos CSS personalizados */
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

    .bg-dark {
        background-color: #46271e !important; /* Color de fondo oscuro para encabezado */
    }
    .bg-light {
        background-color: #132431 !important; /* Color de fondo oscuro para tarjetas y pie de página */
    }
    .text-primary {
        color: #ffffff !important; /* Color del texto primario */
    }
    .table {
        background-color: rgba(255, 255, 255, 0.8); /* Fondo semi-transparente con tinte gris */
        border-collapse: separate; /* Permitir que el fondo sea visible entre las celdas */
        color: #000000; /* Color del texto */
        border-spacing: 0; /* Eliminar el espacio entre celdas */
    }
    .table th, .table td {
        background-color: rgba(0, 0, 0, 0.3); /* Fondo semi-transparente gris oscuro para celdas */
        color: #000000; /* Color del texto */
        border: 1px solid rgba(36, 33, 33, 0.2); /* Borde semi-transparente para celdas */
    }
    .thead-dark th {
        background-color: rgba(0, 0, 0, 0.5); /* Fondo semi-transparente gris más oscuro para cabecera */
        color: #f9982f; /* Color del texto */
    }
    .btn-success {
        background-color: #0000003b; /* Color de fondo del botón de éxito */
        border-color: #cc9319; /* Color del borde del botón de éxito */
    }
    .btn-success:hover {
        background-color: #b0854a; /* Color de fondo del botón de éxito al pasar el mouse */
        border-color: #b0854a; /* Color del borde del botón de éxito al pasar el mouse */
    }
    .btn-primary {
        background-color: #00000073; /* Color de fondo del botón de éxito */
        border-color: #b3790e; /* Color del borde del botón de éxito */
    }
    .btn-primary:hover {
        background-color: #b0854a; /* Color de fondo del botón de éxito al pasar el mouse */
        border-color: #b0854a; /* Color del borde del botón de éxito al pasar el mouse */
    }
    .card {
        background-color: #132431; /* Color de fondo oscuro para las tarjetas */
        color: #fff; /* Color de texto en las tarjetas */
        border: none; /* Sin borde */
    }
    .card-title {
        color: #ffffff; /* Color del título de la tarjeta */
    }
    .card-text {
        color: #ffffff; /* Color del texto de la tarjeta */
    }
</style>

<div class="container mt-4">
    <!-- Título principal -->
    <div class="row mb-3">
        <div class="col">
            <h2 class="text-center">Sistema de Gestión de Arriendos</h2>
        </div>
    </div>

    <!-- Botón para redirigir a la vista de registro de nuevo arriendo -->
    <div class="row mb-3">
        <div class="col text-right">
            <a href="{{ route('arriendos.historial') }}" class="btn btn-primary">
                Ver historial de arriendos
            </a>
        </div>
    </div>

    <!-- Tabla de arriendos -->
    <div class="row">
        <div class="col">
            <table class="table table-striped table-hover table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Nro Arriendo</th>
                        <th>RUT Usuario</th>
                        <th>Nombre Cliente</th>
                        <th>Apellido Cliente</th>
                        <th>Marca Vehículo</th>
                        <th>Modelo Vehículo</th>
                        <th>Fecha Arriendo</th>
                        <th>Fecha Entrega</th>
                        <th>Estado Arriendo</th>
                        <th>Total Pagado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($arriendos as $arriendo)
                        <tr>
                            <td>{{$arriendo->id}}</td>
                            <td>{{$arriendo->cliente->rut}}</td>
                            <td>{{$arriendo->cliente->nombre}}</td>
                            <td>{{$arriendo->cliente->apellido}}</td>
                            <td>{{$arriendo->vehiculo->marca->marca}}</td>
                            <td>{{$arriendo->vehiculo->modelo}}</td>
                            <td>{{ \Carbon\Carbon::parse($arriendo->fecha_arriendo)->format('d-m-Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($arriendo->fecha_entrega)->format('d-m-Y') }}</td>
                            <td>
                                @if($arriendo->estado_arriendo == 1)
                                    Finalizado
                                @elseif($arriendo->estado_arriendo == 2)
                                    Vigente
                                @endif
                            </td>
                            <td>${{number_format($arriendo->total, 0, ',', '.')}}</td>
                            <td>
                                <!-- Botón para abrir el modal de entrega -->
                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalEntrega{{$arriendo->id}}">
                                    Registrar Entrega
                                </button>
                            </td>
                        </tr>

                        <!-- Modal para cada arriendo -->
                        <div class="modal fade" id="modalEntrega{{$arriendo->id}}" tabindex="-1" role="dialog" aria-labelledby="modalEntrega{{$arriendo->id}}Label" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalEntrega{{$arriendo->id}}Label">Registrar Entrega - Arriendo Nro. {{$arriendo->id}}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p><strong>Marca:</strong> {{$arriendo->vehiculo->marca}}</p>
                                        <p><strong>Modelo:</strong> {{$arriendo->vehiculo->modelo}}</p>
                                        <hr>
                                        <p><strong>Arrendatario:</strong></p>
                                        <p><strong>RUT:</strong> {{$arriendo->cliente->rut}}</p>
                                        <p><strong>Nombre:</strong> {{$arriendo->cliente->nombre}}</p>
                                        <p><strong>Apellido:</strong> {{$arriendo->cliente->apellido}}</p>
                                        <p><strong>Total: </strong>${{number_format($arriendo->total, 0, ',', '.')}}</p>
                                        <hr>
                                        <!-- Formulario para registrar la entrega -->
                                        <form action="{{ route('arriendos.registrar_entrega', $arriendo) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label for="imagen_entrega">Imagen:</label>
                                                <input type="file" class="form-control-file" id="imagen_entrega" name="imagen_entrega">
                                            </div>
                                            <div class="form-group">
                                                <label for="observaciones">Observación:</label>
                                                <textarea class="form-control" id="observaciones" name="observaciones" rows="3"></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Confirmar Entrega</button>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="11" class="text-center">No hay arriendos disponibles.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>



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

<!-- Scripts de Bootstrap y jQuery -->

@endsection
