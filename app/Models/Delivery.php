<?php

namespace App\Models;

use Database\Factories\DeliveryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    /** @use HasFactory<DeliveryFactory> */
    use HasFactory;

    protected $fillable = [
        'order_id', 'pickup_address', 'delivery_address',
        'courier_name', 'status', 'scheduled_time', 'delivered_time',
    ];
}
