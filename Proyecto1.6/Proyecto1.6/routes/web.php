<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ArriendosController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\VehiculosController;
use App\Http\Controllers\ClientesController;
use Illuminate\Support\Facades\Route;

// ===================================
// Rutas de HomeController (Vistas Públicas y Privadas)
// ===================================

// Vistas Públicas
Route::get('/login', [LoginController::class, 'mostrarLogin'])->name('login.view');                   // Muestra el login
Route::get('/registro', [LoginController::class, 'mostrarRegistro'])->name('registro');               // Muestra el formulario de registro
Route::get('/catalogo', [HomeController::class, 'mostrarCatalogo'])->name('home.catalogo');           // Muestra el catálogo
Route::get('/catalogo/lamborghini', [HomeController::class, 'catalogoLamborghini'])->name('home.lamborghini');
Route::get('/catalogo/audi', [HomeController::class, 'catalogoAudi'])->name('home.audi');
Route::get('/catalogo/AlfaRomeo', [HomeController::class, 'catalogoAlfaRomeo'])->name('home.alfaRomeo');
Route::get('/catalogo/Ferrari', [HomeController::class, 'catalogoFerrari'])->name('home.ferrari');
Route::get('/catalogo/MercedesBenz', [HomeController::class, 'catalogoMercedesBenz'])->name('home.mercedesBenz');

// Vistas Privadas (Requieren Autenticación)---------------------------------------------------------------------------------
Route::get('/', [HomeController::class, 'mostrarInicio'])->name('home.inicio')->middleware('auth'); // Página de inicio (restringida)
// Cambiar estado de vehículo
Route::post('/vehiculos/cambiar_estado/{id}', [VehiculosController::class, 'cambiarEstado'])->name('vehiculos.cambiar_estado')->middleware('auth');
// Mostrar gestión de vehículos
Route::get('/vehiculos', [VehiculosController::class, 'mostrarVehiculos'])->name('gestion.vehiculos')->middleware('auth');


// Mostrar gestión de arriendos
Route::get('/arriendos', [ArriendosController::class, 'mostrarGestionArriendos'])->name('gestion.arriendos')->middleware('auth');
// Crear y cambiar estado de arriendo
Route::post('/arriendos/crear_arriendo/{id}', [ArriendosController::class, 'crearArriendo'])->name('arriendos.crear')->middleware('auth');
Route::post('/arriendos/{arriendo}/cambiar_estado', [ArriendosController::class, 'cambiarEstadoArriendo'])->name('arriendos.cambiar_estado')->middleware('auth');
Route::delete('/arriendos/historial/{arriendoHistorico}', [ArriendosController::class, 'destroyArriendoHistorico'])->name('arriendosHistoricos.destroy')->middleware('auth');

// gestion de clientes
Route::get('/clientes', [ClientesController::class, 'mostrarGestionClientes'])->name('gestion.clientes')->middleware('auth');
Route::delete('/clientes/{cliente}', [ClientesController::class, 'destroyCliente'])->name('clientes.destroy')->middleware('auth');
//-----------------------------------------------------------------------------------------------------------------------------------

// ===================================
// Rutas de UsuariosController (Gestión de Usuarios)
// ===================================

Route::group(['middleware' => 'App\Http\Middleware\CheckPerfil'], function () {
    // Mostrar gestión de usuarios
    Route::get('/usuarios', [UsuariosController::class, 'mostrarGestionUsuarios'])->name('gestion.usuarios');
    

    // Agregar y eliminar usuarios
    Route::post('/usuarios', [UsuariosController::class, 'agregarUsuario'])->name('usuarios.store');
    Route::delete('/usuarios/{usuario}', [UsuariosController::class, 'destroyUser'])->name('usuarios.destroy');
    Route::delete('/tipoVehiculos/{tipoVehiculo}', [VehiculosController::class, 'destroyTipoVehiculo'])->name('tipoVehiculos.destroy');
    Route::put('/tipoVehiculos/{tipoVehiculo}', [VehiculosController::class, 'editar'])->name('tipoVehiculos.editar');

   
});

// ===================================
// Rutas de VehiculosController (Gestión de Vehículos)
// ===================================

Route::group(['middleware' => 'App\Http\Middleware\CheckPerfil'], function () {
    // Mostrar gestión de tipo de vehículos
    Route::get('/tipoVehiculos', [VehiculosController::class, 'mostrarTipoVehiculos'])->name('gestion.tipoVehiculos');
    

    // Agregar y eliminar vehículos
    Route::post('/vehiculos', [VehiculosController::class, 'agregarVehiculo'])->name('vehiculos.store');
    Route::post('/tipoVehiculos', [VehiculosController::class, 'agregarTipoVehiculo'])->name('tipoVehiculos.store');
    Route::delete('/vehiculos/{vehiculo}', [VehiculosController::class, 'destroyVehiculo'])->name('vehiculos.destroy');

    
});

// ===================================
// Rutas de LoginController (Autenticación y Registro)
// ===================================

// Funcionalidades de autenticación
// Ruta para mostrar el formulario de cambio de contraseña
Route::post('/cambiar-password', [LoginController::class, 'cambiarPassword'])->name('cambiar.password');
Route::post('/login/validacion', [LoginController::class, 'login'])->name('login');                   // Validar y procesar login
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');     
Route::get('/arriendos/historial', [HomeController::class, 'mostrarHistorial'])->name('arriendos.historial');                       // Cerrar sesión

// Funcionalidades de registro
Route::post('/register', [LoginController::class, 'register'])->name('register');    
Route::post('/arriendos/{arriendo}/registrar-entrega',[ArriendosController::class, 'registrarEntrega'])->name('arriendos.registrar_entrega');                // Procesar registro de usuarios
