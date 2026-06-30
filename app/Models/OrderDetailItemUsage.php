<?php

namespace App\Models;

use Database\Factories\OrderDetailItemUsageFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetailItemUsage extends Model
{
    /** @use HasFactory<OrderDetailItemUsageFactory> */
    use HasFactory;

    protected $fillable = ['order_detail_id', 'item_id', 'qty_used'];
}
