<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Vehiculo;
use App\Models\Arriendo;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\ArriendoHistorico;
use App\Models\Cliente;

class HomeController extends Controller
{



    public function mostrarInicio(){
        $usuario = Auth::user();        //Obtener el usuario en el cual estamos

        if($usuario){           //Si existe un usuario
            $cargo = $usuario->perfil->cargo;           //se guarda el cargo en la variable cargo, accediendo al usuario, al metodo perfil de el model
                                                        //en el cual se establece la FK, y se accede a cargo

            return view('home.index',compact('usuario','cargo'));       //Se manda usuario y cargo a la ruta.
        }
    }



    public function mostrarCatalogo(){
        $usuario = Auth::user();        //Obtener el usuario en el cual estamos

        if($usuario){           //Si existe un usuario
            $cargo = $usuario->perfil->cargo;           //se guarda el cargo en la variable cargo, accediendo al usuario, al metodo perfil de el model
                                                        //en el cual se establece la FK, y se accede a cargo

            return view('home.catalogo',compact('usuario','cargo'));       //Se manda usuario y cargo a la ruta.
        }
    }


    public function catalogoLamborghini(){
        $vehiculos = Vehiculo::all();
        $usuario = Auth::user();        //Obtener el usuario en el cual estamos
        if($usuario){           //Si existe un usuario
            $cargo = $usuario->perfil->cargo;           //se guarda el cargo en la variable cargo, accediendo al usuario, al metodo perfil de el model
                                                        //en el cual se establece la FK, y se accede a cargo

            return view('home.lamborghini',compact('usuario','cargo','vehiculos'));       //Se manda usuario y cargo a la ruta.
        }
    }

    public function catalogoAudi(){
        $vehiculos = Vehiculo::all();
        $usuario = Auth::user();        //Obtener el usuario en el cual estamos
        if($usuario){           //Si existe un usuario
            $cargo = $usuario->perfil->cargo;           //se guarda el cargo en la variable cargo, accediendo al usuario, al metodo perfil de el model
                                                        //en el cual se establece la FK, y se accede a cargo

            return view('home.audi',compact('usuario','cargo','vehiculos'));       //Se manda usuario y cargo a la ruta.
        }
    }

    public function catalogoAlfaRomeo(){
        $clientes = Cliente::all(); // Obtener todos los clientes
        $vehiculos = Vehiculo::all();
        $usuario = Auth::user();        //Obtener el usuario en el cual estamos
        if($usuario){           //Si existe un usuario
            $cargo = $usuario->perfil->cargo;           //se guarda el cargo en la variable cargo, accediendo al usuario, al metodo perfil de el model
                                                        //en el cual se establece la FK, y se accede a cargo

            return view('home.alfaRomeo',compact('usuario','cargo','vehiculos', 'clientes'));       //Se manda usuario y cargo a la ruta.
        }
    }

    public function catalogoFerrari(){
        $vehiculos = Vehiculo::all();
        $usuario = Auth::user();        //Obtener el usuario en el cual estamos
        if($usuario){           //Si existe un usuario
            $cargo = $usuario->perfil->cargo;           //se guarda el cargo en la variable cargo, accediendo al usuario, al metodo perfil de el model
                                                        //en el cual se establece la FK, y se accede a cargo

            return view('home.ferrari',compact('usuario','cargo','vehiculos'));       //Se manda usuario y cargo a la ruta.
        }
    }

    public function catalogoMercedesBenz(){
        $vehiculos = Vehiculo::all();
        $usuario = Auth::user();        //Obtener el usuario en el cual estamos
        if($usuario){           //Si existe un usuario
            $cargo = $usuario->perfil->cargo;           //se guarda el cargo en la variable cargo, accediendo al usuario, al metodo perfil de el model
                                                        //en el cual se establece la FK, y se accede a cargo

            return view('home.mercedesBenz',compact('usuario','cargo','vehiculos'));       //Se manda usuario y cargo a la ruta.
        }
    }

    public function mostrarHistorial(){
        $usuario = Auth::user();        //Obtener el usuario en el cual estamos
        if($usuario){           //Si existe un usuario
            $cargo = $usuario->perfil->cargo;
        }
        $arriendosHistoricos = ArriendoHistorico::all();
        return view('gestion.historial',compact('arriendosHistoricos', 'usuario', 'cargo'));
    }




}
    


   




