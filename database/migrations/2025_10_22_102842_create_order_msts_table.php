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
        Schema::create('order_msts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('patient_msts')->onDelete('cascade');
            $table->string('invoice_no')->unique();
            $table->decimal('total_bill_amount', 10, 2)->default(0.00);
            $table->decimal('discount_percentage', 5, 2)->default(0.00);
            $table->decimal('discount_amount', 10, 2)->default(0.00);
            $table->decimal('payable_amount', 10, 2)->default(0.00);
            $table->decimal('paid_amount', 10, 2)->default(0.00);
            $table->enum('payment_status', ['Full Paid', 'Part Paid', 'Unpaid'])->default('Unpaid');
            $table->foreignId('shop_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_msts');
    }
};
