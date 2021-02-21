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
            'person_type' => count($people->document_number) === 11 ? 'NATURAL' : 'LEGAL',
            'document' => $people->document_number,
            'address' => [
                'zip_code' => $people->zip_code,
                'street' => $people->address,
                'number' => $people->number,
                'complement' => $people->complement,
                'neighborhood' => $people->neighborhood
            ]
        ]);

        return $customer['id'];
    }

    public function createSale(Order $order): string
    {
        $dateNow = new \DateTime();

        ContaAzul::sales()->create([
            'number' => $order->id,
            'emission' => $dateNow->format("yyyy-MM-dd'T'HH:mm:ssz"),
            'status' => 'COMMITTED',
            'customer_id' => $order->people->conta_azul_code,
            'products' => [
                [
                    'product_id' => $order->product->id,
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
                        'due_date' => $dateNow->format("yyyy-MM-dd'T'HH:mm:ssz"),
                        'status' => 'PENDING'
                    ]
                ]
            ]
        ]);
    }
}
