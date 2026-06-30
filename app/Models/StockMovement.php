<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockMovement extends Model
{
    /** @use HasFactory<StockMovementFactory> */
    use HasFactory;

    protected $fillable = ['item_id', 'user_id', 'qty', 'unit_cost', 'movement_type', 'description'];
}
