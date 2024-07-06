<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\ArriendoHistorico;
use App\Models\Arriendo;
use Illuminate\Support\Facades\Auth;

class ClientesController extends Controller
{
    public function mostrarGestionClientes(){
        $clientes = Cliente::all();
        $usuario = Auth::user();        //Obtener el usuario en el cual estamos
        if($usuario){           //Si existe un usuario
            $cargo = $usuario->perfil->cargo;
        }
        return view('gestion.clientes',compact('clientes', 'usuario', 'cargo'));
    }

    public function destroyCliente(Cliente $cliente){
        $arriendosHistoricos = ArriendoHistorico::where('cliente_id', $cliente->id)->get();
        $arriendos = Arriendo::where('cliente_id', $cliente->id)->get();

    // Verificar si hay arriendos históricos o arriendos asociados
        if ($arriendosHistoricos->isNotEmpty() or $arriendos->isNotEmpty()) {
            return redirect()->route('gestion.clientes')->with('error', 'No se puede eliminar el cliente porque tiene arriendos o arriendos históricos asociados.');
        }

    // Si no hay arriendos históricos ni arriendos, eliminar el cliente
        $cliente->delete();
        return redirect()->route('gestion.clientes')->with('success', 'Cliente eliminado correctamente.');
    }
}
