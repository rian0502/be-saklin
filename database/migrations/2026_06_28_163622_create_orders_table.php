<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('outlet_id')->constrained()->cascadeOnDelete();
            $table->foreignId('customer_id')->constrained()->cascadeOnDelete();
            $table->foreignId('cashier_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('promotion_id')->nullable()->constrained()->nullOnDelete();
            $table->string('invoice_number')->unique();
            $table->date('order_date');
            $table->string('laundry_status')->default('received'); // received, washing, drying, ironing, ready, completed, cancelled
            $table->string('payment_status')->default('unpaid'); // unpaid, partial, paid (derived)
            $table->decimal('subtotal_amount', 12, 2)->default(0);
            $table->decimal('discount_amount', 12, 2)->default(0);
            $table->decimal('tax_rate', 5, 2)->default(0); // snapshot rate
            $table->decimal('tax_amount', 12, 2)->default(0);
            $table->decimal('total_amount', 12, 2)->default(0);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
