<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\CodigoVerificacionMail;
use Illuminate\Support\Facades\Mail;

class CodigoController extends Controller
{
    public function enviar(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $codigo = rand(100000, 999999);

        Mail::to($request->email)->send(new CodigoVerificacionMail($codigo));

        return response()->json([
            'mensaje' => 'Correo enviado correctamente',
            'codigo' => $codigo // solo para pruebas
        ]);
    }
}
