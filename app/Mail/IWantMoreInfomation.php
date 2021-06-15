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

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($numberWhatsApp)
    {
        $this->numberWhatsApp = $numberWhatsApp;
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
                'whatapp' => $this->numberWhatsApp
            ])
            ->view('emails.iwantmoreinformation');
    }
}
