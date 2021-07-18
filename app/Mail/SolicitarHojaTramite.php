<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SolicitarHojaTramite extends Mailable
{
    use Queueable, SerializesModels;

    public $datos;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($datos)
    {
        $this->datos = $datos;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Solicito numero de hoja de tramite')
                        ->view('emails.solicitar-hoja-tramite')
                        ->attach($this->datos['archivo']->getRealPath(), [
                                'as' => $this->datos['archivo']->getClientOriginalName()
                                //'mime' => 'image/jpeg',
                        ])
                        ->attach($this->datos['recibo']->getRealPath(), [
                            'as' => $this->datos['recibo']->getClientOriginalName()
                        ]);                         
    }
}
