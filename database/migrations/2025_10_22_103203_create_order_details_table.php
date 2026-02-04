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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('patient_msts')->onDelete('cascade');
            $table->foreignId('order_id')->constrained('order_msts')->onDelete('cascade');
            $table->foreignId('medicine_id')->constrained('mediciane_msts')->onDelete('cascade');
            $table->integer('qty');
            $table->decimal('price', 10, 2)->default(0.00);
            $table->decimal('total_amount', 10, 2)->default(0.00);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
