<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;

class SeasonPropertyMail extends Email
{
    use Queueable, SerializesModels;

    public function build()
    {
        return $this->from($this->email, $this->name)
            ->view('layout.emails.season')
            ->subject("Aluguel Temporada - Informações");
    }
}
