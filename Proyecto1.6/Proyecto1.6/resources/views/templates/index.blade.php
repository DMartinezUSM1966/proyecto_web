<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo')</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

    
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #000;">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home.inicio') }}" style="color:#ffffff ;">LookingCar.</a>
    
            <button style="color:green"class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon">Abrir menu</span>
            </button>
    
            <div class="collapse navbar-collapse align-items-center" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('home.inicio') }}" style="color: #ffffff;">Inicio</a>
                    </li>
    
                    
                    @if(Auth::check() && Auth::user()->cargo == 1)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('gestion.usuarios') }}" style="color: #ffffff;">Gestionar Usuarios</a>
                    </li>
                     @endif
                    
                    @if(Auth::check() && Auth::user()->cargo == 1)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('gestion.vehiculos') }}" style="color: #ffffff;">Gestion de vehiculos</a>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('gestion.vehiculos') }}" style="color: #ffffff;">Cambiar estado de vehiculos</a>
                    </li>
                    @endif
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('gestion.arriendos')}}" style="color: #ffffff;">Gestion de Arriendos</a>
                    </li>
                    
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('gestion.clientes')}}" style="color: #ffffff;">Gestion de Clientes</a>
                    </li>
                    
                    @if(Auth::check() && Auth::user()->cargo == 1)
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('gestion.tipoVehiculos')}}" style="color: #ffffff;">Gestion de Tipo Vehiculo</a>
                    </li>
                    @endif
    
                    @yield('cargo')
    
                    <li class="nav-item">
                        <a class="btn btn-danger ml-2" href="{{ route('logout') }}">
                            <i class="bi bi-box-arrow-right"></i> Cerrar sesion
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    


    





    
    @yield('contenido')

    <!-- Bootstrap JS (opcional, para ciertas funcionalidades de Bootstrap como modales) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
