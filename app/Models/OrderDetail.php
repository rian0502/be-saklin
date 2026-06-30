<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    /** @use HasFactory<OrderDetailFactory> */
    use HasFactory;

    protected $fillable = [
        'order_id', 'service_id', 'machine_id',
        'qty_or_weight', 'price_per_unit', 'subtotal',
        'start_time', 'end_time',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function machine()
    {
        return $this->belongsTo(Machine::class);
    }

    public function itemUsages()
    {
        return $this->hasMany(OrderDetailItemUsage::class);
    }
}
