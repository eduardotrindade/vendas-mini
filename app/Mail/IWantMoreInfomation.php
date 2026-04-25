<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class IWantMoreInfomation extends Mailable
{
    use Queueable, SerializesModels;

    private $numberWhatsApp;
    private $name;
    private $city;
    private $email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($numberWhatsApp, $name = null, $city = null, $email = null)
    {
        $this->numberWhatsApp = $numberWhatsApp;
        $this->name = $name;
        $this->city = $city;
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->to(env('MAIL_BCC', 'contatobr@mycardcity.net'))
            ->subject(__('Quero mais informações sobre MINISITIO'))
            ->with([
                'whatsapp' => $this->numberWhatsApp,
                'name' => $this->name,
                'city' => $this->city,
                'email' => $this->email
            ])
            ->view('emails.iwantmoreinformation');
    }
}
