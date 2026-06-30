<?php

namespace App\Models;

use Database\Factories\MachineTypeFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MachineType extends Model
{
    /** @use HasFactory<MachineTypeFactory> */
    use HasFactory;

    protected $fillable = ['name', 'capacity_value', 'capacity_unit', 'description'];
}
