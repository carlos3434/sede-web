<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\DiligenciaVerificador\Diligencia;

class NotificarAnexo10 extends Mailable
{
    use Queueable, SerializesModels;

    public $diligencia;
    public $adjuntos;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( Diligencia $diligencia, $adjuntos = array() )
    {
        $this->diligencia = $diligencia;
        $this->adjuntos = $adjuntos;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mailable = $this->subject( 'Entrega Informe VAH' )
                 ->view('emails.notificarAnexo10');

        if ( count( $this->adjuntos ) > 0 ) {
            foreach ( $this->adjuntos as $adjunto ) {
                $mailable->attach( $adjunto );
            }
        }

        return $mailable;
    }
}
