<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;

class NewsletterMail extends Email
{
    use Queueable, SerializesModels;

    public function build()
    {
        return $this->from($this->email, $this->name)
            ->view('emails.newsletter')
            ->subject("Subscrição na Newsletter");
    }
}
