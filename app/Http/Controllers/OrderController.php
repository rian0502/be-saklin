<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderStatusRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(private OrderService $orderService) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::query()
            ->when(! request()->user()->hasRole('owner'), function ($q) {
                $q->where('outlet_id', request()->user()->outlet_id);
            })
            ->with(['customer', 'cashier'])
            ->latest()
            ->paginate(15);

        return OrderResource::collection($orders);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        $order = $this->orderService->createOrder(
            $request->validated(),
            $request->user()->id
        );

        return (new OrderResource($order))->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return new OrderResource(
            $order->load(['orderDetails.service', 'customer', 'cashier', 'payments', 'statusLogs'])
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }

    public function updateStatus(UpdateOrderStatusRequest $request, Order $order)
    {
        $order = $this->orderService->updateStatus(
            $order,
            $request->laundry_status,
            $request->notes,
            $request->user()->id
        );

        return new OrderResource($order);
    }
}
