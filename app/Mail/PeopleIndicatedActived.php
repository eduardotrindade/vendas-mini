<?php

namespace App\Mail;

use App\Models\People;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PeopleIndicatedActived extends Mailable
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
            ->subject(__('Novo representante atribuido a você'))
            ->with([
                'person' => $this->people,
            ])
            ->view('emails.people.indicated_actived');
    }
}
