<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /** @use HasFactory<OrderFactory> */
    use HasFactory;

    protected $fillable = [
        'outlet_id', 'customer_id', 'cashier_id', 'promotion_id',
        'invoice_number', 'order_date', 'laundry_status', 'payment_status',
        'subtotal_amount', 'discount_amount', 'tax_rate', 'tax_amount',
        'total_amount', 'notes',
    ];

    public function outlet()
    {
        return $this->belongsTo(Outlet::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function cashier()
    {
        return $this->belongsTo(User::class, 'cashier_id');
    }

    public function promotion()
    {
        return $this->belongsTo(Promotion::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function statusLogs()
    {
        return $this->hasMany(OrderStatusLog::class);
    }

    public function delivery()
    {
        return $this->hasOne(Delivery::class);
    }
}
