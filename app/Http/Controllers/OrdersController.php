<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Services\OrderService;

class OrdersController extends Controller
{
    private $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index()
    {
        $orders = Order::query()
            ->orderByDesc('created_at')
            ->orderBy('status')
            ->paginate();

        return OrderResource::collection($orders);
    }

    public function store(OrderRequest $orderRequest)
    {
        return $this->orderService->insert($orderRequest->validated());
    }
}
