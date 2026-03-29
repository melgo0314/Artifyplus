<?php

namespace App\Http\Controllers;

Use App\Models\User;

use Illuminate\Http\Request;    
Use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //Método para mostrar el formulario de inicio de sesión
    public function registerForm(){
        return view('auth.register');
    }

    //Método para guardar la información en la BD
    public function register(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'is_admin' => $request -> has ('is_admin'),
        ]);

        //Iniciar sesión automáticamente 
        Auth::login($user);

        return redirect()->route('home.index');  
    }

    //Método para regresar vista de inicio de sesión
    public function loginForm(){
        return view('auth.login');
    }

     //Método para verificar el inicio de sesión
        public function login(Request $request){
            //Validar los datos del formulario
            $data = $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            //Se realiza una validación para generar la sesión
            if(Auth::attempt($data)){
                //Generar la sesión
                $request->session()->regenerate();

                if(Auth::user()->is_admin){ return redirect()->route('admin.dashboard'); }

                //Redireccionar al usuario a cualquier ruta del sistema
                return redirect()->route('home.index');
            }

            return back()->withErrors([
                'email' => 'Correo o contraseña incorrectos',
            ]);
        }

        //Método para cerrar sesión
        public function logout(Request $request){
            //Cierre de sesión
            Auth::logout();

            //Cierre de credenciales en sesión
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('acceso');
        }   

        public function adminDashboard(){
            return view('admin.dashboard');
        }

        //Método para suscribirse a un plan
        public function suscribirse(){
            $user = Auth::user();  
            
             if($user->subscription_status == 'active' && now()->lessThan($user->subscription_end)){
                return back()->with('error', 'Ya tienes una suscripción activa');
            }

            $user->subscription_status = 'active';
            $user->subscription_start = now();
            $user->subscription_end = now()->addMonth();
           

            return redirect()->route('home.index')
            ->with('success', '¡Te has suscrito exitosamente!');
        }

        


}
