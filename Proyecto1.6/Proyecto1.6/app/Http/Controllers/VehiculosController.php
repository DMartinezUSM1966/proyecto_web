<?php

namespace App\Http\Controllers;

use App\Models\Arriendo;
use Illuminate\Http\Request;
use App\Models\Vehiculo;
use Illuminate\Support\Facades\Auth;
use App\Models\ArriendoHistorico;
use App\Models\TipoVehiculo;
use App\Models\Marca;

class VehiculosController extends Controller
{
    public function mostrarVehiculos(){
        $marcas = Marca::all();
        $usuario = Auth::user();        //Obtener el usuario en el cual estamos
        $tiposVehiculos = TipoVehiculo::all();
        if($usuario){           //Si existe un usuario
            $cargo = $usuario->perfil->cargo;
        }
        $vehiculos= Vehiculo::all();
        
        return view('gestion.vehiculos',compact('vehiculos', 'usuario', 'cargo', 'tiposVehiculos', 'marcas'));  
    }


    public function mostrarTipoVehiculos(){
        $usuario = Auth::user();        //Obtener el usuario en el cual estamos
        if($usuario){           //Si existe un usuario
            $cargo = $usuario->perfil->cargo;
        }
        $tiposVehiculos = TipoVehiculo::all();
        return view('gestion.tipoVehiculos', compact('tiposVehiculos','usuario','cargo'));
    }

    public function agregarTipoVehiculo(Request $request){
        $tipoVehiculo = new TipoVehiculo();
        $tipoVehiculo->tipoVehiculo = $request->tipoVehiculo;
        $tipoVehiculo->precio = $request->precio;
        $tipoVehiculo->save();
        return redirect()->back();
    }


    public function destroyTipoVehiculo($id){
        $tipoVehiculo = TipoVehiculo::findOrFail($id);
        $vehiculoActivo = Vehiculo::where('tipo_vehiculo_id', $tipoVehiculo->id)->exists();
        if($vehiculoActivo){
            return redirect()->back()->with('error', 'No se puede eliminar el vehículo porque está asociado a un arriendo activo.');
        }
        
        $tipoVehiculo->delete();
        return redirect()->back()->with('success', 'Vehículo eliminado exitosamente.');
    }



    public function agregarVehiculo(Request $request){
        $vehiculo = new Vehiculo();
        $vehiculo->año = $request->año;
        $vehiculo->marcaVehiculo = $request->marca;
        $vehiculo->modelo = $request->modelo;
        $vehiculo->tipo_vehiculo_id = $request->tipo;
        //$vehiculo->color = $request->color;
        $vehiculo->patente = $request->patente;
        //$vehiculo->email = $request->email;
        $vehiculo->url_imagen = $request->url_imagen; 
        $vehiculo->estado_vehiculo = 1;
        $vehiculo->save();
        return redirect()->route('gestion.vehiculos');

    }
    

    public function editar(Request $request, TipoVehiculo $tipoVehiculo)
    {
        $tipoVehiculo->update([
            'tipoVehiculo' => $request->tipoVehiculo,
            'precio' => $request->precio,
        ]);

        return redirect()->back()->with('success', 'Tipo de vehículo actualizado correctamente.');
    }

    public function destroyVehiculo($id)
{
    // Buscar el vehículo por ID
    $vehiculo = Vehiculo::findOrFail($id);

    // Verificar si el vehículo está asociado a arriendos activos
    $arriendoActivo = Arriendo::where('vehiculo_id', $vehiculo->id)->exists();
    if ($arriendoActivo) {
        return redirect()->back()->with('error', 'No se puede eliminar el vehículo porque está asociado a un arriendo activo.');
    }

    // Verificar si el vehículo está asociado a arriendos históricos
    $arriendoHistorico = ArriendoHistorico::where('vehiculo_id', $vehiculo->id)->exists();
    if ($arriendoHistorico) {
        return redirect()->back()->with('error', 'No se puede eliminar el vehículo porque está asociado a un arriendo histórico.');
    }

    // Si no hay arriendos activos ni históricos, proceder con la eliminación del vehículo
    $vehiculo->delete();

    // Redirigir de vuelta con un mensaje de éxito
    return redirect()->back()->with('success', 'Vehículo eliminado exitosamente.');
}


public function cambiarEstado(Request $request, Vehiculo $vehiculo) {
    $vehiculo = Vehiculo::find($request->id);

    if ($vehiculo) {
        // Verificar si hay un arriendo vigente para este vehículo
        $arriendoVigente = Arriendo::where('vehiculo_id', $vehiculo->id)
                                    ->where('estado_arriendo', 2) // Estado vigente
                                    ->exists();

        if ($arriendoVigente) {
            // Si hay un arriendo vigente, no permitir cambiar el estado y retornar con un mensaje de error
            return redirect()->back()->with('error', 'No se puede cambiar el estado del vehículo porque tiene un arriendo vigente.');
        }

        // Actualizar solo el campo estado_vehiculo del vehículo
        $vehiculo->estado_vehiculo = $request->estado_vehiculo;
        $vehiculo->save();
    }

    $arriendo = Arriendo::where('vehiculo_id', $vehiculo->id)->first();

    if ($arriendo) {
        // Actualizar estado de arriendo solo si existe
        if ($request->estado_vehiculo == 2) {
            $nuevoEstadoArriendo = 2;
        } else {
            $nuevoEstadoArriendo = 1;
        }

        $arriendo->estado_arriendo = $nuevoEstadoArriendo;
        $arriendo->save();
    }

    return redirect()->back();
}



   





}
