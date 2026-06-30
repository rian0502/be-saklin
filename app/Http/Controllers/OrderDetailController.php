<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddOrderDetailRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Services\OrderService;

class OrderDetailController extends Controller
{
    //
    public function __construct(private OrderService $orderService) {}

    public function store(AddOrderDetailRequest $request, Order $order)
    {
        if (in_array($order->laundry_status, ['completed', 'cancelled'])) {
            return response()->json([
                'message' => 'Tidak bisa menambah item, order sudah '.$order->laundry_status.'.',
            ], 422);
        }

        $order = $this->orderService->addDetail($order, $request->validated());

        return new OrderResource($order->load('orderDetails.service'));
    }
}
