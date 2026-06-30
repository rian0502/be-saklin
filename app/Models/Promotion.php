<?php

namespace App\Models;

use Database\Factories\PromotionFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    /** @use HasFactory<PromotionFactory> */
    use HasFactory;

    protected $fillable = [
        'code', 'discount_type', 'value', 'valid_from',
        'valid_until', 'usage_limit', 'used_count', 'status',
    ];
}
