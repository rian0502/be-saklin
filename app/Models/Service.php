<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    /** @use HasFactory<ServiceFactory> */
    use HasFactory;

    protected $fillable = [
        'outlet_id', 'machine_type_id', 'name', 'price',
        'type', 'unit', 'duration_minutes', 'status',
    ];

    public function outlet()
    {
        return $this->belongsTo(Outlet::class);
    }

    public function machineType()
    {
        return $this->belongsTo(MachineType::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
