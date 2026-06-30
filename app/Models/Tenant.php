<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    /** @use HasFactory<TenantFactory> */
    use HasFactory;

    protected $fillable = ['name', 'contract', 'phone', 'email', 'status'];

    public function outlets()
    {
        return $this->hasMany(Outlet::class);
    }
}
