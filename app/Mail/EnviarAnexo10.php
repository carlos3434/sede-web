<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EnviarAnexo10 extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $adjuntos;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( $user, $adjuntos = array())
    {
        $this->user = $user;
        $this->adjuntos = $adjuntos;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mailable = $this->subject( 'Envio informe segun anexo n° 10' )
                 ->view('emails.enviar-anexo10');

        if ( count( $this->adjuntos ) > 0 ) {
            foreach ( $this->adjuntos as $adjunto ) {
                $mailable->attach( $adjunto );
            }
        }

        return $mailable;
    }
}
