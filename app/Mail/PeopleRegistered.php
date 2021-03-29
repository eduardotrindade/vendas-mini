<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PeopleRegistered extends Mailable
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
            ->subject(__('Solicitação recebida'))
            ->with([
                'name' => $this->name
            ])
            ->view('emails.people.registered');
    }
}
