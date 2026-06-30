<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePaymentRequest;
use App\Http\Resources\PaymentResource;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Order $order)
    {
        return PaymentResource::collection($order->payments()->latest()->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePaymentRequest $request, Order $order)
    {
        if ($order->payment_status === 'paid') {
            return response()->json(['message' => 'Order ini sudah lunas.'], 422);
        }

        $payment = $order->payments()->create([
            ...$request->validated(),
            'payment_date' => $request->payment_date ?? now()->toDateString(),
        ]);

        // payment_status di order otomatis tersinkron via PaymentObserver

        return (new PaymentResource($payment))->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
