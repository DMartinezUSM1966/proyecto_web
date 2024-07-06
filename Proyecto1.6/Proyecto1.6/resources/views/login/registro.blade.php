<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro</title>
    <!-- Enlace a Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>Registro de Usuario</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{route('register')}}">
                            @csrf
                            <div class="form-group">
                                <label for="email">Correo Electrónico</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Introduce tu correo" required> 
                                <label for="password">Contraseña</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Introduce tu contraseña" required>
                                <button type="submit" class="btn btn-primary btn-block mt-4">Registrarse</button>
                            </div>
                            
                        </form>
                    </div>
                    <div class="card-footer text-center">
                        <small class="text-muted">Ya tienes una cuenta? <a href="{{route('login.view')}}">Inicia sesión aquí</a></small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Enlace a Bootstrap JS y dependencias -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
