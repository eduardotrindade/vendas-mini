<?php

namespace App\Services;

use App\Gateway\ContaAzul\ContaAzul;
use App\Models\Order;
use App\Models\People;

class ContaAzulService
{
    public function createCustomer(People $people): string
    {
        $customer = ContaAzul::customers()->create([
            'name' => $people->name,
            'email' => $people->email,
            'business_phone' => $people->cellphone,
            'person_type' => strlen($people->document_number) === 11 ? 'NATURAL' : 'LEGAL',
            'document' => $people->document_number,
            'address' => [
                'zip_code' => $people->zip_code,
                'street' => $people->address,
                'number' => $people->number,
                'complement' => $people->complement,
                'neighborhood' => $people->neighborhood
            ]
        ]);

        $people->conta_azul_code = $customer['id'];
        $people->save();

        return $people->conta_azul_code;
    }

    public function createSale(Order $order): string
    {
        $dateNow = new \DateTime();

        if (!$order->people->conta_azul_code) {
            $order->people->conta_azul_code = $this->createCustomer($order->people);
        }

        ContaAzul::sales()->create([
            'number' => $order->id,
            'emission' => $dateNow->format('Y-m-d\TH:i:sO'),
            'status' => 'COMMITTED',
            'customer_id' => $order->people->conta_azul_code,
            'services' => [
                [
                    'service_id' => $order->product->id,
                    'description' => $order->product->description,
                    'quantity' => 1,
                    'value' => number_format($order->product->price, 2, '.', '')
                ]
            ],
            'payment' => [
                'type' => 'CASH',
                'installments' => [
                    [
                        'number' => 1,
                        'value' => number_format($order->amount_paid, 2, '.', ''),
                        'due_date' => $dateNow->format('Y-m-d\TH:i:sO'),
                        'status' => 'PENDING'
                    ]
                ]
            ]
        ]);
    }
}
