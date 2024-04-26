<?php

namespace App\Mail;

use App\Services\Utils;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;

class Email extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $email;
    public $name;
    public $roles;
    public $sources;
    public $categories;

    public function __construct(array $data, array $from)
    {
        $this->data = $data;
        $this->email = $from['email'];
        $this->name = $from['name'];
        
        $this->categories = Cache::remember('categories', '3600', function () {
            return Utils::getCategories();
        });
        $this->sources = Cache::remember('sources', '3600', function () {
            return $this->sources = Utils::getSources();
        });
        $this->roles = Cache::remember('roles', '3600', function () {
            return $this->roles = Utils::getRoles();
        });
    }

    public function build()
    {
        // Method overwritten by child
    }
}
