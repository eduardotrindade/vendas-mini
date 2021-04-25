<?php

namespace App\Mail;

use App\Models\People;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PeopleActived extends Mailable
{
    use Queueable, SerializesModels;

    private People $people;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(People $people)
    {
        $this->people = $people;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->bcc(env('MAIL_BCC', ''))
            ->subject(__('Solicitação aprovada'))
            ->with([
                'person' => $this->people,
                'referralLink' => $this->people->getReferralLink()
            ])
            ->view('emails.people.actived');
    }
}
