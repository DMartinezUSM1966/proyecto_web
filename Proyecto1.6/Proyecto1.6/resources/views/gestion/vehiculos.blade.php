@extends('templates.index')

@section('titulo')
    Sistema de Gestión de Vehículos
@endsection

@section('head')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Orelega+One&display=swap" rel="stylesheet">
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
        background-color: rgba(255, 255, 255); /* Fondo semi-transparente con tinte gris */
        border-collapse: separate; /* Permitir que el fondo sea visible entre las celdas */
        color: #000000; /* Color del texto */
        border-spacing: 0; /* Eliminar el espacio entre celdas */
        text-align: center;
    }
    .table:hover {
        cursor: pointer;
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

    /* Estilos de los botones */
    .btn-primary,
    .btn-success {
        background-color: #312e2e;
        border-color: #f9982f;
    }

    .btn-primary:hover,
    .btn-success:hover {
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

    /* Modal */
    .modal-content {
        background-color: rgba(0, 0, 0, 0.8);
        color: white;
    }

    .modal-header, .modal-footer {
        border-bottom: none;
    }

    .modal-body {
        color: #f9982f;
    }

    /* Clases dinámicas para estados de vehículos */
    .table-arrendado {
        background-color: rgba(81, 255, 0, 0.226); /* Fondo amarillo semi-transparente para arrendado */
    }

    .table-mantenimiento {
        background-color: rgba(251, 255, 17, 0.404); /* Fondo verde semi-transparente para mantenimiento */
    }

    .table-baja {
        background-color: rgba(255, 0, 0, 0.363); /* Fondo rojo semi-transparente para baja */
    }

</style>

<div class="container mt-4 content">
    <!-- Título principal -->
    <div class="row mb-3">
        <div class="col">
            <h2 class="text-center" style="color: #fff">Sistema de Gestión de Vehículos</h2>
        </div>
    </div>
    <!-- Mensajes de éxito o error -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @elseif (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if (Auth::check() && Auth::user()->cargo == 1)
    <div class="row mb-3">
        <div class="col text-end">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addVehiculoModal">
                Agregar vehiculo
            </button>
        </div>
    </div>
    @endif
    
    <!-- Tabla de vehículos -->
    <div class="row">
        <div class="col">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Año</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Tipo Vehiculo</th>
                            <th>Patente</th>
                            <th>Estado</th>
                            <th>Cambiar estado</th>
                            @if (Auth::check() && Auth::user()->cargo == 1)
                            <th>Eliminacion</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="table-hover">
                        @forelse ($vehiculos as $vehiculo)
                            @php
                                $clase_estado = '';
                                switch ($vehiculo->estado->id) {
                                    case 2: // Arrendado
                                        $clase_estado = 'table-arrendado';
                                        break;
                                    case 3: // En mantención
                                        $clase_estado = 'table-mantenimiento';
                                        break;
                                    case 4: // De baja
                                        $clase_estado = 'table-baja';
                                        break;
                                    default:
                                        $clase_estado = ''; // Por defecto, no se aplica ninguna clase especial
                                }
                            @endphp
                            <tr id="vehiculo-{{$vehiculo->id}}" class="{{$clase_estado}}">
                                <td>{{$vehiculo->id}}</td>
                                <td>{{$vehiculo->año}}</td>
                                <td>{{$vehiculo->marca->marca}}</td>
                                <td>{{$vehiculo->modelo}}</td>
                                <td>{{$vehiculo->tipoVehiculo->tipoVehiculo}}</td>
                                <td>{{$vehiculo->patente}}</td>
                                <td>{{$vehiculo->estado->estadoVehi}}</td>
                                <td>
                                    <div class="action-buttons">
                                        <!-- Dropdown de cambio de estado -->
                                        <div class="dropdown">
                                            <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton{{$vehiculo->id}}" data-bs-toggle="dropdown" aria-expanded="false">
                                                Cambiar Estado
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{$vehiculo->id}}">
                                                
                                                <li>
                                                    <form action="{{ route('vehiculos.cambiar_estado', $vehiculo) }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="estado_vehiculo" value="2"> 
                                                        <button type="submit" class="dropdown-item">Arrendado</button>
                                                    </form>
                                                </li>
                                                <li>
                                                    <form action="{{ route('vehiculos.cambiar_estado', $vehiculo) }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="estado_vehiculo" value="3"> 
                                                        <button type="submit" class="dropdown-item">En mantención</button>
                                                    </form>
                                                </li>
                                                <li>
                                                    <form action="{{ route('vehiculos.cambiar_estado', $vehiculo) }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="estado_vehiculo" value="4"> 
                                                        <button type="submit" class="dropdown-item">De baja</button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    @if (Auth::check() && Auth::user()->cargo == 1)
                                    <td>
                                        <!-- Botón de eliminar -->

                                        <form action="{{route('vehiculos.destroy', $vehiculo)}}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('delete')
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{$vehiculo->id}}">
                                                Eliminar
                                            </button>
                                        </form>                                      
                                    </td>
                                    @endif

                         
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="11" class="text-center">No hay vehiculos registrados.</td>
                                </tr>                               
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@foreach ($vehiculos as $vehiculo)
    <!-- Modal para confirmación de eliminación -->
    <div class="modal fade" id="deleteModal{{$vehiculo->id}}" tabindex="-1" aria-labelledby="deleteModalLabel{{$vehiculo->id}}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel{{$vehiculo->id}}">Confirmación de Eliminación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Está seguro de que desea eliminar este vehiculo?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <form action="{{ route('vehiculos.destroy', $vehiculo) }}" method="POST" class="delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach



<!-- Modal para agregar Vehiculo -->
<div class="modal fade" id="addVehiculoModal" tabindex="-1" aria-labelledby="addVehiculoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-light">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="addVehiculoModalLabel">Agregar Vehículo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('vehiculos.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="tipo" class="form-label">Marca</label>
                        <select class="form-control" id="id" name="marca" required>
                            <option value="">Selecciona marca del vehiculo</option>
                            @foreach ($marcas as $marca)
                                <option value="{{ $marca->id }}">{{ $marca->marca }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="modelo" class="form-label">Modelo del Vehículo</label>
                        <input type="text" class="form-control" id="modelo" name="modelo" placeholder="Modelo" required>
                    </div>
                    <div class="mb-3">
                        <label for="año" class="form-label">Año del Vehículo</label>
                        <input type="number" class="form-control" id="año" name="año" placeholder="Año" required>
                    </div>
                    <div class="mb-3">
                        <label for="patente" class="form-label">Patente del Vehículo</label>
                        <input type="text" class="form-control" id="patente" name="patente" placeholder="Patente" required>
                    </div>
                    <div class="mb-3">
                        <label for="tipo" class="form-label">Tipo del Vehículo</label>
                        <select class="form-control" id="tipo" name="tipo" required>
                            <option value="">Selecciona el tipo de vehículo</option>
                            @foreach ($tiposVehiculos as $tipoVehiculo)
                                <option value="{{ $tipoVehiculo->id }}">{{ $tipoVehiculo->tipoVehiculo }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="patente" class="form-label">Url Imagen</label>
                        <input type="text" class="form-control" id="url_imagen" name="url_imagen" placeholder="URL Imagen" required>
                    </div>
                    <button type="submit" class="btn btn-success w-100">Agregar vehículo</button>
                </form>
            </div>
        </div>
    </div>
</div>







<!-- MODAL para cambiar contraseña -->   
<div class="modal fade" id="cambiarContraseñaModal" tabindex="-1" aria-labelledby="cambiarContraseñaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cambiarContraseñaModalLabel">Cambiar Contraseña</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">            
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
