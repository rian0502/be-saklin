<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderStatusLog;
use App\Models\Promotion;
use App\Models\Service;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class OrderService
{
    public function createOrder(array $data, int $cashierId): Order
    {
        return DB::transaction(function () use ($data, $cashierId) {
            $promotion = null;
            if (! empty($data['promotion_id'])) {
                $promotion = Promotion::lockForUpdate()->find($data['promotion_id']);
                $this->assertPromotionValid($promotion);
            }

            $order = Order::create([
                'outlet_id' => $data['outlet_id'],
                'customer_id' => $data['customer_id'],
                'cashier_id' => $cashierId,
                'promotion_id' => $promotion?->id,
                'invoice_number' => $this->generateInvoiceNumber($data['outlet_id']),
                'order_date' => $data['order_date'] ?? now()->toDateString(),
                'laundry_status' => 'received',
                'payment_status' => 'unpaid',
                'subtotal_amount' => 0,
                'discount_amount' => 0,
                'tax_rate' => config('laundry.default_tax_rate', 0),
                'tax_amount' => 0,
                'total_amount' => 0,
                'notes' => $data['notes'] ?? null,
            ]);

            foreach ($data['order_details'] as $detail) {
                $this->createDetail($order, $detail);
            }

            $this->recalculateTotals($order, $promotion);

            OrderStatusLog::create([
                'order_id' => $order->id,
                'changed_by' => $cashierId,
                'status' => 'received',
                'notes' => 'Order dibuat.',
                'changed_at' => now(),
            ]);

            if ($promotion) {
                $promotion->increment('used_count');
            }

            return $order->load(['orderDetails.service', 'customer', 'cashier']);
        });
    }

    public function addDetail(Order $order, array $detail): Order
    {
        return DB::transaction(function () use ($order, $detail) {
            $this->createDetail($order, $detail);

            $promotion = $order->promotion_id ? Promotion::find($order->promotion_id) : null;
            $this->recalculateTotals($order, $promotion);

            return $order->load(['orderDetails.service']);
        });
    }

    public function updateStatus(Order $order, string $status, ?string $notes, int $userId): Order
    {
        return DB::transaction(function () use ($order, $status, $notes, $userId) {
            $order->update(['laundry_status' => $status]);

            OrderStatusLog::create([
                'order_id' => $order->id,
                'changed_by' => $userId,
                'status' => $status,
                'notes' => $notes,
                'changed_at' => now(),
            ]);

            return $order;
        });
    }
    
    public function syncPaymentStatus(Order $order): void
    {
        $totalPaid = $order->payments()->sum('amount');

        $status = match (true) {
            $totalPaid <= 0 => 'unpaid',
            $totalPaid < $order->total_amount => 'partial',
            default => 'paid',
        };

        if ($order->payment_status !== $status) {
            $order->update(['payment_status' => $status]);
        }
    }

    private function createDetail(Order $order, array $detail): OrderDetail
    {
        $service = Service::findOrFail($detail['service_id']);

        $pricePerUnit = $service->price;
        $subtotal = $pricePerUnit * $detail['qty_or_weight'];

        return OrderDetail::create([
            'order_id' => $order->id,
            'service_id' => $service->id,
            'machine_id' => $detail['machine_id'] ?? null,
            'qty_or_weight' => $detail['qty_or_weight'],
            'price_per_unit' => $pricePerUnit,
            'subtotal' => $subtotal,
            'start_time' => $detail['start_time'] ?? null,
            'end_time' => $detail['end_time'] ?? null,
        ]);
    }

    private function recalculateTotals(Order $order, ?Promotion $promotion): void
    {
        $subtotal = $order->orderDetails()->sum('subtotal');

        $discount = 0;
        if ($promotion) {
            $discount = $promotion->discount_type === 'percentage'
                ? $subtotal * ($promotion->value / 100)
                : min($promotion->value, $subtotal); // nominal tidak boleh lebih besar dari subtotal
        }

        $taxableAmount = $subtotal - $discount;
        $taxAmount = $taxableAmount * $order->tax_rate;
        $total = $taxableAmount + $taxAmount;

        $order->update([
            'subtotal_amount' => $subtotal,
            'discount_amount' => $discount,
            'tax_amount' => $taxAmount,
            'total_amount' => $total,
        ]);

        // total berubah -> payment_status bisa berubah juga (misal nambah item setelah lunas)
        app(self::class)->syncPaymentStatus($order->refresh());
    }

    private function assertPromotionValid(?Promotion $promotion): void
    {
        if (! $promotion || $promotion->status !== 'active') {
            throw ValidationException::withMessages(['promotion_id' => ['Promo tidak valid atau tidak aktif.']]);
        }

        $today = now()->toDateString();

        if ($promotion->valid_from && $today < $promotion->valid_from) {
            throw ValidationException::withMessages(['promotion_id' => ['Promo belum berlaku.']]);
        }

        if ($promotion->valid_until && $today > $promotion->valid_until) {
            throw ValidationException::withMessages(['promotion_id' => ['Promo sudah berakhir.']]);
        }

        if ($promotion->usage_limit !== null && $promotion->used_count >= $promotion->usage_limit) {
            throw ValidationException::withMessages(['promotion_id' => ['Kuota promo sudah habis.']]);
        }
    }

    private function generateInvoiceNumber(int $outletId): string
    {
        $date = now()->format('Ymd');
        $countToday = Order::where('outlet_id', $outletId)
            ->whereDate('created_at', now()->toDateString())
            ->count();

        $sequence = str_pad((string) ($countToday + 1), 4, '0', STR_PAD_LEFT);

        return "INV-{$outletId}-{$date}-{$sequence}";
    }
}
