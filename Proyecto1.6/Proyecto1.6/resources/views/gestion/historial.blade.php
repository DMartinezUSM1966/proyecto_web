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
    /* Estilos generales y de fondo */
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

    /* Capa superpuesta sobre la imagen de fondo */
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

    /* Contenido superpuesto */
    .content {
        position: relative;
        z-index: 1;
    }

    /* Estilos de la tabla */
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

    /* Estilo de los botones */
    .btn-primary, .btn-success {
        background-color: #312e2e;
        border-color: #f9982f;
    }

    .btn-primary:hover, .btn-success:hover {
        background-color: #b0854a;
        border-color: #b0854a;
    }

    .btn-danger {
        background-color: #b22222;
        border-color: #8b0000;
    }

    .btn-danger:hover {
        background-color: #dc143c;
        border-color: #b22222;
    }

    /* Estilos de las tarjetas */
    .card {
        background-color: rgba(74, 74, 74, 0.8);
        border: none;
        color: #f9982f;
        box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
    }

    /* Texto en las tarjetas */
    .card-title,
    .card-text,
    .text-center {
        color: #ffffff;
    }
</style>


<div class="container mt-4 content">
    <!-- Título principal -->
    <div class="row mb-3">
        <div class="col">
            <h2 class="text-center">Sistema de Gestión de Arriendos</h2>
        </div>
    </div>

    <!-- Tabla de arriendos históricos -->
    <div class="row">
        <div class="col">
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>Nro Arriendo</th>
                            <th>RUT Cliente</th>
                            <th>Nombre Cliente</th>
                            <th>Marca Vehículo</th>
                            <th>Modelo Vehículo</th>
                            <th>Fecha Arriendo</th>
                            <th>Fecha Entrega</th>
                            <th>Estado Arriendo</th>
                            <th>Total Pagado</th>
                            <th>Observaciones</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($arriendosHistoricos as $arriendoHistorico)
                            <tr>
                                <td>{{$arriendoHistorico->id}}</td>
                                <td>{{$arriendoHistorico->cliente->rut}}</td>
                                <td>{{$arriendoHistorico->cliente->nombre}}</td>
                                <td>{{$arriendoHistorico->vehiculo->marca->marca}}</td>
                                <td>{{$arriendoHistorico->vehiculo->modelo}}</td>
                                <td>{{ \Carbon\Carbon::parse($arriendoHistorico->fecha_arriendo)->format('d-m-Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($arriendoHistorico->fecha_entrega)->format('d-m-Y') }}</td>
                                <td>
                                    @if($arriendoHistorico->estado_arriendo == 1)
                                        Finalizado
                                    @elseif($arriendoHistorico->estado_arriendo == 2)
                                        Vigente
                                    @endif
                                </td>
                                <td>${{number_format($arriendoHistorico->total, 0, ',', '.')}}</td>
                                <td>
                                    @if($arriendoHistorico->observaciones == null)
                                        No registra
                                    @else
                                        {{$arriendoHistorico->observaciones}}
                                    @endif
                                </td>
                                
                                
                                <td>
                                    <form action="{{ route('arriendosHistoricos.destroy', $arriendoHistorico) }}" method="POST" class="delete-form">
                                        @csrf
                                        @method('delete')
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{$arriendoHistorico->id}}">
                                            Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center">No hay arriendos históricos disponibles.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@foreach ($arriendosHistoricos as $arriendoHistorico)
    <!-- Modal para confirmación de eliminación -->
    <div class="modal fade" id="deleteModal{{$arriendoHistorico->id}}" tabindex="-1" aria-labelledby="deleteModalLabel{{$arriendoHistorico->id}}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel{{$arriendoHistorico->id}}">Confirmación de Eliminación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Está seguro de que desea eliminar este registro historico?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <form action="{{ route('arriendosHistoricos.destroy', $arriendoHistorico) }}" method="POST" class="delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach

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

