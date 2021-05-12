<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    private OrderService $orderService;

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

    public function paymentNotification(Request $request)
    {
        $this->orderService->paymentNotification($request->all());

        return response()->json(['message' => 'Pagamento processado'], 200);
    }

    public function export()
    {
        $file = $this->orderService->export();

        return response()->download($file);
    }
}
