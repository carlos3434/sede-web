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

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( Diligencia $diligencia )
    {
        $this->diligencia = $diligencia;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Entrega Informe VAH')
        ->view('emails.notificarAnexo10');
    }
}
