<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UsuariosController extends Controller
{
    public function mostrarGestionUsuarios(){
        $usuario = Auth::user();        //Obtener el usuario en el cual estamos
        if($usuario){           //Si existe un usuario
            $cargo = $usuario->perfil->cargo;
        }

        $usuarios = User::with('perfil')->get();            //Se guarda en $usuarios todo lo de Usuario, y se va al metodo perfil, y obtiene el valor
        return view('gestion.usuarios',compact('usuarios','usuario','cargo'));
    }


    public function agregarUsuario(Request $request){
        $usuario = new User();
        $usuario->email = $request->email;
        $usuario->nombre = $request->nombre;
        $usuario->rut = $request->rut;
        $usuario->cargo = $request->cargo;
        $usuario->password = $request->password;
        $usuario->save();
        return redirect()->route('gestion.usuarios');

    }


    public function destroyUser(User $usuario){
           // Obtener el usuario actualmente autenticado
            $currentUser = auth()->user();

            // Verificar si el usuario que se intenta borrar es el mismo que el autenticado
            if ($usuario->id === $currentUser->id) {
                // Redirigir con un mensaje de error si es el mismo usuario
                return redirect()->route('gestion.usuarios')->withErrors(['error' => 'No puedes eliminar tu propia cuenta.']);
            }

            // Si no es el mismo usuario, proceder a eliminarlo
            $usuario->delete();

            // Redirigir con un mensaje de éxito
            return redirect()->route('gestion.usuarios')->with('success', 'Usuario eliminado con éxito.');
        }

    


}
