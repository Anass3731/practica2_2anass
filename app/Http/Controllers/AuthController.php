<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class AuthController extends Controller
{
  public function f_index()
    {
        return view("login");
    }
 
    public function f_registro()
    {   
        return view("registro");
    }
 
    public function f_registro_guardar(Request $request)
    {
       // 1. Validamos las reglas estrictas de unicidad y longitud
    $request->validate([
        'usuario' => 'required|unique:users,name', // El nombre de usuario no puede repetirse en la tabla users
        'email' => 'required|email|unique:users,email', // El email no puede estar duplicado
        'password' => 'required|min:8',
        'reppassword' => 'required|min:8'
    ],  [
        'usuario.unique' => 'Usuario ya resgitrado',
        'email.unique' => 'correo ya registrado',
        'password.min' => 'Minimo contraseña de 8 caracteres',
        'reppassword.min' => 'debe de coinicir con la primera contraseña'


    ]);

    // 2. Comprobamos que las dos contraseñas escritas coincidan exactamente
    if ($request->password == $request->reppassword) {
        $user = new User;
        $user->name = $request->usuario;
        $user->email = $request->email;
        
        // 3. Encriptamos la contraseña por seguridad utilizando Hash::make
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('registro')->with('success', 'REGISTRO CORRECTAMENTE');
    } else {
        return redirect()->route('registro')->with('messageerrorpassword', 'Contraseñas no coinciden');
    }
    }   
 


    public function f_logout()
    {    
        Session::flush(); // Borra todos los datos de la sesión actual
    Auth::logout();     // Cierra la autenticación del usuario
     
    return view("logout"); // Carga la vista de desconexión.
    }

    public function f_login(Request $request)    
    {     
        $credenciales = [
            'name' => $request->usuario,
            'password' => $request->password
        ];

        // Comprobamos si el usuario ha marcado el checkbox de "recuérdame"
        $recordar = $request->filled('remember'); 

        if (Auth::attempt($credenciales, $recordar)) {
            $request->session()->regenerate();
            return view('logado');
        } else {
            return redirect()->route('login')->with('error', 'Credenciales incorrectas');
        }
    }




}
