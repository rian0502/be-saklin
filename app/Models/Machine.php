<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    /** @use HasFactory<MachineFactory> */
    use HasFactory;

    protected $fillable = ['outlet_id', 'machine_type_id', 'key', 'name', 'type', 'status'];

    public function outlet()
    {
        return $this->belongsTo(Outlet::class);
    }

    public function machineType()
    {
        return $this->belongsTo(MachineType::class);
    }

    public function maintenanceHistories()
    {
        return $this->hasMany(MaintenanceHistory::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
