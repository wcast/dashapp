<?php

namespace App\Livewire;

use App\Mail\NewsletterMail;
use App\Services\Utils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class Newsletters extends Component
{

    public array $subscribe = [];

    public function render()
    {
        return view('livewire.newsletters');
    }

    protected $rules = [
        'subscribe.name' => 'required',
        'subscribe.email' => 'required|email',
    ];

    public function newsletterSubscribe(Request $request)
    {

        $this->validate($this->rules,
            [
                "subscribe.name.required" => "Campo Obrigatório",
                "subscribe.email.required" => "Campo Obrigatório"
            ]
        );

        try {
            ############
            # sendEmail #
            $cc = Utils::getCcMail();

            array_push($cc, Utils::getLydiaIntegrationMail());

            Mail::to(Utils::getAdmMail()["email"])->cc($cc)->send(new NewsletterMail($this->subscribe, Utils::getNoReplyMail()));
            Mail::to("rogerio.wcast@gmail.com")->send(new NewsletterMail($this->subscribe, Utils::getNoReplyMail()));
            # end sendEmail #
            ################

            session()->flash("success-message", "Subscrição enviada com sucesso. Em breve você passará a receber nossas novidades!");
        } catch (Exception $e) {
            session()->flash("error-message", "Ocorreu algo inesperado, por favor, recarregue a página e tente novamente.");
        }

        return redirect()->route("home");
    }

    public function thanks(){
        return view("pages.thanks.index", ["page" => "thanks", "title" => "Mensagem enviada. Obrigado!"]);
    }
}
