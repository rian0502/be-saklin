<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
    //
    protected $fillable = ['tenant_id', 'key', 'name', 'address', 'phone', 'status'];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function machines()
    {
        return $this->hasMany(Machine::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function inventoryItems()
    {
        return $this->hasMany(InventoryItem::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
