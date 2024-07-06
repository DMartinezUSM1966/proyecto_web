<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class LoginController extends Controller
{


    public function mostrarLogin(){
        
        return view('login.login');      
    }

    public function mostrarRegistro(){
        return view('login.registro');
    }


    public function register(Request $request){
        $user = new User();
        $user-> email = $request->email;
        $user-> password = Hash::make($request->password);
        $user-> cargo = 2;
        $user->save();

        Auth::login($user);
        return redirect()->route('home.inicio');
    }


    public function cambiarPassword(Request $request)
    {
        $request->validate([
            'password_actual' => 'required',
            'password_nueva' => 'required|min:8',
            'password_confirmar' => 'required|same:password_nueva',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->password_actual, $user->password)) {
            return redirect()->route('home.inicio')->with('error', 'La contraseña no se ha podido cambiar.');
        }

        $user->password = Hash::make($request->password_nueva);
        $user->save();

        return redirect()->route('login.view')->with('success', 'Contraseña cambiada exitosamente, inicia sesion con tu nueva contraseña.');
    }







    public function login(Request $request){
        
        $credencial = ['email' => $request->email,
                    'password' => $request->password];

        if(Auth::attempt($credencial)){         
            $request->session()->regenerate();
            return redirect()->route('home.inicio');
        }
        else{
            return back()->with('error', 'Verifica tu correo electronico y contraseña');
        }
    }



    public function logout(){
        Auth::logout();
        return redirect()->route('login.view');
    }




    


}
