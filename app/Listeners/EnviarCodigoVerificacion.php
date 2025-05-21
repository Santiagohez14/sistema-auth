<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Mail;
use App\Mail\CodigoVerificacionMail;
use Illuminate\Support\Facades\Session;

class EnviarCodigoVerificacion
{
    public function handle(Login $event): void
    {
        $codigo = rand(100000, 999999);

        // Guardar el código en sesión
        Session::put('codigo_verificacion', $codigo);

        // ¡¡¡ASEGÚRATE DE QUE ESTA LÍNEA ESTÉ!!!
        // Marcar que el usuario NO ha verificado aún su código
        Session::put('codigo_verificado', false); // <-- ¡¡¡ESTA LÍNEA ES VITAL!!!

        // Enviar el correo
        Mail::to($event->user->email)->send(new CodigoVerificacionMail($codigo));
    }
}