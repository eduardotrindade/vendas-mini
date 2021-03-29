<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PeopleActived extends Mailable
{
    use Queueable, SerializesModels;

    private string $name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $name)
    {
        $this->name = $name;
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
                'name' => $this->name,
            ])
            ->view('emails.people.actived');
    }
}
