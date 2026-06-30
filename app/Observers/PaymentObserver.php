<?php

namespace App\Observers;

use App\Models\Payment;
use App\Services\OrderService;

class PaymentObserver
{
    /**
     * Handle the Payment "created" event.
     */
    public function created(Payment $payment): void
    {
        //
        app(OrderService::class)->syncPaymentStatus($payment->order);
    }

    /**
     * Handle the Payment "updated" event.
     */
    public function updated(Payment $payment): void
    {
        //
    }

    /**
     * Handle the Payment "deleted" event.
     */
    public function deleted(Payment $payment): void
    {
        //
        app(OrderService::class)->syncPaymentStatus($payment->order);
    }

    /**
     * Handle the Payment "restored" event.
     */
    public function restored(Payment $payment): void
    {
        //
    }

    /**
     * Handle the Payment "force deleted" event.
     */
    public function forceDeleted(Payment $payment): void
    {
        //
    }
}
