<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\SolicitarHojaTramite;
use Illuminate\Support\Facades\Mail;
use App\Models\Auth\User;

class ProcessSolicitarHojaTramite implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user;
    public $adjuntos;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct( User $user, $adjuntos = array())
    {
        $this->user      = $user;
        $this->adjuntos = $adjuntos;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new SolicitarHojaTramite( $this->user, $this->adjuntos );
        Mail::to( env('MAIL_MESADEPARTES_ADDRESS', 'mesadepartes@cenepred.gob.pe') )->send( $email );
    }
}
