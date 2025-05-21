<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CodigoVerificacionMail extends Mailable
{
    use Queueable, SerializesModels;

    public $codigo;

    /**
     * Crear una nueva instancia de mensaje
     */
    public function __construct($codigo)
    {
        $this->codigo = $codigo;
    }

    /**
     * Obtener el mensaje.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Código de Verificación',
        );
    }

    /**
     * definición del contenido del mensaje.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.codigo-verificacion',
        );
    }

    /**
     * los archivos adjuntos del mensaje.
     */
    public function attachments(): array
    {
        return [];
    }
}
