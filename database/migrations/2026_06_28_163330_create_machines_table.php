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
    Schema::create('machines', function (Blueprint $table) {
        $table->id();
        $table->foreignId('outlet_id')->constrained()->cascadeOnDelete();
        $table->foreignId('machine_type_id')->nullable()->constrained()->nullOnDelete();
        $table->string('key')->unique();
        $table->string('name');
        $table->string('type'); // washer, dryer
        $table->string('status')->default('idle'); // idle, running, maintenance, offline
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('machines');
    }
};
