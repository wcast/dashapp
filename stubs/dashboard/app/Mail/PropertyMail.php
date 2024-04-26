<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;

class PropertyMail extends Email
{
    use Queueable, SerializesModels;

    public function build()
    {
        $title = ucwords(str_replace("-", " ", $this->data['slug']));

        return $this->from($this->email, $this->name)
            ->view('layout.emails.property')
            ->subject("CONTATO - Imóvel: {$title}");
    }
}
