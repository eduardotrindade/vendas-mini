<?php

namespace App\Services;

use App\Models\Order;
use Exception;
use Illuminate\Support\Facades\DB;

class OrderService
{
    public function insert(array $data): Order
    {
        DB::beginTransaction();
        try {
            $order = Order::create($data);

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }

        return $order;
    }
}
