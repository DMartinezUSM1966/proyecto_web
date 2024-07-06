@extends('templates.index')

@section('titulo')
Sistema de Gestión de Usuarios
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
        color: #f9982f;
    }

    h2, h3, p, .lead, .footer {
        color: #ffffff;
    }

    /* Estilos para mensajes */
    .alert {
        padding: 15px;
        border-radius: 5px;
        margin-bottom: 20px;
        font-size: 16px;
    }

    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
    }

</style>

<div class="container mt-4 content">
    <!-- Título principal -->
    <div class="row mb-3">
        <div class="col">
            <h2 class="text-center" style="color: #fff">Sistema de Gestión de clientes</h2>
        </div>
    </div>

    <!-- Mostrar mensajes de error y éxito -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Botón para abrir el modal de agregar usuario -->
    <div class="row mb-3">
        {{-- <div class="col text-end">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addUserModal">
                Agregar Usuario
            </button>
        </div> --}}
    </div>

    <!-- Tabla de usuarios -->
    <div class="row">
        <div class="col">
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID Usuario</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>RUT</th>
                            <th>Telefono</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($clientes as $cliente)
                        <tr>
                            <td>{{$cliente->id}}</td>
                            <td>{{$cliente->nombre}}</td>
                            <td>{{$cliente->apellido}}</td>
                            <td>{{$cliente->rut}}</td>
                            <td>{{$cliente->telefono}}</td>
                            <td>
                                <form action="{{route('clientes.destroy', $cliente)}}" method="POST" class="delete-form"> 
                                    @csrf
                                    @method('delete')
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{$cliente->id}}">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>

                        @empty
                        <tr>
                            <td colspan="11" class="text-center">No hay clientes registrados.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@foreach ($clientes as $cliente)
    <!-- Modal para confirmación de eliminación -->
    <div class="modal fade" id="deleteModal{{$cliente->id}}" tabindex="-1" aria-labelledby="deleteModalLabel{{$cliente->id}}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel{{$cliente->id}}">Confirmación de Eliminación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Está seguro de que desea eliminar este cliente?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <form action="{{ route('clientes.destroy', $cliente) }}" method="POST" class="delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach

    <!-- Modal para agregar usuario -->
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-light">
                <div class="modal-header">
                    <h5 class="modal-title text-primary" id="addUserModalLabel">Agregar Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="#clientes.store">                   {{-- falta agregar cliente --}}
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Ingrese email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Correo electrónico" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Ingrese contraseña</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required>
                        </div>
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Ingrese Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" required>
                        </div>
                        <div class="mb-3">
                            <label for="rut" class="form-label">Ingrese RUT</label>
                            <input type="text" class="form-control" id="rut" name="rut" placeholder="RUT" required>
                        </div>
                        <div class="mb-3">
                            <label for="cargo" class="form-label">Ingrese cargo</label>
                            <input type="text" class="form-control" id="cargo" name="cargo" placeholder="Cargo" required>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Agregar usuario</button>
                    </form>
                </div>
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
