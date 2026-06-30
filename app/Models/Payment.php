<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    /** @use HasFactory<PaymentFactory> */
    use HasFactory;

    protected $fillable = ['order_id', 'amount', 'payment_date', 'payment_method', 'reference_number'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
