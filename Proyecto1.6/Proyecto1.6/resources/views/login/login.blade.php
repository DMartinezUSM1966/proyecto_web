@extends('templates.index')

@section('titulo')
    Iniciar Sesión - LookCar
@endsection

@section('contenido')
<style>
    /* Estilos para asegurar la visualización correcta */
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
        font-family: 'Roboto', sans-serif; /* Fuente Roboto */
        background-image: url('https://www.chromethemer.com/download/hd-wallpapers/lamborghini-car-3840x2160.jpg');
        background-size: cover;
        background-position: center center;
        background-attachment: fixed;
        color: #f0f0f0; /* Color de texto claro */
    }

    body::before {
        content: "";
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5); /* Fondo oscuro semi-transparente */
        z-index: 0;
    }

    .content {
        position: relative;
        z-index: 1;
    }

    .card {
        background-color: rgba(0, 0, 0, 0.8); /* Fondo de tarjeta oscuro semi-transparente */
        color: #f0f0f0; /* Color de texto claro */
        margin-bottom: 20px;
        box-shadow: 0px 2px 2px 2px #dbd8d5;
    }

    .card-header {
        color: #f0f0f0; /* Color de texto claro */
        border-radius: 15px 15px 0 0; /* Bordes redondeados en la parte superior */
    }

    .form-control {
        background-color: #fff; /* Color de fondo del campo de formulario */
        border: 1px solid #362f2c; /* Borde del campo de formulario */
        border-radius: 10px; /* Bordes redondeados en los campos */
        color: #362f2c; /* Color de texto en los campos */
    }

    .form-control:focus {
        border-color: #362f2c; /* Color del borde al hacer foco */
        box-shadow: 0 0 0 0.2rem rgba(199, 82, 88, 0.25); /* Sombra al hacer foco */
        color: #362f2c; /* Color de texto al hacer foco */
    }

    .btn-primary {
        background-color: #312e2e; /* Color de fondo del botón */
        opacity: .9;
        border-color: #f9982f; /* Color del borde */
    }

    .btn-primary:hover {
        background-color: #b0854a; /* Color de fondo al pasar el mouse */
        border-color: #b0854a; /* Color del borde al pasar el mouse */
    }

    .btn-link {
        color: #50bbae; /* Color del enlace */
    }

    .btn-link:hover {
        color: #132431;
        text-decoration: none; /* Sin subrayado al pasar el mouse */
    }
</style>

<div class="container vh-100 d-flex justify-content-center align-items-center">
    <div class="card shadow-sm p-4" style="width: 100%; max-width: 400px;">
        <div class=" text-center">
            <h2 class="mb-0">Iniciar Sesión</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Ingrese su email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Ingrese su contraseña" required>
                </div>
                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                @if(session('success'))
                    <div class="alert alert-success">{{session('success')}}</div>
                @endif
                <button type="submit" class="btn btn-primary w-100">Iniciar Sesión</button>
            </form>
        </div>
    </div>

    
</div>


@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection
