<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\DiligenciaVerificador\Diligencia;

class NotificarObservacion extends Mailable
{
    use Queueable, SerializesModels;

   // public $usuario;
    public $expedienteAdhoc;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( $expedienteAdhoc )
    {
       // $this->usuario = $usuario;
        $this->expedienteAdhoc = $expedienteAdhoc;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject( 'Observacion sobre expediente' )
                 ->view('emails.notificarObservacion');
    }
}
