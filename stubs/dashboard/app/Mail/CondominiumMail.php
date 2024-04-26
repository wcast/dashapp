<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;

class CondominiumMail extends Email
{
    use Queueable, SerializesModels;

    public function build()
    {
        return $this->from($this->email, $this->name)
            ->view('layout.emails.atlantida')
            ->subject("CONTATO - ATLÂNTIDA (Imóveis na praia) : {$this->data['name']}");
    }
}
