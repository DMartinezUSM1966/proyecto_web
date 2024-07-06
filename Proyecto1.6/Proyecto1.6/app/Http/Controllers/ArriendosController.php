<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Arriendo;
use App\Models\Vehiculo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\ArriendoHistorico;
use App\Models\Cliente;
use Nette\Utils\DateTime;


class ArriendosController extends Controller
{
    public function mostrarGestionArriendos(){    
        $usuario = Auth::user();        //Obtener el usuario en el cual estamos
        if($usuario){           //Si existe un usuario
            $cargo = $usuario->perfil->cargo;
        }                        
        $arriendos = Arriendo::all();           //Se guarda en $usuarios todo lo de Usuario, y se va al metodo perfil, y obtiene el valor
        return view('gestion.arriendos',compact('arriendos', 'usuario', 'cargo'));
    }

    public function destroyArriendoHistorico(ArriendoHistorico $arriendoHistorico){
        $arriendoHistorico->delete();
        return redirect()->back()->with('success', 'Registro historico eliminado');
    }


    public function crearArriendo($VehiculoID, Request $request) {
        // Validación de campos
        $validatedData = $request->validate([
            'rut' => ['required', 'regex:/^\d{7,8}-[k|K|\d]{1}$/'], // Rut chileno sin puntos y con dígito verificador
            'nombre' => 'required',
            'apellido' => 'required',
            'telefono' => ['required', 'regex:/^\+56\d{9}$/'], // Número de teléfono con código de país +56
            'fecha_arriendo' => 'required|date',
            'fecha_entrega' => 'required|date|after_or_equal:fecha_arriendo',
        ], [
            // Mensajes personalizados de error
            'rut.regex' => 'El formato del Rut debe ser XXXXXXXX-X.',
            'telefono.regex' => 'El número de teléfono debe empezar con +56 y contener 9 dígitos.',
            'fecha_entrega.after_or_equal' => 'La fecha de entrega es invalida',
        ]);
    
        // Obtener el vehículo
        $vehiculo = Vehiculo::findOrFail($VehiculoID);
    
        // Buscar el cliente por rut
        $cliente = Cliente::where('rut', $request->rut)->first();
    
        // Si el cliente no existe, crear uno nuevo
        if (!$cliente) {
            $cliente = new Cliente();
            $cliente->rut = $request->rut;
            $cliente->nombre = $request->nombre;
            $cliente->apellido = $request->apellido;
            $cliente->telefono = $request->telefono;
            $cliente->save();
        }
    
        // Calcular la cantidad de días entre las fechas de arriendo y entrega
        $fechaArriendo = new DateTime($request->fecha_arriendo);
        $fechaEntrega = new DateTime($request->fecha_entrega);
        $diferencia = $fechaArriendo->diff($fechaEntrega);
        $cantidadDias = $diferencia->days + 1; // Sumamos 1 para incluir el primer día
    
        // Calcular el total del arriendo
        $totalArriendo = $cantidadDias * $vehiculo->tipoVehiculo->precio;
    
        // Crear el arriendo
        Arriendo::create([
            'cliente_id' => $cliente->id,
            'vehiculo_id' => $vehiculo->id,
            'fecha_arriendo' => $request->fecha_arriendo,
            'fecha_entrega' => $request->fecha_entrega,
            'total' => $totalArriendo
        ]);
    
        // Cambiar el estado del vehículo a "Arrendado"
        $vehiculo->update(['estado_vehiculo' => 2]);
    
        // Redirigir de vuelta con un mensaje de éxito
        return redirect()->back()->with('success', 'Vehículo arrendado exitosamente!');
    }

    public function cambiarEstadoArriendo(Request $request, Arriendo $arriendo){
        // Validación de datos (opcional)
        $request->validate([
            'estado_arriendo' => 'required|in:1,2',
        ]);


        // Actualización del estado del arriendo
        $arriendo->estado_arriendo = $request->estado_arriendo;
        $arriendo->save();

        // Actualización del estado del vehículo asociado al arriendo
        $vehiculo = Vehiculo::find($arriendo->vehiculo_id);

        if ($vehiculo) {
            // Acceder al estado del vehículo a través de la relación
            $vehiculo->estado_vehiculo = $request->estado_arriendo;
            $vehiculo->save();
        }

        // Redireccionar o devolver respuesta
        return redirect()->back()->with('success', 'Estado de arriendo y vehículo actualizados correctamente.');
    }


    public function registrarEntrega(Arriendo $arriendo, Request $request)
{
    // Verificar si el arriendo está vigente
    if ($arriendo->estado_arriendo == 2) {
        // Crear un nuevo arriendo histórico
        $arriendoHistorico = new ArriendoHistorico();
        $arriendoHistorico->vehiculo_id = $arriendo->vehiculo_id;
        $arriendoHistorico->cliente_id = $arriendo->cliente_id;
        $arriendoHistorico->fecha_arriendo = $arriendo->fecha_arriendo;
        $arriendoHistorico->fecha_entrega = $arriendo->fecha_entrega;
        $arriendoHistorico->total = $arriendo->total;
        $arriendoHistorico->observaciones = $request->observaciones;
        // Otros campos relevantes del arriendo histórico

        $arriendoHistorico->save();
        $vehiculo = Vehiculo::find($arriendo->vehiculo_id);

        if ($vehiculo) {
            // Acceder al estado del vehículo a través de la relación
            $vehiculo->estado_vehiculo = 1;
            $vehiculo->save();
        }

        // Opcional: Eliminar el arriendo activo si no necesitas conservarlo en la tabla de arriendos activos
        $arriendo->delete();

        return redirect()->back()->with('success', 'Arriendo registrado como entregado y movido a históricos.');
    } else {
        return redirect()->back()->with('error', 'No se puede registrar la entrega. El arriendo no está vigente.');
    }
}
}
