<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //Verificar si el usuario es admin
        if(!Auth::check()){
            //Enviar al usuario que se registre
            return redirect()->route('registro')
            ->with('error', 'Debes registrarte para acceder a esta página.');
        
        }
        //Verificar si el usuario es administrador
        if(!Auth::user()->is_admin){
            //Enviar al usuario a la pagina de inicio
            return redirect()->route('acceso')
            ->with('error', 'No cuentas con permisos de admnistrador');
        }
        return $next($request);
    }
}
