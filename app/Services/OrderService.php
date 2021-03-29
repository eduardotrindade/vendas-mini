<?php

namespace App\Services;

use App\Mail\OrderIdentifiedPayment;
use App\Models\Order;
use DateTime;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use MercadoPago\Item;
use MercadoPago\Payment;
use MercadoPago\Preference;
use MercadoPago\SDK;

class OrderService
{
    private ContaAzulService $contaAzulService;

    public function __construct(ContaAzulService $contaAzulService)
    {
        $this->contaAzulService = $contaAzulService;
    }

    public function insert(array $data): Order
    {
        DB::beginTransaction();
        try {
            $order = Order::create($data);

            $this->createPayment($order);

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }

        return $order;
    }

    private function createPayment(Order $order): void
    {
        SDK::setAccessToken(config('mercado-pago.access_token'));

        $item = new Item();
        $item->title = $order->product->description;
        $item->quantity = 1;
        $item->unit_price = $order->amount_paid;

        $preference = new Preference();
        $preference->items = array($item);

        $urlFeedback = url('/feedback'); //rota front-end
        $preference->back_urls = array(
            'success' => $urlFeedback,
            'failure' => $urlFeedback,
            'pending' => $urlFeedback
        );
        $preference->auto_return = 'approved';

        $preference->statement_descriptor = 'VENDASMINISITIO';
        $preference->external_reference = $order->id;
        $preference->notification_url = route('paymentNotification');

        $preference->expires = true;

        $preference->expiration_date_to = (new DateTime())->modify('+ 5 days')->format('Y-m-d\TH:i:sO');

        $preference->binary_mode = true;

        $preference->save();

        $order->payment_code = $preference->id;
        $order->payment_link = $preference->init_point;
        $order->save();
    }

    public function paymentNotification(array $data): void
    {
        if ($data['topic'] !== 'payment') {
            return;
        }

        DB::beginTransaction();
        try {
            SDK::setAccessToken(config('mercado-pago.access_token'));

            $payment = Payment::find_by_id($data['id']);

            if ($payment->status !== 'approved') {
                return;
            }

            /** @var Order $order */
            $order = Order::find($payment->external_reference)->first();
            $order->status = true;
            $order->payment_date = date('Y-m-d H:i:s');

            $order->conta_azul_code = $this->contaAzulService->createSale($order);

            $order->save();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e);
            return;
        }

        Mail::to($order->people->email)->send(new OrderIdentifiedPayment($order));
    }
}
