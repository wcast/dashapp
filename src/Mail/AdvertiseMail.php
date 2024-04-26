<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;

class AdvertiseMail extends Email
{
    use Queueable, SerializesModels;

    private $documentsCount = 1;
    private $photosCount = 1;

    public function build()
    {
        $email = $this->from($this->email, $this->name)
            ->view('layout.emails.advertise')
            ->subject('Solicitação de Anúncio de Imóvel');

        foreach ($this->data['file_objects'] as $file) {
            $email->attachFromStorage(
                $file->getPath(),
                ($file->getType() == 'document'
                    ? "documento-{$this->documentsCount}"
                    : "foto-{$this->photosCount}") . $file->getExtension(),
                ['mime' => $file->getMimeType()]
            );
            $file->getType() == 'document' ? $this->documentsCount++ : $this->photosCount++;
        }

        return $email;
    }
}
