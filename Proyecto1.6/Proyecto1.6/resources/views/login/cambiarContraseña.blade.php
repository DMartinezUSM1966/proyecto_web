<!-- Vista: resources/views/user/change-password.blade.php -->

@extends('templates.index')

@section('titulo')
    Cambiar Contraseña
@endsection

@section('contenido')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-dark text-white">Cambiar Contraseña</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('user.change-password.post') }}">
                        @csrf

                        <!-- Campo para la contraseña actual -->
                        <div class="form-group">
                            <label for="current_password">Contraseña Actual</label>
                            <input id="current_password" type="password" class="form-control" name="current_password" required>
                            @if ($errors->has('current_password'))
                                <span class="text-danger">{{ $errors->first('current_password') }}</span>
                            @endif
                        </div>

                        <!-- Campo para la nueva contraseña -->
                        <div class="form-group">
                            <label for="new_password">Nueva Contraseña</label>
                            <input id="new_password" type="password" class="form-control" name="new_password" required>
                            @if ($errors->has('new_password'))
                                <span class="text-danger">{{ $errors->first('new_password') }}</span>
                            @endif
                        </div>

                        <!-- Campo para confirmar la nueva contraseña -->
                        <div class="form-group">
                            <label for="new_password_confirmation">Confirmar Nueva Contraseña</label>
                            <input id="new_password_confirmation" type="password" class="form-control" name="new_password_confirmation" required>
                        </div>

                        <!-- Botón para enviar el formulario -->
                        <button type="submit" class="btn btn-primary">Actualizar Contraseña</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
