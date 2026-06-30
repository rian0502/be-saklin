<?php

namespace App\Models;

use Database\Factories\MaintenanceHistoryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintenanceHistory extends Model
{
    /** @use HasFactory<MaintenanceHistoryFactory> */
    use HasFactory;

    protected $fillable = ['machine_id', 'start_date', 'end_date', 'description', 'cost', 'technician'];
}
