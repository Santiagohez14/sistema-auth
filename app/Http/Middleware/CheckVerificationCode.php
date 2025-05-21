<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckVerificationCode
{
    public function handle(Request $request, Closure $next)
    {
        if (!Session::get('codigo_verificado', false)) {
            
            //dd('--- Redirección forzada a /verificacion desde CheckVerificationCode ---'); // Este mensaje es clave
            return redirect()->route('verificacion')->with('error', 'Debes verificar tu código primero.');
        }

        return $next($request);
    }
}