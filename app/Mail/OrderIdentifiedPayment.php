<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderIdentifiedPayment extends Mailable
{
    use Queueable, SerializesModels;

    private Order $order;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $text = 'Confirmamos que sua compra foi realizada com sucesso, em até 48 horas o respectivo crédito
            estará disponível na conta do ID do seu pertinente Máster.';

        if ($this->order->product->price == 0) {
            $text = 'Confirmamos o pagamento da parcela do respectivo Contrato ou Termo de Convênio.';
        }

        return $this
            ->bcc(env('MAIL_BCC', ''))
            ->subject(__('Pagamento identificado'))
            ->with([
                'name' => $this->order->people->name,
                'text' => $text
            ])
            ->view('emails.orders.identified-payment');
    }
}
