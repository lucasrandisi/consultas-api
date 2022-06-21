<?php

namespace App\Mail;

use App\Models\Consulta;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewConsulta extends Mailable
{
    use Queueable, SerializesModels;

	protected Consulta $consulta;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Consulta $consulta)
    {
        $this->consulta = $consulta;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.new-consulta')
			->with(['consulta' => $this->consulta]);
    }
}
