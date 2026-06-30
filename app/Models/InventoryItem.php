<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryItem extends Model
{
    /** @use HasFactory<InventoryItemFactory> */
    use HasFactory;

    protected $fillable = ['outlet_id', 'name', 'unit', 'unit_cost', 'current_stock', 'reorder_point'];

    public function outlet()
    {
        return $this->belongsTo(Outlet::class);
    }

    public function stockMovements()
    {
        return $this->hasMany(StockMovement::class, 'item_id');
    }
}
