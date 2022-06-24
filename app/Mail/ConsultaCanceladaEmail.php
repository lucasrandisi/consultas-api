<?php

namespace App\Mail;

use App\Models\HorarioConsulta;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConsultaCanceladaEmail extends Mailable
{
    use Queueable, SerializesModels;

	private HorarioConsulta $horarioConsulta;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(HorarioConsulta $horarioConsulta)
    {
        $this->horarioConsulta = $horarioConsulta;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Consulta Cancelada')
			->view('emails.canceled-consulta')
			->with(['horarioConsulta' => $this->horarioConsulta]);
    }
}
