<?php

namespace App\Models;

use Database\Factories\OrderStatusLogFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatusLog extends Model
{
    /** @use HasFactory<OrderStatusLogFactory> */
    use HasFactory;

    protected $fillable = ['order_id', 'changed_by', 'status', 'notes', 'changed_at'];
}
