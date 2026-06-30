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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('outlet_id')->constrained()->cascadeOnDelete();
            $table->foreignId('machine_type_id')->nullable()->constrained()->nullOnDelete();
            $table->string('name');
            $table->decimal('price', 12, 2);
            $table->string('type'); // self_service, full_service, addon
            $table->string('unit')->nullable(); // kg, pcs, load
            $table->integer('duration_minutes')->nullable();
            $table->string('status')->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
