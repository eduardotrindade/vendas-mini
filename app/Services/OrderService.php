<?php

namespace App\Services;

use App\Models\Order;
use DateTime;
use Exception;
use Illuminate\Support\Facades\DB;
use MercadoPago\Item;
use MercadoPago\Payment;
use MercadoPago\Preference;
use MercadoPago\SDK;
use voku\helper\ASCII;

class OrderService
{
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
        SDK::setAccessToken(env('MP_ACCESS_TOKEN'));

        $item = new Item();
        $item->title = $order->product->description;
        $item->quantity = 1;
        $item->unit_price = $order->amount_paid;

        $preference = new Preference();
        $preference->items = array($item);

        $urlFeedback = url('/feedback');
        $preference->back_urls = array(
            'success' => $urlFeedback,
            'failure' => $urlFeedback,
            'pending' => $urlFeedback
        );
        $preference->auto_return = 'approved';

        $preference->statement_descriptor = 'VENDASMINISITIO';
        $preference->external_reference = $order->id;
        $preference->notification_url = url("/api/orders/change-status/{$order->id}");

        $preference->expires = true;
        $dateNow = new DateTime();
        $preference->expiration_date_from = $dateNow->format(DateTime::ISO8601);
        $preference->expiration_date_to = $dateNow->modify('+ 5 days')->format(DateTime::ISO8601);

        $preference->binary_mode = true;

        $preference->save();

        $order->payment_code = $preference->id;
        $order->payment_link = $preference->init_point;
        $order->save();
    }

    public function changeStatus(Order $order, array $data): void
    {
        DB::beginTransaction();
        try {
            SDK::setAccessToken(env('MP_ACCESS_TOKEN'));

            if ($data['topic'] !== 'payment') {
                return;
            }

            $payment = Payment::find_by_id($data['id']);

            if ($payment['status'] === 'approved') {
                $order->status = true;
                $order->payment_date = date('Y-m-d H:i:s');
            }

            $order->save();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
