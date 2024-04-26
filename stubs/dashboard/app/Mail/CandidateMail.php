<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;

class CandidateMail extends Email
{
    use Queueable, SerializesModels;

    public function build()
    {
        return $this->from($this->email, $this->name)
            ->view('layout.emails.candidate')
            ->subject("#Candidato - " . $this->roles[$this->data['role']]->name)
            ->attachFromStorage($this->data['curriculum'], $this->data['name'] . '.pdf', ['mime' => 'application/pdf']);
    }
}
