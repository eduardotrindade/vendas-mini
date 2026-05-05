<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    private $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index(Request $request)
    {
        \Illuminate\Support\Facades\Log::info('Orders Search Params:', $request->all());
        $query = Order::query();

        if ($request->has('search') && $request->get('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                if (is_numeric($search)) {
                    $q->where('id', $search);
                }
                $q->orWhereHas('people', function ($qp) use ($search) {
                    $qp->where('name', 'like', '%' . $search . '%');
                })->orWhereHas('product', function ($qpr) use ($search) {
                    $qpr->where('description', 'like', '%' . $search . '%');
                });
            });
        }

        $orders = $query
            ->orderByDesc('created_at')
            ->orderBy('status')
            ->paginate();

        return OrderResource::collection($orders);
    }

    public function store(OrderRequest $orderRequest)
    {
        return $this->orderService->insert($orderRequest->validated());
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return response()->json(['message' => 'Compra removida']);
    }

    public function paymentNotification(Request $request)
    {
        $this->orderService->paymentNotification($request->all());

        return response()->json(['message' => 'Pagamento processado']);
    }

    public function searchStatusPayment(Request $request)
    {
        $this->orderService->searchStatusPayment();

        return response()->json(['message' => 'Pagamentos processados']);
    }

    public function export()
    {
        $file = $this->orderService->export();

        return response()->download($file);
    }
}
